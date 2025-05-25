<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\BarangTitipan;
use App\Models\Pembeli;
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

    public function prosesCheckout(Request $request)
    {
        $request->validate([
            'metode_pengiriman' => 'required|in:kurir,ambil_sendiri',
            'id_alamat' => 'required_if:metode_pengiriman,kurir',
            'poin_tukar' => 'nullable|integer|min:0',
        ]);

        $pembeli = Auth::user();
        $keranjang = $pembeli->keranjang->barang ?? [];

        $totalHarga = $keranjang->sum('harga_jual');

        // === Ongkir ===
        $ongkir = 0;
        if ($request->metode_pengiriman === 'kurir') {
            $ongkir = ($totalHarga >= 1500000) ? 0 : 100000;
        }

        // === Poin Tukar ===
        $poinDimiliki = $pembeli->poin;
        $poinTukar = min($request->input('poin_tukar', 0), $poinDimiliki);
        $potonganPoin = intval($poinTukar / 100) * 10000;

        // === Total Bayar ===
        $totalBayar = max(0, $totalHarga + $ongkir - $potonganPoin);

        // === Hitung Poin Bonus ===
        $bonusPoin = intval($totalHarga / 10000);
        if ($totalHarga > 500000) {
            $bonusPoin += intval($bonusPoin * 0.2); // bonus 20%
        }

        // === Simpan Transaksi ===
        DB::beginTransaction();
        try {
            $transaksi = Transaksi::create([
                'id_pembeli' => $pembeli->id_pembeli,
                'tanggal_transaksi' => now(),
                'total_pembayaran' => $totalBayar,
                'status_transaksi' => 'Diproses',
                'metode_pengiriman' => $request->metode_pengiriman,
                'id_alamat' => $request->id_alamat ?? null,
            ]);

            foreach ($keranjang as $barang) {
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_barang' => $barang->id_barang,
                    'sub_total' => $barang->harga_jual,
                ]);

                $barang->update(['status_barang' => 'Terjual']);
            }

            // Update poin pembeli
            $pembeli->update([
                'poin' => $poinDimiliki - $poinTukar + $bonusPoin,
            ]);

            // Hapus keranjang
            $pembeli->keranjang->barang()->detach();

            DB::commit();

            return redirect()->route('checkout.sukses')->with('success', 'Transaksi berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('warning', 'Terjadi kesalahan saat memproses checkout.');
        }
    }
}

