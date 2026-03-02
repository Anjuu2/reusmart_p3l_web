@extends('pegawai_gudang.dashboard')

@section('isi')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="m-0 text-dark font-outfit">Daftar Barang Pengembalian</h3>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0" role="alert" style="background: #dcfce7; color: #166534; border-radius: var(--radius-lg);">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0" role="alert" style="background: #fee2e2; color: #991b1b; border-radius: var(--radius-lg);">
        <div class="d-flex align-items-center mb-2">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Terjadi Kesalahan!</strong>
        </div>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
        <form class="d-flex gap-2 flex-wrap" action="{{ route('pegawai_gudang.barang.pengembalian') }}" method="GET">
            <div class="input-group" style="width: 280px;">
                <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="bi bi-search text-muted"></i></span>
                <input class="form-control bg-light border-start-0 ps-0" type="search" name="search" placeholder="Cari barang pengembalian..." value="{{ request('search') }}" style="border-radius: 0 12px 12px 0; font-size: 0.95rem;">
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
                        <th class="fw-bold border-bottom-0 px-4 py-3">Kode Barang</th>
                        <th class="fw-bold border-bottom-0 py-3">Nama Barang</th>
                        <th class="fw-bold border-bottom-0 py-3">Penitip</th>
                        <th class="fw-bold border-bottom-0 py-3 text-center">Tanggal Masuk</th>
                        <th class="fw-bold border-bottom-0 py-3 text-center">Tanggal Akhir</th>
                        <th class="fw-bold border-bottom-0 py-3 text-end">Harga Jual</th>
                        <th class="fw-bold border-bottom-0 py-3 text-center">Status</th>
                        <th class="fw-bold border-bottom-0 px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($barang as $item)
                        <tr>
                            <td class="fw-bold text-secondary px-4">{{ strtoupper(substr($item->nama_barang, 0, 1)) . $item->id_barang }}</td>
                            <td class="fw-bold text-dark">{{ $item->nama_barang }}</td>
                            <td>
                                <span class="fw-medium text-dark">{{ $item->penitip->nama_penitip ?? '-' }}</span>
                            </td>
                            <td class="text-center text-muted">
                                {{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}
                            </td>
                            <td class="text-center text-danger fw-medium">
                                {{ $item->tanggal_akhir ? \Carbon\Carbon::parse($item->tanggal_akhir)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="text-end fw-bold text-success">
                                Rp{{ number_format($item->harga_jual, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fw-bold" style="font-size: 0.75rem;">{{ $item->status_barang }}</span>
                            </td>
                            <td class="text-center px-4">
                                <form action="{{ route('pegawai_gudang.barang.konfirmasiPengembalian', ['id_barang' => $item->id_barang]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin mengkonfirmasi pengembalian barang ini ke pemiliknya?');">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-dark fw-bold" style="border-radius: 8px;">
                                        <i class="bi bi-check2-circle me-1"></i> Konfirmasi
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="bi bi-box-seam fs-1 d-block mb-3 text-light"></i>
                                Tidak ada barang dalam proses pengembalian saat ini.
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
