<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Penitip;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Menampilkan Top Seller Bulan Berjalan
    // public function getTopSellerCurrentMonth()
    // {
    //     // Query untuk mengambil Top Seller bulan berjalan
    //     $topSeller = Transaksi::select('penitip.id_penitip', 'penitip.nama_penitip', DB::raw('SUM(detail_transaksi.sub_total) as total_penjualan'))
    //         ->join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
    //         ->join('barang_titipan', 'barang_titipan.id_barang', '=', 'detail_transaksi.id_barang')
    //         ->join('penitip', 'penitip.id_penitip', '=', 'barang_titipan.id_penitip') // Join ke penitip melalui barang_titipan
    //         ->whereBetween('transaksi.tanggal_transaksi', [now()->startOfMonth(), now()->endOfMonth()])
    //         ->whereRaw('LOWER(transaksi.status_transaksi) = ?', ['transaksi selesai'])
    //         ->groupBy('penitip.id_penitip', 'penitip.nama_penitip')
    //         ->orderByDesc('total_penjualan')
    //         ->first();

    //         // dd($topSeller->penitip);

    //     if (!$topSeller) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Tidak ada transaksi selesai bulan ini.',
    //         ], 404);
    //     }

    //     return view('admin.topseller', [
    //         'topSeller' => $topSeller,
    //         'lastMonthTopSeller' => $this->getTopSellerLastMonth(),
    //     ]);
    // }

    // Menampilkan Top Seller Bulan Berjalan dan daftar ranking penitip
    public function getTopSellerCurrentMonth()
    {
        $targetDate = now()->subMonth();
        // dd($targetDate);

        $allSellers = Transaksi::select('penitip.id_penitip', 'penitip.nama_penitip', DB::raw('SUM(detail_transaksi.sub_total) as total_penjualan'))
            ->join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->join('barang_titipan', 'barang_titipan.id_barang', '=', 'detail_transaksi.id_barang')
            ->join('penitip', 'penitip.id_penitip', '=', 'barang_titipan.id_penitip')
            // ->where(DB::raw('MONTH(transaksi.tanggal_transaksi)'), 6)
            // ->where(DB::raw('YEAR(transaksi.tanggal_transaksi)'), 2025)
            ->whereYear('transaksi.tanggal_transaksi', $targetDate->year)
            ->whereMonth('transaksi.tanggal_transaksi', $targetDate->month)
            ->whereRaw('LOWER(transaksi.status_transaksi) = ?', ['transaksi selesai'])
            ->groupBy('penitip.id_penitip', 'penitip.nama_penitip')
            ->orderByDesc('total_penjualan')
            ->get();

        $topSeller = $allSellers->first();

        return view('admin.topseller', [
            'topSeller' => $topSeller,
            'lastMonthTopSeller' => $this->getTopSellerLastMonth(),
            'rankingThisMonth' => $allSellers,
            'historyTopSellers' => $this->getAllTopSellersHistory(),
        ]);
    }

    // Menetapkan Top Seller Bulan Lalu dan memberikan Badge
    public function setTopSellerLastMonth(Request $request)
    {
        if (now()->day !== 1) {
            return redirect()->back()->with('error', 'Penentuan Top Seller hanya dapat dilakukan pada tanggal 1 setiap bulan.');
        }

        $targetPeriod = now()->subMonth()->startOfMonth(); // 1 bulan lalu
        $targetMonth = $targetPeriod->month;
        $targetYear = $targetPeriod->year;
        $periodePemberian = now()->startOfMonth();

        $existing = Badge::where('nama_badge', 'Top Seller')
            ->whereDate('periode_pemberian', $periodePemberian)
            ->exists();

        if ($existing) {
            return response()->json(['message' => 'Top Seller sudah ditentukan untuk bulan lalu.']);
        }

        $topSellers = Transaksi::select('penitip.id_penitip', 'penitip.nama_penitip', DB::raw('SUM(detail_transaksi.sub_total) as total_penjualan'))
        ->join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
        ->join('barang_titipan', 'barang_titipan.id_barang', '=', 'detail_transaksi.id_barang')
        ->join('penitip', 'penitip.id_penitip', '=', 'barang_titipan.id_penitip')
        ->whereMonth('transaksi.tanggal_transaksi', $targetMonth)
        ->whereYear('transaksi.tanggal_transaksi', $targetYear)
        ->whereRaw('LOWER(transaksi.status_transaksi) = ?', ['transaksi selesai'])
        ->groupBy('penitip.id_penitip', 'penitip.nama_penitip')
        ->orderByDesc('total_penjualan')
        ->get();

        if ($topSellers->isNotEmpty()) {
            $topSeller = $topSellers->first();

            Badge::create([
                'nama_badge' => 'Top Seller',
                'id_penitip' => $topSeller->id_penitip,
                'total_penjualan' => $topSeller->total_penjualan,
                'periode_pemberian' => $periodePemberian,
            ]);

            return redirect()->route('admin.topSeller')->with('success', 'Top Seller berhasil ditentukan.');
        }

        return response()->json(['message' => 'Tidak ada data transaksi untuk bulan lalu.']);
    }

    private function getTopSellerLastMonth()
    {
        $lastMonth = now()->subMonth();

        $topSeller = Transaksi::select('penitip.id_penitip', 'penitip.nama_penitip', DB::raw('SUM(detail_transaksi.sub_total) as total_penjualan'))
            ->join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->join('barang_titipan', 'barang_titipan.id_barang', '=', 'detail_transaksi.id_barang')
            ->join('penitip', 'penitip.id_penitip', '=', 'barang_titipan.id_penitip')
            ->whereMonth('transaksi.tanggal_transaksi', $lastMonth->month)
            ->whereYear('transaksi.tanggal_transaksi', $lastMonth->year)
            ->whereRaw('LOWER(transaksi.status_transaksi) = ?', ['transaksi selesai'])
            ->groupBy('penitip.id_penitip', 'penitip.nama_penitip')
            ->orderByDesc('total_penjualan')
            ->first();

            // dd($topSeller);
        return $topSeller; // Pastikan topSeller tidak null
    }

    private function getAllTopSellersHistory()
    {
        return Badge::where('nama_badge', 'Top Seller')
            ->with('penitip')
            ->orderByDesc('periode_pemberian')
            ->get();
    }

}
