<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\BarangTitipan;

class KategoriController extends Controller
{
    // public function index()
    // {
    //     // Menampilkan semua kategori
    //     $categories = Kategori::all();
    //     return view('kategori.index', compact('categories'));
    // }
    public function index()
    {
        return view('kategori');
    }

    // public function showProducts()
    // {
    //     // Mengambil semua produk barang titipan
    //     $barangTitipan = BarangTitipan::all();

    //     // Mengirim data produk ke view
    //     return view('kategori', compact('barangTitipan'));
    // }

    public function showAvailableProducts()
    {
        $produk = BarangTitipan::with('kategori')->where('status_barang', 'Tersedia')->get();
        $kategori = null;
        return view('kategori', compact('produk', 'kategori'));
    }

    public function showProductsByCategory($id)
    {
        $kategori = Kategori::findOrFail($id);
        $produk = BarangTitipan::with('kategori')
            ->where('id_kategori', $id)
            ->where('status_barang', 'Tersedia')
            ->get();

        return view('kategori', compact('kategori', 'produk'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        if ($query) {
            $products = BarangTitipan::with('kategori') // ← ini penting
                ->where('nama_barang', 'like', '%' . $query . '%')
                ->get();
        } else {
            $products = BarangTitipan::with('kategori')->get(); // ← juga di sini
        }

        return response()->json($products);
    }

}