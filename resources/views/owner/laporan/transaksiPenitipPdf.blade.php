@extends('owner.dashboard')
@section('isi')
<div class="container py-4">
    <h3 class="text-center"><strong>Laporan Transaksi Penitip</strong></h3>

    <div class="mb-3">
        <p class="mb-1"><strong>ID Penitip:</strong> {{ $penitip->id_penitip }}</p>
        <p class="mb-1"><strong>Nama Penitip:</strong> {{ $penitip->nama_penitip }}</p>
        <p class="mb-1"><strong>Bulan:</strong> {{ $bulan }}</p>
        <p class="mb-1"><strong>Tahun:</strong> {{ $year }}</p>
        <p class="mb-1"><strong>Tanggal Cetak:</strong> {{ $tanggalCetak }}</p>
    </div>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('owner.laporan.transaksipenitip.download', [
            'id_penitip' => $penitip->id_penitip,
            'month' => request('month', now()->month),
            'year' => request('year', now()->year)
        ]) }}" class="btn btn-sm btn-danger">
            <i class="bi bi-file-earmark-pdf"></i> Unduh PDF
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-sm text-center">
            <thead class="table-dark">
                <tr>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Laku</th>
                    <th>Harga Jual Bersih (sudah dipotong Komisi)</th>
                    <th>Bonus terjual cepat</th>
                    <th>Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan as $item)
                    <tr>
                        <td>{{ $item['kode'] }}</td>
                        <td class="text-start">{{ $item['nama'] }}</td>
                        <td>{{ $item['tanggal_masuk'] }}</td>
                        <td>{{ $item['tanggal_laku'] }}</td>
                        <td>{{ number_format($item['harga_jual_bersih'], 0, ',', '.') }}</td>
                        <td>{{ number_format($item['bonus_terjual_cepat'], 0, ',', '.') }}</td>
                        <td>{{ number_format($item['pendapatan'], 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Tidak ada transaksi di bulan ini.</td>
                    </tr>
                @endforelse
            </tbody>
            @if($laporan->count())
            <tfoot>
                <tr class="fw-bold">
                    <td colspan="4">TOTAL</td>
                    <td>{{ number_format(collect($laporan)->sum('harga_jual_bersih'), 0, ',', '.') }}</td>
                    <td>{{ number_format(collect($laporan)->sum('bonus_terjual_cepat'), 0, ',', '.') }}</td>
                    <td>{{ number_format(collect($laporan)->sum('pendapatan'), 0, ',', '.') }}</td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>
@endsection
