<?php

namespace App\Http\Controllers;

// use App\Models\DetailTransaksi;
// use App\Models\Transaksi;
use App\Models\BarangTitipan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Http; 

class OwnerLaporanController extends Controller
{

    public function index(Request $request)
    {
        // Ambil tahun dari query string, default = tahun sekarang
        $year = $request->query('year', Carbon::now()->year);

        // Inisialisasi array per bulan
        $dataByMonth = [];
        for ($m = 1; $m <= 12; $m++) {
            $dataByMonth[$m] = [
                'month' => Carbon::createFromDate($year, $m, 1)->format('M'),
                'count' => 0,
                'gross' => 0,
            ];
        }

        // Ambil semua barang yang terjual di tahun tersebut
        $soldItems = BarangTitipan::where('status_barang', 'Terjual')
            ->whereYear('tanggal_keluar', $year)
            ->get(['harga_jual', 'tanggal_keluar']);

        // Hitung per bulan
        foreach ($soldItems as $item) {
            $monthIndex = Carbon::parse($item->tanggal_keluar)->month;
            $dataByMonth[$monthIndex]['count'] += 1;
            $dataByMonth[$monthIndex]['gross'] += $item->harga_jual;
        }

        return view('owner.laporan.penjualan', [
            'dataByMonth' => $dataByMonth,
            'year'        => $year,
        ]);
    }

    public function downloadPDF(Request $request)
    {
        $year = $request->query('year', Carbon::now()->year);

        // 1. Kumpulkan data penjualan per bulan
        $dataByMonth = [];
        for ($m = 1; $m <= 12; $m++) {
            $dataByMonth[$m] = [
                // set locale ke 'id' lalu ambil nama bulan penuh (MMMM)
                'month' => Carbon::createFromDate($year, $m, 1)
                                ->locale('id')
                                ->isoFormat('MMMM'),    // “Januari”, “Februari”, “Maret”, …
                'count' => 0,
                'gross' => 0,
            ];
        }

        $soldItems = BarangTitipan::where('status_barang', 'Terjual')
            ->whereYear('tanggal_keluar', $year)
            ->get(['harga_jual', 'tanggal_keluar']);

        foreach ($soldItems as $item) {
            $mIdx = Carbon::parse($item->tanggal_keluar)->month;
            $dataByMonth[$mIdx]['count'] += 1;
            $dataByMonth[$mIdx]['gross'] += $item->harga_jual;
        }

        // 2. Buat konfigurasi Chart.js sederhana untuk QuickChart
        $labels = array_column($dataByMonth, 'month');
        $dataCount = array_column($dataByMonth, 'count');
        $dataGross = array_column($dataByMonth, 'gross');

        $chartConfig = [
            'type' => 'bar',
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label'           => 'Jumlah Terjual',
                        'data'            => $dataCount,
                        'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                        'borderColor'     => 'rgba(54, 162, 235, 1)',
                        'borderWidth'     => 1,
                    ],
                    [
                        'label'           => 'Penjualan Kotor (Rp)',
                        'data'            => $dataGross,
                        'backgroundColor' => 'rgba(255, 99, 132, 0.6)',
                        'borderColor'     => 'rgba(255, 99, 132, 1)',
                        'borderWidth'     => 1,
                    ],
                ],
            ],
            'options' => [
                'responsive' => false, // ukuran tetap
                'scales'     => [
                    'y' => [
                        'beginAtZero' => true,
                    ],
                ],
            ],
        ];

        // 3. Panggil QuickChart untuk menghasilkan PNG
        //    Endpoint QuickChart (tanpa API key) = https://quickchart.io/chart
        $quickChartUrl = 'https://quickchart.io/chart';
        $query = http_build_query([
            'c'   => json_encode($chartConfig),
            'w'   => 800, // lebar gambar
            'h'   => 400, // tinggi gambar
            'format' => 'png',
        ]);
        $url = "{$quickChartUrl}?{$query}";

        // Ambil data PNG dari QuickChart
        $pngData = @file_get_contents($url);
        if ($pngData === false) {
            // Jika gagal, kita bisa fallback ke string kosong atau grafik kosong
            $chartBase64 = null;
        } else {
            // Encode ke base64
            $chartBase64 = base64_encode($pngData);
        }

        // 4. Render view menjadi HTML, passing data
        $pdfView = view('owner.laporan.penjualan-pdf', [
            'dataByMonth' => $dataByMonth,
            'year'        => $year,
            'chartBase64'=> $chartBase64, // kirim base64 string
        ])->render();

        // 5. Buat PDF
        $pdf = PDF::loadHTML($pdfView)
            ->setOptions([
                'no-outline'               => true,
                'enable-javascript'        => false, // tidak perlu JS
                'enable-local-file-access' => true,
            ])
            ->setPaper('a4', 'portrait');

        $filename = "Laporan_Penjualan_Bulanan_{$year}.pdf";
        return $pdf->download($filename);
    }

    // public function index()
    // {
    //     $tahun = 2024;

    //     $dataBulanan = DetailTransaksi::selectRaw('
    //             MONTH(transaksi.tanggal_transaksi) as bulan,
    //             COUNT(detail_transaksi.id_barang) as jumlah_barang,
    //             SUM(detail_transaksi.sub_total) as total_penjualan
    //         ')
    //         ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
    //         ->whereYear('transaksi.tanggal_transaksi', $tahun)
    //         ->groupBy(DB::raw('MONTH(transaksi.tanggal_transaksi)'))
    //         ->get();

    //     // Data untuk chart dan tabel
    //     $dataPerBulan = collect(range(1, 12))->map(function ($bulan) use ($dataBulanan) {
    //         $data = $dataBulanan->firstWhere('bulan', $bulan);
    //         return [
    //             'bulan' => Carbon::create()->month($bulan)->locale('id')->isoFormat('MMMM'),
    //             'jumlah_barang' => $data->jumlah_barang ?? 0,
    //             'total_penjualan' => $data->total_penjualan ?? 0,
    //         ];
    //     });

    //     return view('owner.laporan_penjualan', compact('dataPerBulan', 'tahun'));
    // }

    // public function downloadPDF()
    // {
    //     $tahun = 2024;

    //     $dataBulanan = DetailTransaksi::selectRaw('
    //             MONTH(transaksi.tanggal_transaksi) as bulan,
    //             COUNT(detail_transaksi.id_barang) as jumlah_barang,
    //             SUM(detail_transaksi.sub_total) as total_penjualan
    //         ')
    //         ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
    //         ->whereYear('transaksi.tanggal_transaksi', $tahun)
    //         ->groupBy(DB::raw('MONTH(transaksi.tanggal_transaksi)'))
    //         ->get();

    //     $dataPerBulan = collect(range(1, 12))->map(function ($bulan) use ($dataBulanan) {
    //         $data = $dataBulanan->firstWhere('bulan', $bulan);
    //         return [
    //             'bulan' => Carbon::create()->month($bulan)->locale('id')->isoFormat('MMMM'),
    //             'jumlah_barang' => $data->jumlah_barang ?? 0,
    //             'total_penjualan' => $data->total_penjualan ?? 0,
    //         ];
    //     });

    //     $pdf = Pdf::loadView('owner.laporan_penjualan_pdf', compact('dataPerBulan', 'tahun'));
    //     return $pdf->download('Laporan_Penjualan_Bulanan_'.$tahun.'.pdf');
    // }
}