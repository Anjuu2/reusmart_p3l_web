<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    // LoginController.php
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function index()
    {
        // Cek jika pengguna belum login
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Anda perlu login untuk melanjutkan pembelian');
        }

        // Lanjutkan proses checkout
        return view('checkout.index');
    }

    public function indexNota()
    {
        $transaksi = Transaksi::with('pembeli')
            ->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10);

        return view('pegawai_gudang.pengirimanBarang.cetakNota', compact('transaksi'));
    }

    public function cetakNota($id)
    {
        $transaksi = Transaksi::with([
            'pembeli',
            'alamat',
            'penjadwalan.pengiriman.pegawai',
            // 'qc',
            'detailTransaksi.barang'
        ])->findOrFail($id);

        return view('pegawai_gudang.pengirimanBarang.viewNota', compact('transaksi'));
    }

    public function cetakNotaPdf($id)
    {
        $transaksi = Transaksi::with([
            'pembeli',
            'alamat',
            'penjadwalan.pengiriman.pegawai',
            // 'qc',
            'detailTransaksi.barang'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('pegawai_gudang.pengirimanBarang.viewNota', compact('transaksi'));

        return $pdf->stream('Nota_Penjualan_'.$transaksi->no_nota.'.pdf');
    }


}
