@extends('pegawai_gudang.dashboard')

@section('isi')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0" role="alert" style="background: #dcfce7; color: #166534; border-radius: var(--radius-lg);">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('pegawai_gudang.barangTitipan.index') }}" class="btn btn-light border" style="border-radius: 12px; padding: 8px 16px;">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <h3 class="m-0 text-dark font-outfit">Detail Barang Titipan</h3>
    </div>
    
    <div class="d-flex gap-2">
        <a href="{{ route('pegawai_gudang.notaPenitipan.show', $barang->nota->id_nota) }}" class="btn border fw-bold bg-white text-dark" style="border-radius: var(--radius-pill);">
            <i class="bi bi-receipt me-1 text-primary"></i> Nota #{{ $barang->nota->no_nota }}
        </a>
        @php
            $isAvailable = strtolower($barang->status_barang) === 'tersedia';
        @endphp
        <a href="{{ $isAvailable ? route('pegawai_gudang.barangTitipan.edit', ['id' => $barang->id_barang, 'context' => 'detail']) : '#' }}"
           class="btn btn-warning fw-bold {{ $isAvailable ? '' : 'disabled' }}"
           style="border-radius: var(--radius-pill);"
           {{ $isAvailable ? '' : 'aria-disabled=true tabindex=-1' }}>
            <i class="bi bi-pencil-square me-1"></i> Edit Barang
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column: Details -->
    <div class="col-lg-8">
        <div class="card border-0 mb-4" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
            <div class="card-header bg-white border-bottom pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-outfit text-dark fw-bold"><i class="bi bi-info-circle text-primary me-2"></i>Informasi Utama</h5>
                
                @php
                    $status = strtolower($barang->status_barang);
                    $badgeClass = 'bg-secondary';
                    if ($status === 'tersedia') $badgeClass = 'bg-success';
                    elseif (in_array($status, ['terjual', 'diambil kembali', 'pengambilan diproses'])) $badgeClass = 'bg-danger';
                    elseif ($status === 'didonasikan') $badgeClass = 'bg-warning text-dark';
                    elseif ($status === 'barang untuk donasi') $badgeClass = 'bg-info text-dark';
                    elseif ($status === 'diperiksa') $badgeClass = 'bg-warning text-dark';
                @endphp
                <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2 fw-bold" style="font-size: 0.85rem;">
                    {{ $status === 'barang untuk donasi' ? 'Barang Untuk Donasi' : $barang->status_barang }}
                </span>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small text-uppercase fw-bold mb-1">Kode Barang</label>
                        <h5 class="text-primary fw-bold mb-0">{{ strtoupper(substr($barang->nama_barang, 0, 1)) . $barang->id_barang }}</h5>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small text-uppercase fw-bold mb-1">Nama Barang</label>
                        <h5 class="text-dark fw-bold mb-0">{{ $barang->nama_barang }}</h5>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small text-uppercase fw-bold mb-1">Kategori</label>
                        <p class="mb-0 fw-medium text-dark"><i class="bi bi-tag me-2 text-muted"></i>{{ $barang->kategori->nama_kategori ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small text-uppercase fw-bold mb-1">Harga Jual & Berat</label>
                        <p class="mb-0 fw-bold text-success">
                            Rp{{ number_format($barang->harga_jual, 0, ',', '.') }}
                            <span class="text-muted ms-2 fw-normal"><i class="bi bi-box me-1"></i>{{ $barang->berat }} kg</span>
                        </p>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="text-muted small text-uppercase fw-bold mb-1">Deskripsi</label>
                        <div class="bg-light p-3 rounded text-dark" style="text-align: justify; line-height: 1.6;">
                            {{ $barang->deskripsi ?: 'Tidak ada deskripsi.' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
            <div class="card-header bg-white border-bottom pt-4 pb-3 px-4">
                <h5 class="m-0 font-outfit text-dark fw-bold"><i class="bi bi-images text-primary me-2"></i>Foto Barang</h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex flex-row flex-nowrap overflow-auto py-2 gap-3 custom-scrollbar">
                    @forelse ($barang->fotoBarang as $index => $foto)
                        <div class="position-relative text-center flex-shrink-0">
                            <img src="{{ asset('images/barang/' . $foto->nama_file) }}" 
                                 class="rounded border shadow-sm"
                                 style="width: 180px; height: 180px; object-fit: cover; transition: transform 0.2s;"
                                 alt="Foto {{ $index + 1 }}"
                                 onmouseover="this.style.transform='scale(1.05)'"
                                 onmouseout="this.style.transform='scale(1)'">
                            <span class="position-absolute top-0 start-0 m-2 badge bg-dark opacity-75 rounded-pill">{{ $index + 1 }}</span>
                        </div>
                    @empty
                        <div class="w-100 text-center py-4 text-muted border rounded bg-light">
                            <i class="bi bi-image fs-1 d-block mb-2"></i>
                            Barang ini belum memiliki foto.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Timeline & People -->
    <div class="col-lg-4">
        <div class="card border-0 mb-4" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
            <div class="card-header bg-white border-bottom pt-4 pb-3 px-4">
                <h5 class="m-0 font-outfit text-dark fw-bold"><i class="bi bi-people text-primary me-2"></i>Pihak Terkait</h5>
            </div>
            <div class="card-body p-4">
                <div class="mb-4">
                    <label class="text-muted d-block small fw-bold text-uppercase mb-2">Penitip</label>
                    <div class="d-flex align-items-center p-2 rounded bg-light border">
                        <div class="bg-white rounded-circle border d-flex align-items-center justify-content-center text-primary fw-bold me-2 shadow-sm" style="width: 32px; height: 32px; font-size: 0.8rem;">
                            T{{ $barang->penitip->id_penitip }}
                        </div>
                        <span class="fw-bold text-dark">{{ $barang->penitip->nama_penitip ?? '-' }}</span>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-muted d-block small fw-bold text-uppercase mb-2">Pegawai QC</label>
                    <div class="d-flex align-items-center">
                        <div class="bg-secondary bg-opacity-10 rounded-circle text-secondary d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px;">
                            <i class="bi bi-person-check fs-5"></i>
                        </div>
                        <div>
                            <span class="d-block fw-bold text-dark">{{ $barang->pegawaiQc->nama_pegawai ?? '-' }}</span>
                            <span class="small text-muted">ID: P{{ $barang->pegawaiQc->id_pegawai ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="text-muted d-block small fw-bold text-uppercase mb-2">Hunter</label>
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-circle text-success d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px;">
                            <i class="bi bi-shop fs-5"></i>
                        </div>
                        <div>
                            @if ($barang->hunter)
                                <div class="d-flex align-items-center gap-2">
                                    <span class="d-block fw-bold text-dark">{{ $barang->hunter->nama_pegawai }}</span>
                                    <span class="badge bg-success" style="font-size: 0.6rem;">HUNTER</span>
                                </div>
                                <span class="small text-muted">ID: P{{ $barang->hunter->id_pegawai }}</span>
                            @else
                                <span class="d-block fw-medium text-muted">-</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
            <div class="card-header bg-white border-bottom pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-outfit text-dark fw-bold"><i class="bi bi-clock-history text-primary me-2"></i>Timeline</h5>
                @if($barang->status_perpanjangan)
                    <span class="badge badge-warning bg-warning text-dark"><i class="bi bi-arrow-repeat me-1"></i>Diperpanjang</span>
                @endif
            </div>
            <div class="card-body p-4">
                <ul class="list-unstyled mb-0 position-relative" style="padding-left: 20px;">
                    <!-- Line -->
                    <div class="position-absolute h-100 bg-light border-start border-2 border-primary" style="left: 5px; top: 0;"></div>
                    
                    <li class="mb-4 position-relative">
                        <i class="bi bi-circle-fill text-primary position-absolute" style="left: -21px; top: 2px; font-size: 10px;"></i>
                        <span class="d-block fw-bold text-dark mb-1">Tanggal Masuk</span>
                        <span class="text-muted small"><i class="bi bi-calendar-check me-1"></i>{{ \Carbon\Carbon::parse($barang->tanggal_masuk)->format('d/m/Y H:i') }}</span>
                    </li>
                    <li class="mb-4 position-relative">
                        <i class="bi bi-circle-fill text-danger position-absolute" style="left: -21px; top: 2px; font-size: 10px;"></i>
                        <span class="d-block fw-bold text-dark mb-1">Tanggal Akhir</span>
                        <span class="text-muted small"><i class="bi bi-calendar-x me-1"></i>{{ \Carbon\Carbon::parse($barang->tanggal_akhir)->format('d/m/Y H:i') }}</span>
                    </li>
                    <li class="mb-4 position-relative">
                        <i class="bi bi-circle-fill text-secondary position-absolute" style="left: -21px; top: 2px; font-size: 10px;"></i>
                        <span class="d-block fw-bold text-dark mb-1">Tanggal Keluar</span>
                        <span class="text-muted small">
                            @if($barang->tanggal_keluar)
                                <i class="bi bi-box-arrow-right me-1"></i>{{ \Carbon\Carbon::parse($barang->tanggal_keluar)->format('d/m/Y H:i') }}
                            @else
                                -
                            @endif
                        </span>
                    </li>
                    <li class="position-relative">
                        <i class="bi bi-shield-check text-success position-absolute bg-white" style="left: -23px; top: 0px; font-size: 14px;"></i>
                        <span class="d-block fw-bold text-dark mb-1">Garansi</span>
                        <span class="text-muted small">
                            @if($barang->garansi)
                                Berlaku s/d {{ \Carbon\Carbon::parse($barang->tanggal_garansi)->format('d M Y') }}
                            @else
                                Tidak ada garansi
                            @endif
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom scrollbar for horizontal image scroll */
    .custom-scrollbar::-webkit-scrollbar {
        height: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endsection
