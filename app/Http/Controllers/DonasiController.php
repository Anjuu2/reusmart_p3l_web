<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestDonasi;
use App\Models\Donasi;
use App\Models\BarangTitipan;
use App\Models\Penitip;
use App\Models\Organisasi;
use Illuminate\Support\Facades\DB;

class DonasiController extends Controller
{

    public function index()
    {
        $requests = RequestDonasi::with('organisasi')
            ->where('status_request', 'Menunggu')
            ->get();

        $organisasi = Organisasi::all();
        $donasiHistori = Donasi::with(['barang_titipan', 'request_donasi.organisasi'])->get();
        $barangSiapDonasi = BarangTitipan::where('status_barang', 'barang untuk donasi')->get();


        return view('owner.donasi.index', compact('requests', 'organisasi', 'donasiHistori', 'barangSiapDonasi'));
    }

    public function allocate(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|integer',
            'id_request' => 'required|integer',
            'penerima' => 'required|string',
            'tanggal_donasi' => 'required|date'
        ]);

        DB::transaction(function () use ($request) {
            Donasi::create([
                'id_request' => $request->id_request,
                'id_barang' => $request->id_barang,
                'penerima' => $request->penerima,
                'tanggal_donasi' => $request->tanggal_donasi
            ]);

            BarangTitipan::where('id_barang', $request->id_barang)
                ->update(['status_barang' => 'Didonasikan']);

            RequestDonasi::where('id_request', $request->id_request)
                ->update(['status_request' => 'Diterima']);

            $barang = BarangTitipan::find($request->id_barang);
            $poin = floor($barang->harga_jual / 10000);

            Penitip::where('id_penitip', $barang->id_penitip)
                ->increment('poin', $poin);
        });

        return redirect()->route('owner.donasi.index')->with('success', 'Barang berhasil didonasikan.');
    }

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'id_donasi' => 'required|integer',
    //         'penerima' => 'required|string',
    //         'tanggal_donasi' => 'required|date'
    //     ]);

    //     Donasi::where('id_donasi', $request->id_donasi)
    //         ->update([
    //             'penerima' => $request->penerima,
    //             'tanggal_donasi' => $request->tanggal_donasi
    //         ]);

    //     return redirect()->route('owner.donasi.index')->with('success', 'Data donasi berhasil diperbarui.');
    // }

    public function update(Request $request)
    {
        $request->validate([
            'id_donasi' => 'required|integer',
            'penerima' => 'required|string',
            'tanggal_donasi' => 'required|date'
        ]);

        DB::transaction(function () use ($request) {
            $donasi = Donasi::with('barang_titipan.penitip')
                ->where('id_donasi', $request->id_donasi)
                ->firstOrFail();

            // Update data donasi
            $donasi->update([
                'penerima' => $request->penerima,
                'tanggal_donasi' => $request->tanggal_donasi
            ]);

            // Update status barang
            $barang = $donasi->barang_titipan;
            $barang->status_barang = 'Sudah Didonasikan';
            $barang->save();

            // Kirim notifikasi ke penitip (simulasi log / bisa diganti Laravel Notification)
            $penitip = $barang->penitip;
            $penitip->notify(new BarangDidonasikan($barang, $request->tanggal_donasi));
        });

        return redirect()->route('owner.donasi.index')->with('success', 'Data donasi dan status barang berhasil diperbarui.');
    }

    public function reject(Request $request)
    {
        RequestDonasi::where('id_request', $request->id_request)
            ->update(['status_request' => 'Ditolak']);

        return back()->with('success', 'Request donasi ditolak.');
    }

    public function historyByOrganisasi($id)
    {
        $organisasi = Organisasi::findOrFail($id);

        $donasiHistori = Donasi::with('barang_titipan')
            ->whereHas('request_donasi', function ($query) use ($id) {
                $query->where('id_organisasi', $id);
            })
            ->orderByDesc('tanggal_donasi')
            ->get();

        return view('owner.donasi.history-organisasi', compact('organisasi', 'donasiHistori'));
    }

}
