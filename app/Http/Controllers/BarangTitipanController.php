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
        // Mengambil input pencarian dari parameter 'query'
        $query = $request->get('query');

        // Jika ada query pencarian, cari barang berdasarkan nama yang mirip
        if ($query) {
            $products = BarangTitipan::where('nama_barang', 'like', '%' . $query . '%')->get();
        } else {
            // Jika tidak ada pencarian, ambil semua produk
            $products = BarangTitipan::all();
        }

        // Mengembalikan data produk sebagai JSON
        return response()->json($products);
    }
}
