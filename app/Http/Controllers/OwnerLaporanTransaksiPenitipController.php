<?php

namespace App\Http\Controllers;

use App\Models\BarangTitipan;
use App\Models\Penitip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class OwnerLaporanTransaksiPenitipController extends Controller
{
    /**
     * Index menampilkan semua penitip beserta rekap transaksi.
     */
    public function index(Request $request)
    {
        $month = $request->query('month', Carbon::now()->month);
        $year = $request->query('year', Carbon::now()->year);

        $penitips = Penitip::with(['barang_titipans' => function ($query) use ($month, $year) {
            $query->where('status_barang', 'Terjual')
                ->whereYear('tanggal_keluar', $year)
                ->whereMonth('tanggal_keluar', $month);
        }])->paginate(10);

        $rekap = $penitips->map(function ($penitip) {
            $totalHargaJualBersih = 0;
            $totalBonus = 0;
            $totalPendapatan = 0;

            foreach ($penitip->barang_titipans as $item) {
                $komisiRate = $item->status_perpanjangan ? 0.30 : 0.20;
                $hargaJualBersih = $item->harga_jual * (1 - $komisiRate);
                $bonus = (!$item->status_perpanjangan && $item->tanggal_masuk->diffInDays($item->tanggal_keluar) < 7)
                    ? ($item->harga_jual * 0.10 * (1 - $komisiRate))
                    : 0;
                $pendapatan = $hargaJualBersih + $bonus;

                $totalHargaJualBersih += $hargaJualBersih;
                $totalBonus += $bonus;
                $totalPendapatan += $pendapatan;
            }

            return [
                'id_penitip' => $penitip->id_penitip,
                'nama_penitip' => $penitip->nama_penitip,
                'harga_jual_bersih' => $totalHargaJualBersih,
                'bonus_terjual_cepat' => $totalBonus,
                'pendapatan' => $totalPendapatan,
            ];
        });

        $bulanNama = Carbon::createFromDate($year, $month, 1)->locale('id')->isoFormat('MMMM');

        return view('owner.laporan.transaksiPenitipIndex', [
            'rekap' => $rekap,
            'penitips' => $penitips,
            'bulan' => ucfirst($bulanNama),
            'year' => $year,
            'tanggalCetak' => Carbon::today()->locale('id')->isoFormat('DD MMMM YYYY'),
        ]);
    }

    /**
     * Download PDF laporan transaksi per penitip.
     */
    public function downloadPDF(Request $request)
    {
        $idPenitip = $request->query('id_penitip');
        $month = $request->query('month', Carbon::now()->month);
        $year = $request->query('year', Carbon::now()->year);

        if (!$idPenitip) {
            abort(404, 'ID Penitip tidak boleh kosong.');
        }

        $penitip = Penitip::findOrFail($idPenitip);

        $transaksi = BarangTitipan::where('id_penitip', $idPenitip)
            ->where('status_barang', 'Terjual')
            ->whereYear('tanggal_keluar', $year)
            ->whereMonth('tanggal_keluar', $month)
            ->orderBy('tanggal_keluar', 'asc')
            ->get();

        $laporan = $transaksi->map(function ($item) {
            $komisiRate = $item->status_perpanjangan ? 0.30 : 0.20;
            $hargaJualBersih = $item->harga_jual * (1 - $komisiRate);
            $bonus = (!$item->status_perpanjangan && $item->tanggal_masuk->diffInDays($item->tanggal_keluar) < 7)
                ? ($item->harga_jual * 0.10 * (1 - $komisiRate))
                : 0;
            $pendapatan = $hargaJualBersih + $bonus;

            return [
                'kode' => strtoupper(substr($item->nama_barang, 0, 1)) . $item->id_barang,
                'nama' => $item->nama_barang,
                'tanggal_masuk' => $item->tanggal_masuk->format('d/m/Y'),
                'tanggal_laku' => $item->tanggal_keluar->format('d/m/Y'),
                'harga_jual_bersih' => $hargaJualBersih,
                'bonus_terjual_cepat' => $bonus,
                'pendapatan' => $pendapatan,
            ];
        });

        $bulanNama = Carbon::createFromDate($year, $month, 1)->locale('id')->isoFormat('MMMM');

        $pdf = PDF::loadView('owner.laporan.transaksiPenitipPdf', [
            'penitip' => $penitip,
            'laporan' => $laporan,
            'bulan' => ucfirst($bulanNama),
            'year' => $year,
            'tanggalCetak' => Carbon::today()->locale('id')->isoFormat('DD MMMM YYYY'),
        ])->setPaper('a4', 'portrait')
          ->setOptions(['enable-local-file-access' => true]);

        return $pdf->download("Laporan_Transaksi_Penitip_{$penitip->nama_penitip}_{$bulanNama}_{$year}.pdf");
    }
}
