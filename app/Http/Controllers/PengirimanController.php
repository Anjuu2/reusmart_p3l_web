<?php
namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Penjadwalan;
use App\Models\Pegawai;
use App\Models\Pengiriman;
use Illuminate\Http\Request;


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

        $transaksi = Transaksi::findOrFail($validated['id_transaksi']);
        $jam_transaksi = \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->hour;
        $tanggal_transaksi = \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->toDateString();
        $tanggal_jadwal = \Carbon\Carbon::parse($validated['tanggal_jadwal'])->toDateString();

        if ($jam_transaksi >= 16 && $tanggal_transaksi === $tanggal_jadwal) {
            return back()->withInput()->with('error', 'Transaksi setelah jam 16:00 tidak bisa dijadwalkan di hari yang sama.')
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
            'id_pegawai' => $request->input('id_kurir'),
            'id_jadwal' => $jadwal->id_jadwal,
            'status_pengiriman' => 'Disiapkan',
        ]);

        return back()->with('success', 'Jadwal berhasil diperbarui dan pengiriman disiapkan!');
    }

}
