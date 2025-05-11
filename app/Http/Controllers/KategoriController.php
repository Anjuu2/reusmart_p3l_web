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

    // public function show($id)
    // {
    //     $kategori = Kategori::findOrFail($id);
    //     $barang = BarangTitipan::where('id_kategori', $id)->get();
    //     return view('kategori.show', compact('kategori', 'barang'));
    // }
}