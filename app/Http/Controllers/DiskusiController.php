<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DiskusiProduk;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DiskusiController extends Controller
{
    // Menampilkan halaman diskusi untuk suatu barang
    public function index()
    {
        $diskusi = DiskusiProduk::all(); // tanpa where
        return view('diskusi', compact('diskusi'));
    }


    // Menyimpan pertanyaan dari pembeli (hanya satu kali per barang)
    public function storePertanyaan(Request $request, $id_barang)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
        ]);

        $id_pembeli = Auth::guard('pembeli')->id();

        // Cek apakah pembeli sudah bertanya untuk barang ini
        $existing = DiskusiProduk::where('id_barang', $id_barang)
                    ->where('id_pembeli', $id_pembeli)
                    ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah mengajukan pertanyaan untuk produk ini.');
        }

        DiskusiProduk::create([
            'id_pembeli' => $id_pembeli,
            'id_barang'  => $id_barang,
            'pertanyaan' => $request->pertanyaan,
            'tanggal_tanya' => Carbon::now(),
        ]);

        return back()->with('success', 'Pertanyaan berhasil dikirim.');
    }

    // Menjawab pertanyaan oleh pegawai (hanya jika belum dijawab)
    public function jawab(Request $request, $id_diskusi)
    {
        $request->validate([
            'jawaban' => 'required|string',
        ]);

        $diskusi = DiskusiProduk::findOrFail($id_diskusi);

        if ($diskusi->jawaban) {
            return back()->with('error', 'Pertanyaan ini sudah dijawab.');
        }

        $diskusi->update([
            'jawaban' => $request->jawaban,
            'id_pegawai' => Auth::guard('pegawai')->id(),
            'tanggal_jawab' => Carbon::now(),
        ]);

        return back()->with('success', 'Jawaban berhasil dikirim.');
    }
}
