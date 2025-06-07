<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Http\Resources\KategoriResource;
use App\Http\Resources\BarangTitipanResource;

class KategoriApiController extends Controller
{
    // GET /api/kategori
    public function index()
    {
        // semua kategori
        return KategoriResource::collection(Kategori::all());
    }

    // GET /api/kategori/{id}
    public function show($id)
    {
        // semua barang di kategori tertentu
        $barangs = Kategori::findOrFail($id)
            ->barang_titipans()
            ->where('status_barang','Tersedia')
            ->get();

        return BarangTitipanResource::collection($barangs);
    }
}
