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

    // public function allocate(Request $request)
    // {
    //     $request->validate([
    //         'id_barang' => 'required|integer',
    //         'id_request' => 'required|integer',
    //         'penerima' => 'required|string',
    //         'tanggal_donasi' => 'required|date'
    //     ]);

    //     // Ambil permintaan donasi
    //     $requestDonasi = RequestDonasi::findOrFail($request->id_request);

    //     // Filter barang yang sesuai dengan permintaan donasi
    //     $barangSiapDonasi = BarangTitipan::where('status_barang', 'barang untuk donasi')
    //                                     ->where('nama_barang', 'like', "%{$requestDonasi->barang_dibutuhkan}%")
    //                                     ->get();

    //     // Pastikan barang yang dipilih sesuai permintaan donasi
    //     $barang = BarangTitipan::findOrFail($request->id_barang);

    //     if (strpos(strtolower($barang->nama_barang), strtolower($requestDonasi->barang_dibutuhkan)) === false) {
    //         return back()->withErrors([
    //             'error' => "Barang yang dipilih (\"{$barang->nama_barang}\") tidak sesuai dengan permintaan donasi (dibutuhkan: \"{$requestDonasi->barang_dibutuhkan}\")."
    //         ]);
    //     }

    //     // Lanjutkan dengan proses alokasi barang
    //     DB::transaction(function () use ($request, $barang) {
    //         Donasi::create([
    //             'id_request' => $request->id_request,
    //             'id_barang' => $request->id_barang,
    //             'penerima' => $request->penerima,
    //             'tanggal_donasi' => $request->tanggal_donasi
    //         ]);

    //         $tanggalHariIni = now();
            
    //         BarangTitipan::where('id_barang', $request->id_barang)
    //             ->update([
    //                 'status_barang' => 'Didonasikan',
    //                 'tanggal_keluar' => $tanggalHariIni,
    //             ]);
    //         RequestDonasi::where('id_request', $request->id_request)
    //             ->update([
    //                 'status_request' => 'Diterima',
    //                 'tanggal_keluar' => $tanggalHariIni,
    //             ]);
    //         $barang = BarangTitipan::find($request->id_barang);
    //         $poin = floor($barang->harga_jual / 10000);

    //         Penitip::where('id_penitip', $barang->id_penitip)
    //             ->increment('poin', $poin);
    //     });

    //     return redirect()->route('owner.donasi.index')->with('success', 'Barang berhasil didonasikan.');
    // }
    // 3. Mengalokasikan barang ke organisasi berdasarkan request
    public function allocate(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|integer',
            'id_request' => 'required|integer',
            'penerima' => 'required|string',
            // 'tanggal_donasi' => 'required|date'
        ]);

        $tanggalDonasi = now();

        $requestDonasi = RequestDonasi::findOrFail($request->id_request);
        $barang = BarangTitipan::findOrFail($request->id_barang);

        // Validasi barang
        if ($barang->status_barang !== 'barang untuk donasi') {
            return back()->withErrors(['error' => 'Barang tidak tersedia untuk donasi.']);
        }

        if (stripos($barang->nama_barang, $requestDonasi->barang_dibutuhkan) === false) {
            return back()->withErrors(['error' => 'Barang tidak sesuai dengan permintaan donasi.']);
        }

        DB::transaction(function () use ($request, $barang, $requestDonasi) {
        // Buat data donasi
        Donasi::create([
            'id_request' => $request->id_request,
            'id_barang' => $request->id_barang,
            'penerima' => $request->penerima,
            'tanggal_donasi' => $request->tanggal_donasi
        ]);

        // Update status dan tanggal_keluar barang
        BarangTitipan::where('id_barang', $request->id_barang)
            ->update([
                'status_barang' => 'Didonasikan',
                'tanggal_keluar' => $request->tanggal_donasi
            ]);

        // Update status request donasi saja
        RequestDonasi::where('id_request', $request->id_request)
            ->update([
                'status_request' => 'Diterima'
            ]);

        // Hitung dan tambahkan poin ke penitip
        $poin = floor($barang->harga_jual / 10000);
        Penitip::where('id_penitip', $barang->id_penitip)
            ->increment('poin', $poin);
    });
        return redirect()->route('owner.donasi.index')->with('success', 'Donasi berhasil dialokasikan.');
    }

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'id_donasi' => 'required|integer',
    //         'penerima' => 'required|string',
    //         'tanggal_donasi' => 'required|date'
    //     ]);

    //     DB::transaction(function () use ($request) {
    //         $tanggalHariIni = now();

    //         $donasi = Donasi::with('barang_titipan.penitip')
    //             ->where('id_donasi', $request->id_donasi)
    //             ->firstOrFail();

    //         // Update data donasi
    //         $donasi->update([
    //             'penerima' => $request->penerima,
    //             'tanggal_donasi' => $request->tanggal_donasi
    //         ]);

    //         // Update status dan tanggal_keluar barang
    //         BarangTitipan::where('id_barang', $donasi->id_barang)
    //             ->update([
    //                 'status_barang' => 'Didonasikan',
    //                 'tanggal_keluar' => $tanggalHariIni
    //             ]);

    //         // Update status dan tanggal_keluar request donasi
    //         RequestDonasi::where('id_request', $donasi->id_request)
    //             ->update([
    //                 'status_request' => 'Diterima',
    //                 'tanggal_keluar' => $tanggalHariIni
    //             ]);

    //         // Kirim notifikasi ke penitip
    //         $penitip = $donasi->barang_titipan->penitip;
    //         $penitip->notify(new BarangDidonasikan($donasi->barang_titipan, $request->tanggal_donasi));
    //     });

    //     return redirect()->route('owner.donasi.index')->with('success', 'Data donasi dan status barang berhasil diperbarui.');
    // }
    public function update(Request $request)
    {
        $request->validate([
            'id_donasi' => 'required|integer',
            'penerima' => 'required|string',
            'tanggal_donasi' => 'required|date'
        ]);

        DB::transaction(function () use ($request) {
            $donasi = Donasi::with('barang_titipan.penitip')->findOrFail($request->id_donasi);

            // Update donasi
            $donasi->update([
                'penerima' => $request->penerima,
                'tanggal_donasi' => $request->tanggal_donasi
            ]);

            // Update barang dan request sesuai tanggal baru
            $donasi->barang_titipan->update([
                'status_barang' => 'Didonasikan',
                'tanggal_keluar' => $request->tanggal_donasi
            ]);

            $donasi->request_donasi->update([
                'status_request' => 'Diterima',
                'tanggal_keluar' => $request->tanggal_donasi
            ]);
        });

        return redirect()->route('owner.donasi.index')->with('success', 'Data donasi berhasil diperbarui.');
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
