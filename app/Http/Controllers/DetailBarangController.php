<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\BarangTitipan;

class DetailBarangController extends Controller
{
    public function index()
    {
        return view('detailBarang');
    }

    // public function show($id)
    // {
    //     // Ambil produk berdasarkan ID (misalnya dari model BarangTitipan)
    //     $product = BarangTitipan::find($id);
        
    //     if (!$product) {
    //         abort(404, "Produk tidak ditemukan.");
    //     }
        
    //     // Memeriksa status garansi
    //     $garansi_status = $this->checkWarrantyStatus($product->tanggal_garansi);
        
    //     // Mengirim data ke view
    //     return view('detailBarang', compact('product', 'garansi_status'));
    // }

    public function show($id)
    {
        // Ambil produk berdasarkan ID
        $product = BarangTitipan::with('kategori')->find($id);
        
        if (!$product) {
            abort(404, "Produk tidak ditemukan.");
        }
        
        // Cek status garansi
        $garansi_status = $this->checkWarrantyStatus($product->tanggal_garansi);

        // Ambil produk serupa dari kategori yang sama (selain produk ini sendiri)
        $produk_serupa = BarangTitipan::where('id_kategori', $product->id_kategori)
                            ->where('id_barang', '!=', $id)
                            ->where('status_barang', 'Tersedia')
                            ->take(4)
                            ->get();

        // Kirim semua data ke view
        return view('detailBarang', compact('product', 'garansi_status', 'produk_serupa'));
    }

    // Fungsi untuk memeriksa status garansi
    private function checkWarrantyStatus($tanggal_garansi)
    {
        // Pastikan tanggal garansi ada
        if (!$tanggal_garansi) {
            return "Garansi Tidak Tersedia"; // Jika tanggal garansi kosong
        }

        // Menggunakan Carbon untuk memanipulasi tanggal
        $garansi = Carbon::parse($tanggal_garansi);
        $today = Carbon::now();

        // Memeriksa apakah tanggal garansi masih berlaku
        if ($garansi->isFuture()) {
            return "Garansi Masih Berlaku";
        } else {
            return "Garansi Sudah Berakhir";
        }
    }

}
