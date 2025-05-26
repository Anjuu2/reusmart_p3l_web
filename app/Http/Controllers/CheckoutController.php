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
        $jenisPengiriman = $request->input('jenis_pengiriman'); // dari hidden input
        $subtotal = $request->input('subtotal'); // dari input tersembunyi
        $totalBayar = $request->input('total_pembayaran'); // dari input tersembunyi

        DB::beginTransaction();

        try {
            // 1. Simpan transaksi utama
            $transaksi = Transaksi::create([
                'id_pembeli'       => $pembeliId,
                'tanggal_transaksi'=> Carbon::now(),
                'total_pembayaran' => $totalBayar,
                'status_transaksi' => 'Menunggu Pembayaran',
                'jenis_pengiriman' => $jenisPengiriman
            ]);

            // 2. Ambil semua barang dari keranjang
            $keranjangIds = Keranjang::where('id_pembeli', $pembeliId)->pluck('id_keranjang');

            $barangList = DB::table('detail_keranjang')
                ->join('barang_titipan', 'detail_keranjang.id_barang', '=', 'barang_titipan.id_barang')
                ->whereIn('detail_keranjang.id_keranjang', $keranjangIds)
                ->select('barang_titipan.id_barang', 'barang_titipan.harga_jual')
                ->get();

            foreach ($barangList as $barang) {
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_barang'    => $barang->id_barang,
                    'sub_total'    => $barang->harga_jual
                ]);
            }

            // 3. (Opsional) Hapus isi keranjang pembeli setelah checkout
            DB::table('detail_keranjang')->whereIn('id_keranjang', $keranjangIds)->delete();

            DB::commit();
            return redirect()->route('home'); // halaman sukses transaksi
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
}

