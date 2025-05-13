<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangTitipan;

class BarangTitipanController extends Controller
{
    public function show($id)
    {
        $produk = BarangTitipan::findOrFail($id);
        return view('produk.show', compact('produk'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');  // Ambil kata kunci pencarian dari parameter 'search'

        // Cari produk berdasarkan nama barang dan hanya menampilkan barang yang statusnya 'Tersedia'
        $produk = BarangTitipan::where('nama_barang', 'like', '%' . $query . '%')
            ->where('status_barang', 'Tersedia')  // Menambahkan filter untuk hanya barang yang tersedia
            ->get();

        // Mengirim data produk yang ditemukan ke view
        return view('kategori', compact('produk'));
    }
}
