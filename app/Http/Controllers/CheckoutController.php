<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\BarangTitipan;
use App\Models\Pembeli;
use App\Models\Keranjang;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $pembeli = Auth::user();
        $keranjang = $pembeli->keranjang->barang ?? [];

        $totalHarga = $keranjang->sum('harga_jual');

        return view('checkout.index', compact('pembeli', 'keranjang', 'totalHarga'));
    }

    public function submitCheckout(Request $request)
    {
        $pembeliId = Auth::guard('pembeli')->id();
        $jenisPengiriman = $request->input('jenis_pengiriman');
        $subtotal = $request->input('subtotal');
        $totalBayar = $request->input('total_pembayaran');
        $poinDitukar = $request->input('poin_tukar') ?? 0;
        $idAlamat = $request->input('id_alamat'); // ambil id_alamat dari request

        DB::beginTransaction();

        try {
            // Hitung poin dasar dan bonus
            $poinDasar = floor($totalBayar / 10000);
            $bonus = $totalBayar > 500000 ? floor($poinDasar * 0.2) : 0;
            $poinDidapat = $poinDasar + $bonus;

            // 1. Simpan transaksi utama dengan poin_didapat dan id_alamat
            $transaksi = Transaksi::create([
                'id_pembeli'        => $pembeliId,
                'tanggal_transaksi' => Carbon::now(),
                'total_pembayaran'  => $totalBayar,
                'status_transaksi'  => 'Menunggu Pembayaran',
                'jenis_pengiriman'  => $jenisPengiriman,
                'nomor_transaksi'   => '',
                'poin_didapat'      => $poinDidapat,
                'id_alamat'         => $idAlamat, // simpan id_alamat ke database
            ]);

            // 2. Generate No Nota: yy.mm.xxx
            $totalTransaksi = Transaksi::count() + 1;
            $transaksi->nomor_transaksi = now()->format('y.m.') . str_pad($totalTransaksi, 3, '0', STR_PAD_LEFT);
            $transaksi->save();

            // 3. Ambil isi keranjang pembeli
            $keranjangIds = Keranjang::where('id_pembeli', $pembeliId)->pluck('id_keranjang');

            $barangList = DB::table('detail_keranjang')
                ->join('barang_titipan', 'detail_keranjang.id_barang', '=', 'barang_titipan.id_barang')
                ->whereIn('detail_keranjang.id_keranjang', $keranjangIds)
                ->select('barang_titipan.id_barang', 'barang_titipan.harga_jual')
                ->get();

            foreach ($barangList as $barang) {
                // 4. Simpan detail transaksi
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_barang'    => $barang->id_barang,
                    'sub_total'    => $barang->harga_jual
                ]);

                // 5. Ubah status barang jadi Terjual
                BarangTitipan::where('id_barang', $barang->id_barang)->update([
                    'status_barang' => 'Terjual'
                ]);
            }

            // 6. Kurangi poin jika dipakai
            if ($poinDitukar > 0) {
                $pembeli = Pembeli::find($pembeliId);

                if ($pembeli->poin >= $poinDitukar) {
                    $pembeli->poin -= $poinDitukar;
                    $pembeli->save();
                } else {
                    return back()->with('error', 'Poin tidak cukup!');
                }
            }

            // 7. Hapus keranjang
            DB::table('detail_keranjang')->whereIn('id_keranjang', $keranjangIds)->delete();

            DB::commit();
            return redirect()->route('pembayaran', ['id_transaksi' => $transaksi->id_transaksi])->with('success', 'Checkout berhasil. Silakan lakukan pembayaran.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }

    public function showCheckout()
    {
        $idPembeli = Auth::guard('pembeli')->id();
        $pembeli = Auth::guard('pembeli')->user();

        // Ambil semua id_keranjang milik pembeli
        $keranjangIds = Keranjang::where('id_pembeli', $idPembeli)->pluck('id_keranjang');

        // Ambil semua barang dalam keranjang beserta foto utama (urutan 1)
        $barangs = BarangTitipan::join('detail_keranjang', 'barang_titipan.id_barang', '=', 'detail_keranjang.id_barang')
            ->leftJoin('foto_barang', function($join) {
                $join->on('barang_titipan.id_barang', '=', 'foto_barang.id_barang')
                    ->where('foto_barang.urutan', '=', 1);
            })
            ->whereIn('detail_keranjang.id_keranjang', $keranjangIds)
            ->select(
                'barang_titipan.id_barang',
                'barang_titipan.nama_barang',
                'barang_titipan.deskripsi',
                'barang_titipan.harga_jual',
                'foto_barang.nama_file as foto_utama'
            )
            ->get();

        // Ambil semua alamat milik pembeli
        $alamatList = $pembeli->alamat_pembelis ?? collect();

        $subtotal = $barangs->sum('harga_jual');

        return view('checkout', [
            'items' => $barangs,
            'poin' => $pembeli->poin,
            'alamatList' => $alamatList,
            'subtotal' => $subtotal,
        ]);
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
            // Ambil transaksi
            $transaksi = Transaksi::find($request->id_transaksi);

            // Simpan file ke folder public/images/bukti_pembayaran
            $file = $request->file('bukti_pembayaran');
            $extension = $file->getClientOriginalExtension();
            $namaFile = uniqid() . '.' . $extension;
            $file->move(public_path('images/bukti_pembayaran'), $namaFile);

            // Update field bukti_pembayaran di database
            $transaksi->bukti_pembayaran = $namaFile;
            $transaksi->save();

            DB::commit();
            return redirect()->route('home')->with('success', 'Bukti pembayaran berhasil diunggah.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengunggah bukti pembayaran: ' . $e->getMessage());
        }
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

                return response()->json(['success' => true, 'message' => 'Transaksi dibatalkan karena tidak ada bukti pembayaran.']);
            }

            return response()->json(['success' => false, 'message' => 'Transaksi tidak valid atau sudah dibayar.']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan server.', 'error' => $e->getMessage()], 500);
        }
    }

}

