@extends('owner.dashboard')
@section('isi')
<div class="container py-4">
    <h3 class="text-center"><strong>Laporan Transaksi Semua Penitip</strong></h3>

    <div class="mb-3">
        <p class="mb-1"><strong>Bulan:</strong> {{ $bulan }}</p>
        <p class="mb-1"><strong>Tahun:</strong> {{ $year }}</p>
        <p class="mb-1"><strong>Tanggal Cetak:</strong> {{ $tanggalCetak }}</p>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-sm text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID Penitip</th>
                    <th>Nama Penitip</th>
                    <th>Harga Jual Bersih</th>
                    <th>Bonus Terjual Cepat</th>
                    <th>Pendapatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekap as $row)
                    <tr>
                        <td>{{ $row['id_penitip'] }}</td>
                        <td>{{ $row['nama_penitip'] }}</td>
                        <td>{{ number_format($row['harga_jual_bersih'], 0, ',', '.') }}</td>
                        <td>{{ number_format($row['bonus_terjual_cepat'], 0, ',', '.') }}</td>
                        <td>{{ number_format($row['pendapatan'], 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('owner.laporan.transaksipenitip.download', [
                                'id_penitip' => $row['id_penitip'],
                                'month' => request('month', now()->month),
                                'year' => request('year', now()->year)
                            ]) }}" class="btn btn-sm btn-danger">
                                <i class="bi bi-file-earmark-pdf"></i> Download PDF
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Tidak ada data transaksi di bulan ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection