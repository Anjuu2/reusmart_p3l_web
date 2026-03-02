@extends('pegawai_gudang.dashboard')

@section('isi')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('pegawai_gudang.notaPenitipan.index') }}" class="btn btn-light border" style="border-radius: 12px; padding: 8px 16px;">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <h3 class="m-0 text-dark font-outfit">Detail Nota Penitipan</h3>
    </div>
    <a href="{{ route('pegawai_gudang.notaPenitipan.print', $nota->id_nota) }}" class="btn btn-danger" style="border-radius: var(--radius-pill); font-weight: 600;">
        <i class="bi bi-file-pdf me-1"></i> Cetak PDF
    </a>
</div>

<div class="row g-4 mb-4">
    <!-- Info Nota -->
    <div class="col-md-5 col-lg-4">
        <div class="card border-0 h-100" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); background: linear-gradient(145deg, #ffffff, #f8fafc);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; font-size: 1.5rem;">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 font-outfit text-dark fw-bold">Nota #{{ $nota->no_nota }}</h5>
                        <p class="mb-0 text-muted small">Informasi Utama</p>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-muted small fw-bold text-uppercase mb-1 d-block">Penitip</label>
                    <div class="d-flex align-items-center p-2 rounded bg-light border">
                        <div class="bg-white rounded-circle border d-flex align-items-center justify-content-center text-primary fw-bold me-2 shadow-sm" style="width: 32px; height: 32px; font-size: 0.8rem;">
                            T{{ $nota->penitip->id_penitip }}
                        </div>
                        <span class="fw-bold text-dark">{{ $nota->penitip->nama_penitip }}</span>
                    </div>
                </div>

                <div class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                    <span class="text-muted"><i class="bi bi-calendar-event me-2"></i>Tanggal Titip</span>
                    <span class="fw-bold text-dark">{{ \Carbon\Carbon::parse($nota->tanggal_penitipan)->format('d/m/Y H:i') }}</span>
                </div>
                
                <div class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                    <span class="text-muted"><i class="bi bi-calendar-x me-2"></i>Masa Berakhir</span>
                    <span class="fw-bold text-danger">{{ \Carbon\Carbon::parse($nota->masa_berakhir)->format('d/m/Y') }}</span>
                </div>

                <div class="d-flex justify-content-between align-items-center pt-2">
                    <span class="text-muted"><i class="bi bi-person-check me-2"></i>QC Oleh</span>
                    <span class="fw-medium text-dark"><span class="text-muted small me-1">P{{ $nota->pegawaiQc->id_pegawai }}</span>{{ $nota->pegawaiQc->nama_pegawai }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Barang -->
    <div class="col-md-7 col-lg-8">
        <div class="card border-0 h-100" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
            <div class="card-header bg-white border-bottom pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-outfit text-dark fw-bold"><i class="bi bi-box-seam text-primary me-2"></i>Daftar Barang</h5>
                <span class="badge bg-light text-dark border rounded-pill px-3">{{ $nota->barangTitipan->count() }} Item Titipan</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="border-bottom-left-radius: var(--radius-lg); border-bottom-right-radius: var(--radius-lg);">
                    <table class="table table-hover align-middle mb-0 border-0">
                        <thead class="table-light text-muted" style="font-size: 0.8rem; text-transform: uppercase;">
                            <tr>
                                <th class="border-bottom px-4 py-3">Barang & Kategori</th>
                                <th class="border-bottom py-3">Harga & Berat</th>
                                <th class="border-bottom py-3 text-center">Status</th>
                                <th class="border-bottom px-4 py-3 text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @forelse($nota->barangTitipan as $barang)
                            <tr>
                                <td class="px-4">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-dark">{{ $barang->nama_barang }}</span>
                                        <div class="d-flex gap-2 align-items-center mt-1">
                                            <span class="text-primary fw-bold" style="font-size: 0.75rem;">{{ strtoupper(substr($barang->nama_barang, 0, 1)) . $barang->id_barang }}</span>
                                            <span class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-tag-fill me-1"></i>{{ $barang->kategori->nama_kategori }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-success">Rp{{ number_format($barang->harga_jual, 0, ',', '.') }}</span>
                                        <span class="text-muted" style="font-size: 0.8rem;"><i class="bi bi-box me-1"></i>{{ $barang->berat }} kg</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @php
                                        $statusClass = 'bg-secondary';
                                        if($barang->status_barang == 'Diperiksa') $statusClass = 'bg-warning text-dark';
                                        elseif($barang->status_barang == 'Tersedia') $statusClass = 'bg-success';
                                        elseif($barang->status_barang == 'Terjual') $statusClass = 'bg-info text-dark';
                                        elseif($barang->status_barang == 'Ditolak') $statusClass = 'bg-danger';
                                    @endphp
                                    <span class="badge {{ $statusClass }} rounded-pill px-3 py-2 fw-bold" style="font-size: 0.7rem; display: block; width: 100px; margin: 0 auto;">{{ $barang->status_barang }}</span>
                                    
                                    @if($barang->garansi && $barang->tanggal_garansi)
                                        <span class="d-block text-muted mt-1" style="font-size: 0.7rem;"><i class="bi bi-shield-check text-success me-1"></i>{{ \Carbon\Carbon::parse($barang->tanggal_garansi)->format('M Y') }}</span>
                                    @endif
                                </td>
                                <td class="text-end px-4">
                                    <a href="{{ route('pegawai_gudang.barangTitipan.showDetail', $barang->id_barang) }}" class="btn btn-sm btn-light fw-bold" style="border-radius: 8px;">
                                        <i class="bi bi-eye text-primary"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox fs-2 d-block mb-3 text-light"></i>
                                    Belum ada barang di nota ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
