@extends('owner.dashboard')
@section('isi')
<div class="container py-4">
    <h4 class="mb-4">Histori Donasi - {{ $organisasi->nama_organisasi }}</h4>
    <table class="table table-bordered text-center">
        <thead><tr><th>Barang</th><th>Tanggal Donasi</th><th>Penerima</th></tr></thead>
        <tbody>
        @forelse($donasiHistori as $d)
            <tr>
                <td>{{ $d->barang_titipan->nama_barang ?? '-' }}</td>
                <td>{{ $d->tanggal_donasi->format('d M Y') }}</td>
                <td>{{ $d->penerima }}</td>
            </tr>
        @empty
            <tr><td colspan="3">Belum ada donasi</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
