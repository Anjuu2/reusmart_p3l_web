@extends('pegawai_gudang.dashboard')

@section('isi')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="m-0 text-dark font-outfit">Daftar Barang Titipan</h3>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0" role="alert" style="background: #dcfce7; color: #166534; border-radius: var(--radius-lg);">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <form class="d-flex gap-2 flex-wrap" action="{{ route('pegawai_gudang.barangTitipan.index') }}" method="GET">
            <div class="input-group" style="width: 280px;">
                <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="bi bi-search text-muted"></i></span>
                <input class="form-control bg-light border-start-0 ps-0" type="search" name="search" placeholder="Cari nama barang..." value="{{ request('search') }}" style="border-radius: 0 12px 12px 0; font-size: 0.95rem;">
            </div>
            <input class="form-control" type="date" name="date" value="{{ request('date') }}" style="border-radius: 12px; width: 160px; font-size: 0.95rem;">
            <button class="btn btn-primary" type="submit" style="border-radius: 12px; font-weight: 600;"><i class="bi bi-funnel me-1"></i> Filter</button>
        </form>
    </div>
    
    <div class="card-body p-4">
        <div class="table-responsive" style="border-radius: 12px; border: 1px solid var(--admin-border);">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">
                    <tr>
                        <th class="fw-bold border-bottom-0 px-4 py-3">Kode</th>
                        <th class="fw-bold border-bottom-0 py-3">Nama Barang</th>
                        <th class="fw-bold border-bottom-0 py-3">Kategori</th>
                        <th class="fw-bold border-bottom-0 py-3">Status</th>
                        <th class="fw-bold border-bottom-0 py-3">Penitip</th>
                        <th class="fw-bold border-bottom-0 px-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($barang as $item)
                    <tr>
                        <td class="fw-bold text-secondary px-4">{{ strtoupper(substr($item->nama_barang, 0, 1)) . $item->id_barang }}</td>
                        <td class="fw-bold text-dark">{{ $item->nama_barang }}</td>
                        <td class="text-muted">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                        <td>
                            @php
                                $statusClass = 'bg-secondary';
                                if($item->status_barang == 'Diperiksa') $statusClass = 'bg-warning text-dark';
                                elseif($item->status_barang == 'Tersedia') $statusClass = 'bg-success';
                                elseif($item->status_barang == 'Terjual') $statusClass = 'bg-info text-dark';
                                elseif($item->status_barang == 'Ditolak') $statusClass = 'bg-danger';
                            @endphp
                            <span class="badge {{ $statusClass }} rounded-pill px-3 py-2 fw-bold" style="font-size: 0.75rem;">{{ $item->status_barang }}</span>
                        </td>
                        <td><span class="text-muted fw-medium me-1">T{{ $item->penitip->id_penitip}}</span> {{ $item->penitip->nama_penitip ?? '-' }}</td>
                        <td class="text-end px-4">
                            <a href="{{ route('pegawai_gudang.barangTitipan.showDetail', $item->id_barang) }}" class="btn btn-sm btn-light fw-bold" style="border-radius: 8px;">
                                <i class="bi bi-eye text-primary"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                            Belum ada barang titipan ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-4">
            {{ $barang->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
