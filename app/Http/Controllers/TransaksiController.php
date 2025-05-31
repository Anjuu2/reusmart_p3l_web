<?php

namespace App\Http\Controllers;
use App\Models\Transaksi;
use App\Models\Pembeli;
use App\Notifications\transaksiDisiapkan;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        // Mengambil semua kolom dari transaksi yang status_transaksi = 'lunas'
        $transaksis = Transaksi::where('status_transaksi', 'lunas')->paginate(10);

        return view('CS.transaksiIndex', compact('transaksis'));
    }

    public function verifikasiTransaksi($id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $transaksi->status_transaksi = 'Disiapkan';
        $transaksi->save();

        $pembeli = Pembeli::find($transaksi->id_pembeli);

        if ($pembeli) {
            // Tambah poin
            $poinDidapat = $transaksi->poin_didapat ?? 0;
            $pembeli->poin += $poinDidapat;
            $pembeli->save();

            // Kirim notifikasi email
            if ($pembeli->email) {
                $pembeli->notify(new transaksiDisiapkan($transaksi, $pembeli));
            }
        }

        return redirect()->back()->with('success', 'Status transaksi berhasil diubah, poin ditambahkan, dan email notifikasi telah dikirim.');
    }

    public function tolakTransaksi($id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);
        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $transaksi->status_transaksi = 'Batal';
        $transaksi->save();

        return redirect()->back()->with('success', 'Bukti pembayaran ditolak dan status transaksi diubah menjadi batal.');
    }
}
