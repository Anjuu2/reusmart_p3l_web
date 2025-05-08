<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function showProducts()
    {
        // Mengambil semua produk barang titipan
        $barangTitipan = BarangTitipan::all();

        // Mengirim data produk ke view
        return view('products.index', compact('barangTitipan'));
    }

    public function showProductsByCategory($categoryId)
    {
        // Mengambil produk berdasarkan kategori
        $barangTitipan = BarangTitipan::where('id_kategori', $categoryId)->get();

        // Mengirim data ke view
        return view('products.index', compact('barangTitipan'));
    }

}
