<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangTitipan;
use App\Http\Resources\BarangTitipanResource;

class BarangTitipanApiController extends Controller
{
    public function index()
    {
        // 1) Load produk beserta kategori-nya
        $barangs = BarangTitipan::with('kategori')
            ->where('status_barang', 'Tersedia')
            ->get();

        // 2) Kembalikan dalam bentuk collection resource JSON
        return BarangTitipanResource::collection($barangs);
    }
}
