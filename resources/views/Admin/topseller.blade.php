@extends('Admin.dashboard')

@section('isi')
<div class="container">
    <h2 class="text-center my-4 mt-4 text-primary">🏆 Top Seller Bulan Ini</h2>

    {{-- Menampilkan Pesan Peringatan --}}
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Top Seller Bulan Berjalan --}}
    <div class="card shadow-sm border-primary mb-4">
        <div class="card-header bg-info text-white">
            Top Seller Bulan Berjalan
        </div>
        <div class="card-body">
            @if($topSeller)
                <h5 class="card-title text-success">{{ $topSeller->nama_penitip ?? 'Tidak ada' }}</h5>
                <p class="card-text">Total Penjualan: <strong>Rp {{ number_format($topSeller->total_penjualan, 2) }}</strong></p>
            @else
                <p class="text-danger">Tidak ada Top Seller bulan ini.</p>
            @endif
        </div>
    </div>

    @if($rankingThisMonth->count())
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-info text-white">
            Daftar Penitip Berdasarkan Total Penjualan Bulan Ini
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Peringkat</th>
                        <th>Nama Penitip</th>
                        <th>Total Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rankingThisMonth as $index => $seller)
                        <tr @if($topSeller && $topSeller->id_penitip == $seller->id_penitip) class="table-success" @endif>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $seller->nama_penitip }}</td>
                            <td>Rp {{ number_format($seller->total_penjualan, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- Tombol Tentukan Top Seller Bulan Lalu --}}
    <form id="topSellerForm" action="{{ route('admin.setTopSellerLastMonth') }}" method="POST" class="text-start mb-4">
        @csrf
        <button type="submit" class="btn btn-outline-primary btn-lg">Tentukan Top Seller</button>
    </form>
    
    <h2 class="text-center text-secondary my-4">📊 Riwayat Top Saller</h2>

    @if($historyTopSellers->count())
        <div class="card mt-2 shadow">
            <div class="card-header bg-dark text-white">
                🗓️ Riwayat Top Seller
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Nama Penitip</th>
                            <th>Total Penjualan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($historyTopSellers as $badge)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($badge->periode_pemberian)->locale('id')->subMonth()->translatedFormat('F Y') }}</td>
                            <td>{{ $badge->penitip->nama_penitip ?? 'Tidak Diketahui' }}</td>
                            <td>Rp {{ number_format($badge->total_penjualan ?? 0, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
@endsection
