@extends('pegawai_gudang.dashboard')

@section('isi')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="m-0 text-dark font-outfit">Daftar Nota Penitipan</h3>
    <a href="{{ route('pegawai_gudang.barangTitipan.createBlank') }}" class="btn btn-primary" style="border-radius: var(--radius-pill); font-weight: 600;">
        <i class="bi bi-plus-lg me-1"></i> Tambah Penitipan
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0" role="alert" style="background: #dcfce7; color: #166534; border-radius: var(--radius-lg);">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
        <form class="d-flex gap-2 flex-wrap" action="{{ route('pegawai_gudang.notaPenitipan.index') }}" method="GET">
            <div class="input-group" style="width: 280px;">
                <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="bi bi-search text-muted"></i></span>
                <input class="form-control bg-light border-start-0 ps-0" type="search" name="search" placeholder="Cari nama penitip/nota..." value="{{ request('search') }}" style="border-radius: 0 12px 12px 0; font-size: 0.95rem;">
            </div>
            <input class="form-control" type="date" name="date" value="{{ request('date') }}" style="border-radius: 12px; width: 160px; font-size: 0.95rem;">
            <button class="btn btn-dark" type="submit" style="border-radius: 12px; font-weight: 600; background: var(--admin-secondary);"><i class="bi bi-funnel me-1"></i> Filter</button>
        </form>
    </div>
    
    <div class="card-body p-4">
        <div class="table-responsive" style="border-radius: 12px; border: 1px solid var(--admin-border);">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">
                    <tr>
                        <th class="fw-bold border-bottom-0 px-4 py-3">No Nota</th>
                        <th class="fw-bold border-bottom-0 py-3">Penitip</th>
                        <th class="fw-bold border-bottom-0 py-3">Tanggal Penitipan</th>
                        <th class="fw-bold border-bottom-0 py-3 text-center">Jumlah Barang</th>
                        <th class="fw-bold border-bottom-0 px-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($notas as $nota)
                    <tr>
                        <td class="fw-bold text-dark px-4">{{ $nota->no_nota }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                    T{{ $nota->penitip->id_penitip }}
                                </div>
                                <span class="fw-medium text-dark">{{ $nota->penitip->nama_penitip }}</span>
                            </div>
                        </td>
                        <td class="text-muted"><i class="bi bi-calendar-check me-2 text-primary"></i>{{ \Carbon\Carbon::parse($nota->tanggal_penitipan)->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-bold" style="font-size: 0.85rem;">{{ $nota->barang_titipan_count }} Item</span>
                        </td>
                        <td class="text-end px-4">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('pegawai_gudang.notaPenitipan.show', $nota->id_nota) }}" class="btn btn-sm btn-light fw-bold" style="border-radius: 8px;" title="Lihat Detail">
                                    <i class="bi bi-eye text-primary"></i>
                                </a>
                                <a href="{{ route('pegawai_gudang.notaPenitipan.print', $nota->id_nota) }}" class="btn btn-sm btn-danger fw-bold" style="border-radius: 8px;" title="Cetak PDF">
                                    <i class="bi bi-file-pdf"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            <i class="bi bi-receipt fs-1 d-block mb-3 text-light"></i>
                            Belum ada nota penitipan ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-4">
            {{ $notas->appends(['search'=>request('search')])->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
