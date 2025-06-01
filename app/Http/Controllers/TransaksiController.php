<?php

namespace App\Http\Controllers;
use App\Models\Transaksi;
use App\Models\Pembeli;
use App\Models\Pembayaran;
use App\Models\BarangTitipan;
use App\Models\Pegawai;

use App\Notifications\transaksiDisiapkan;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function index()
    {
        // Mengambil semua data pembayaran dengan pagination 10 per halaman
        $pembayarans = Pembayaran::paginate(10);

        // Kirim data pembayaran ke view dengan variabel 'pembayarans'
        return view('CS.pembayaranIndex', compact('pembayarans'));
}

    public function uploadBukti(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id_transaksi',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Ambil data pembayaran berdasar id_transaksi
            $pembayaran = Pembayaran::where('id_transaksi', $request->id_transaksi)->first();

            if (!$pembayaran) {
                return back()->with('error', 'Data pembayaran tidak ditemukan untuk transaksi ini.');
            }

            // Simpan file ke folder public/images/bukti_pembayaran
            $file = $request->file('bukti_pembayaran');
            $extension = $file->getClientOriginalExtension();
            $namaFile = uniqid() . '.' . $extension;
            $file->move(public_path('images/bukti_pembayaran'), $namaFile);

            // Update field bukti_transfer dan status_verifikasi di tabel pembayaran
            $pembayaran->bukti_transfer = $namaFile;
            $pembayaran->status_verifikasi = 0;  // status belum diverifikasi, bisa diubah oleh admin nanti
            $pembayaran->save();

            DB::commit();
            return redirect()->route('home')->with('success', 'Bukti pembayaran berhasil diunggah dan menunggu verifikasi.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengunggah bukti pembayaran: ' . $e->getMessage());
        }
    }

    public function verifikasiPembayaran($id_transaksi)
    {
        // Cari pembayaran berdasarkan id_transaksi
        $pembayaran = Pembayaran::where('id_transaksi', $id_transaksi)->first();

        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Data pembayaran tidak ditemukan.');
        }

        // Update status_verifikasi jadi 1 (disetujui)
        $pembayaran->status_verifikasi = 1;

        // Isi id_pegawai dengan id pegawai yang sedang login
        $pembayaran->id_pegawai = auth()->guard('pegawai')->id(); 
        // sesuaikan 'pegawai' dengan guard yang kamu gunakan jika beda

        $pembayaran->save();

        // Update status transaksi jadi 'Disiapkan'
        $transaksi = Transaksi::find($id_transaksi);
        if ($transaksi) {
            $transaksi->status_transaksi = 'Disiapkan';
            $transaksi->save();

            // Tidak menambah poin ke pembeli

            // Kirim notifikasi email jika email ada
            $pembeli = Pembeli::find($transaksi->id_pembeli);
            if ($pembeli && $pembeli->email) {
                $pembeli->notify(new transaksiDisiapkan($transaksi, $pembeli));
            }
        }

        return redirect()->back()->with('success', 'Pembayaran diverifikasi, status transaksi diubah, dan email notifikasi dikirim.');
    }
  
  public function indexNota()
    {
        $transaksi = Transaksi::with('pembeli')
            ->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10);

        return view('pegawai_gudang.pengirimanBarang.cetakNota', compact('transaksi'));
    }

    public function cetakNota($id)
    {
        $transaksi = Transaksi::with([
            'pembeli',
            'alamat',
            'penjadwalan.pengiriman.pegawai',
            // 'qc',
            'detailTransaksi.barang'
        ])->findOrFail($id);

        return view('pegawai_gudang.pengirimanBarang.viewNota', compact('transaksi'));
    }

    public function cetakNotaPdf($id)
    {
        $transaksi = Transaksi::with([
            'pembeli',
            'alamat',
            'penjadwalan.pengiriman.pegawai',
            // 'qc',
            'detailTransaksi.barang'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('pegawai_gudang.pengirimanBarang.viewNota', compact('transaksi'));

        return $pdf->stream('Nota_Penjualan_'.$transaksi->no_nota.'.pdf');
    }

    public function batalTransaksi(Request $request)
    {
        try {
            $id = $request->input('id_transaksi');
            $transaksi = Transaksi::find($id);

            if ($transaksi && $transaksi->status_transaksi === 'Menunggu Pembayaran' && !$transaksi->bukti_pembayaran) {
                $transaksi->status_transaksi = 'Batal';
                $transaksi->save();

                // Kembalikan barang jadi Tersedia
                $details = DetailTransaksi::where('id_transaksi', $id)->get();
                foreach ($details as $detail) {
                    BarangTitipan::where('id_barang', $detail->id_barang)->update([
                        'status_barang' => 'Tersedia'
                    ]);
                }

                // Kembalikan poin yang digunakan ke pembeli
                $pembeli = Pembeli::find($transaksi->id_pembeli);
                if ($pembeli) {
                    $poinDigunakan = $transaksi->poin_digunakan ?? 0;
                    $pembeli->poin += $poinDigunakan;
                    $pembeli->save();
                }

                return response()->json(['success' => true, 'message' => 'Transaksi dibatalkan karena tidak ada bukti pembayaran dan poin dikembalikan.']);
            }

            return response()->json(['success' => false, 'message' => 'Transaksi tidak valid atau sudah dibayar.']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan server.', 'error' => $e->getMessage()], 500);
        }
    }

    public function tolakPembayaran($id_transaksi)
    {
        // Cari pembayaran berdasarkan id_transaksi
        $pembayaran = Pembayaran::where('id_transaksi', $id_transaksi)->first();

        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Data pembayaran tidak ditemukan.');
        }

        // Update status_verifikasi jadi 2 (ditolak)
        $pembayaran->status_verifikasi = 0;

        // Isi id_pegawai dengan id pegawai yang sedang login
        $pembayaran->id_pegawai = auth()->guard('pegawai')->id(); 
        // sesuaikan guard jika perlu

        $pembayaran->save();

        // Update status transaksi jadi 'Batal'
        $transaksi = Transaksi::find($id_transaksi);
        if ($transaksi) {
            $transaksi->status_transaksi = 'Batal';
            $transaksi->save();

            // Kembalikan status barang jadi 'Tersedia'
            $detailBarang = DetailTransaksi::where('id_transaksi', $id_transaksi)->get();

            foreach ($detailBarang as $detail) {
                BarangTitipan::where('id_barang', $detail->id_barang)
                    ->update(['status_barang' => 'Tersedia']);
            }

            // Kembalikan poin yang digunakan ke pembeli
            $pembeli = Pembeli::find($transaksi->id_pembeli);
            if ($pembeli) {
                $poinDigunakan = $transaksi->poin_digunakan ?? 0;
                $pembeli->poin += $poinDigunakan;
                $pembeli->save();
            }
        }

        return redirect()->back()->with('success', 'Bukti pembayaran ditolak, status transaksi diubah menjadi batal, status barang dikembalikan tersedia, dan poin dikembalikan.');
    }
}
