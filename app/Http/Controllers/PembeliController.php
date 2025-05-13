<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\BarangTitipan;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Pembeli;

class PembeliController extends Controller
{
    public function profilePembeli()
    {
        $pembeli = Auth::guard('pembeli')->user();
        return view('profilePembeli', compact('pembeli'));
    }

    // public function showBarangYangDibeli()
    // {
    //     $barangs = BarangTitipan::with('kategori')->where('status_barang', 'Terjual')->get();

    //     $pembeli = Pembeli::all();
    //     $barangHistori = DetailTransaksi::with(['barang_titipan', 'transaksi.id_pembeli'])
    //         ->whereHas('transaksi', function($query) {
    //             $query->where('status_transaksi', 'Lunas');
    //         })
    //         ->get();
    //     $barangTerbeli = Transaksi::where('status_transaksi', 'Lunas')->get();

    //     return view('dashboard', compact('barangs', 'pembeli', 'barangHistori', 'barangTerbeli'));
    // }

}
