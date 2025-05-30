<?php
namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Penjadwalan;
use App\Models\Pengiriman;
use App\Models\Pegawai;
use App\Mail\JadwalDikirim;
use App\Mail\KonfirmasiPengiriman;
use App\Models\BarangTitipan;
use App\Models\Penitip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PengirimanController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['pembeli', 'penjadwalan'])
            ->whereHas('penjadwalan', function ($query) {
                $query->whereIn('jenis_jadwal', ['Pengiriman', 'Diambil']);
            })
            ->paginate(10);

        $kurir = Pegawai::where('id_jabatan', 5)->get();

        return view('pegawai_gudang.pengirimanBarang.index', compact('transaksi', 'kurir'));
    }

    public function tambahJadwal(Request $request)
    {
        $validated = $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id_transaksi',
            'tanggal_jadwal' => 'required|date',
            'id_kurir' => 'nullable|exists:pegawai,id_pegawai',
        ]);

        $transaksi = Transaksi::with(['pembeli'])->findOrFail($validated['id_transaksi']);
        $jam_transaksi = \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->hour;
        $tanggal_transaksi = \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->toDateString();
        $tanggal_jadwal = \Carbon\Carbon::parse($validated['tanggal_jadwal'])->toDateString();

        if ($jam_transaksi >= 16 && $tanggal_transaksi === $tanggal_jadwal) {
            return back()->withInput()
                ->with('error', 'Transaksi setelah jam 16:00 tidak bisa dijadwalkan di hari yang sama.')
                ->with('error_modal', $request->id_transaksi);
        }

        $jadwal = Penjadwalan::where('id_transaksi', $validated['id_transaksi'])
            ->whereIn('jenis_jadwal', ['Pengiriman', 'Diambil'])
            ->first();

        if (!$jadwal) {
            return back()->with('error', 'Data jadwal tidak ditemukan.')
                ->with('error_modal', $request->id_transaksi);
        }

        $jadwal->update([
            'tanggal_jadwal' => $validated['tanggal_jadwal'],
            'status_jadwal' => 'Dijadwalkan',
        ]);

        Pengiriman::create([
            'id_pegawai' => $request->input('id_kurir'), // bisa NULL jika Diambil
            'id_jadwal' => $jadwal->id_jadwal,
            'status_pengiriman' => 'Disiapkan',
        ]);

        // Siapkan daftar penerima email
        $recipients = [];

        // Email Pembeli
        if ($transaksi->pembeli && $transaksi->pembeli->email) {
            $recipients[] = $transaksi->pembeli->email;
        }

        // Email Penitip (loop semua penitip yang punya barang di detail_transaksi)
        $detailTransaksis = $transaksi->detailTransaksi;
        $penitipEmails = [];

        foreach ($detailTransaksis as $detail) {
            $barang = \App\Models\BarangTitipan::find($detail->id_barang);
            if ($barang) {
                $penitip = \App\Models\Penitip::find($barang->id_penitip);
                if ($penitip && $penitip->email && !in_array($penitip->email, $penitipEmails)) {
                    $penitipEmails[] = $penitip->email;
                }
            }
        }

        $recipients = array_merge($recipients, $penitipEmails);

        // Email Kurir (hanya untuk Pengiriman)
        if ($jadwal->jenis_jadwal === 'Pengiriman' && $request->filled('id_kurir')) {
            $kurir = Pegawai::find($validated['id_kurir']);
            if ($kurir && $kurir->email) {
                $recipients[] = $kurir->email;
            }
        }

        // Kirim Email
        foreach ($recipients as $email) {
            Mail::to($email)->send(new JadwalDikirim($jadwal, $transaksi));
        }

        return back()->with('success', 'Jadwal berhasil diperbarui, pengiriman disiapkan, dan email notifikasi dikirim!');
    }

   public function konfirmasi($id_jadwal)
    {
        $jadwal = Penjadwalan::with(['pengiriman', 'transaksi.pembeli', 'transaksi.detailTransaksi'])
                    ->findOrFail($id_jadwal);

        if (!$jadwal->pengiriman) {
            return back()->with('error', 'Pengiriman tidak ditemukan.');
        }

        // Update status_pengiriman
        $statusBaru = $jadwal->jenis_jadwal === 'Diambil' ? 'Diterima' : 'Sampai';
        $jadwal->pengiriman->update(['status_pengiriman' => $statusBaru]);

        // Email notifikasi ke Pembeli
        $recipients = [];
        if ($jadwal->transaksi->pembeli && $jadwal->transaksi->pembeli->email) {
            $recipients[] = $jadwal->transaksi->pembeli->email;
        }

        // Email notifikasi ke Penitip (loop semua penitip di detail_transaksi)
        $penitipEmails = [];
        foreach ($jadwal->transaksi->detailTransaksi as $detail) {
            $barang = BarangTitipan::find($detail->id_barang);
            if ($barang) {
                $penitip = Penitip::find($barang->id_penitip);
                if ($penitip && $penitip->email && !in_array($penitip->email, $penitipEmails)) {
                    $penitipEmails[] = $penitip->email;
                }
            }
        }

        $recipients = array_merge($recipients, $penitipEmails);

        // Kirim Email
        foreach ($recipients as $email) {
            Mail::to($email)->send(new KonfirmasiPengiriman($jadwal, $statusBaru));
        }

        return back()->with('success', 'Status pengiriman berhasil diperbarui dan notifikasi email dikirim!');
    }

}
