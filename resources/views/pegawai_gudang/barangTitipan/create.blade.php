@extends('pegawai_gudang.dashboard')
@section('isi')

@php
    $pegawai = auth()->guard('pegawai')->user();
@endphp

<style>
    /* Styling for image upload preview to match sleek UI */
    #preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 15px;
    }
    #preview-container img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid var(--admin-border);
        box-shadow: var(--shadow-sm);
        transition: transform 0.2s;
    }
    #preview-container img:hover {
        transform: scale(1.05);
        border-color: var(--admin-accent);
    }
    .form-label {
        font-weight: 600;
        color: var(--admin-text-main);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.6rem 1rem;
        border-color: var(--admin-border);
        font-size: 0.95rem;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--admin-primary);
        box-shadow: 0 0 0 0.25rem rgba(15, 23, 42, 0.1);
    }
    .custom-section {
        background: #f8fafc;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid var(--admin-border);
        margin-bottom: 24px;
    }
    .custom-section-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--admin-primary);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-3">
        <h3 class="m-0 text-dark font-outfit">Tambah Barang Titipan</h3>
    </div>
    <div class="text-end">
        <p class="mb-0 text-muted small fw-bold text-uppercase">Petugas Input</p>
        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill"><i class="bi bi-person-badge me-1"></i> P{{ $pegawai->id_pegawai }} - {{ $pegawai->nama_pegawai }}</span>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0" role="alert" style="background: #fee2e2; color: #991b1b; border-radius: var(--radius-lg);">
        <div class="d-flex align-items-center mb-2">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
            <strong>Terjadi Kesalahan Input!</strong>
        </div>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row g-4">
    <!-- Form Tambah Barang -->
    <div class="col-xl-8">
        <div class="card border-0 mb-4" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
            <div class="card-header bg-white border-bottom pt-4 pb-3 px-4">
                <h5 class="m-0 font-outfit text-dark fw-bold"><i class="bi bi-box-seam text-primary me-2"></i>Form Detail Barang</h5>
            </div>
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('pegawai_gudang.barangTitipan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_nota" value="{{ $nota->id_nota }}">
                    <input type="hidden" name="id_penitip" value="{{ $penitip->id_penitip }}">

                    <!-- Info Meta Nota -->
                    <div class="custom-section">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase mb-1">No Nota Referensi</label>
                                <div class="d-flex align-items-center p-2 rounded bg-white border">
                                    <i class="bi bi-receipt text-primary ms-2 me-2"></i>
                                    <span class="fw-bold text-dark">{{ $nota->no_nota }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase mb-1">Data Penitip</label>
                                <div class="d-flex align-items-center p-2 rounded bg-white border">
                                    <span class="badge bg-light text-primary border rounded-pill me-2">T{{ $penitip->id_penitip }}</span>
                                    <span class="fw-bold text-dark">{{ $penitip->nama_penitip }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="custom-section-title mt-4"><i class="bi bi-people text-muted"></i> Penugasan Staff</div>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="id_qc_pegawai" class="form-label">Pegawai Quality Control (QC)</label>
                            <input type="hidden" name="id_qc_pegawai" value="{{ old('id_qc_pegawai', $nota->id_qc_pegawai ?? '') }}">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="bi bi-person-check border-0"></i></span>
                                <input type="text" class="form-control bg-light" readonly
                                    value="{{ ($pegawaiQCUser = $pegawaiQc->firstWhere('id_pegawai', old('id_qc_pegawai', $nota->id_qc_pegawai ?? ''))) ? 'P' . $pegawaiQCUser->id_pegawai . ' - ' . $pegawaiQCUser->nama_pegawai : '-' }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Hunter Terlibat</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white text-muted"><i class="bi bi-shop border-0"></i></span>
                                <select name="id_hunter" class="form-select">
                                    <option value="">-- Tidak Berasal dari Hunter --</option>
                                    @foreach ($pegawaiHunter as $hunter)
                                        <option value="{{ $hunter->id_pegawai }}">P{{ $hunter->id_pegawai }} - {{ $hunter->nama_pegawai }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="custom-section-title mt-4"><i class="bi bi-box text-muted"></i> Informasi Fisik Barang</div>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="nama_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" name="nama_barang" class="form-control" required value="{{ old('nama_barang') }}" placeholder="Contoh: Kulkas Samsung 2 Pintu">
                        </div>

                        <div class="col-md-6">
                            <label for="id_kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select name="id_kategori" class="form-select" required>
                                <option value="">-- Pilih Kategori Utama --</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="berat" class="form-label">Berat Estimasi <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.01" name="berat" class="form-control" required value="{{ old('berat') }}" placeholder="0.00">
                                <span class="input-group-text bg-light">kg</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="harga_jual" class="form-label">Taksiran Harga Jual <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" name="harga_jual" class="form-control" required value="{{ old('harga_jual') }}" placeholder="0">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="deskripsi" class="form-label">Deskripsi Lengkap Kondisi Barang</label>
                            <textarea name="deskripsi" rows="3" class="form-control" placeholder="Tuliskan kondisi fisik, cacat (jika ada), kelengkapan, dll...">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>

                    <div class="custom-section-title mt-4"><i class="bi bi-shield-check text-muted"></i> Asuransi & Status</div>
                    <div class="row g-4 mb-4 custom-section border-0" style="background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.02)">
                        <div class="col-md-6">
                            <label class="form-label">Ketersediaan Garansi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-shield-plus text-success"></i></span>
                                <select name="garansi" class="form-select">
                                    <option value="1">Tersedia garansi produsen/toko</option>
                                    <option value="0">Tidak memiliki garansi</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal_garansi" class="form-label">Tanggal Akhir Garansi</label>
                            <input type="date" name="tanggal_garansi" class="form-control text-muted" value="{{ old('tanggal_garansi') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status Barang Sistem</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-record-circle text-primary"></i></span>
                                <input type="text" name="status_barang" class="form-control bg-light" value="{{ old('status_barang', 'Tersedia') }}" required readonly>
                            </div>
                            <small class="text-muted d-block mt-1">Status otomatis saat pertama ditambahkan.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Perpanjangan Kontrak</label>
                            <select name="status_perpanjangan" class="form-select">
                                <option value="0">Tidak Diperpanjang</option>
                                <option value="1">Diperpanjang</option>
                            </select>
                        </div>
                    </div>

                    <div class="custom-section-title mt-4"><i class="bi bi-calendar-range text-muted"></i> Timeline Penjualan</div>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Waktu Masuk Gudang (Sistem)</label>
                            <input type="datetime-local" id="tanggal_masuk" name="tanggal_masuk" class="form-control bg-secondary bg-opacity-10 text-muted border-dashed"
                                value="{{ old('tanggal_masuk', now()->format('Y-m-d\TH:i')) }}" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-danger">Batas Waktu Titip (Sistem)</label>
                            <input type="datetime-local" id="tanggal_akhir" name="tanggal_akhir" class="form-control bg-danger bg-opacity-10 text-danger border-dashed"
                                value="{{ old('tanggal_akhir', now()->addDays(30)->format('Y-m-d\TH:i')) }}" readonly>
                        </div>
                    </div>

                    <div class="custom-section-title mt-4"><i class="bi bi-camera text-muted"></i> Dokumentasi Visual</div>
                    <div class="mb-5 custom-section border-primary border-opacity-25" style="background: #f0fdf4;">
                        <label class="form-label text-success">Upload Bukti Foto Barang <span class="text-danger">*</span></label>
                        <div class="input-group mb-2">
                            <input type="file" name="foto_barang[]" class="form-control" id="foto_barang" multiple required accept=".jpg,.jpeg,.png">
                            <span class="input-group-text bg-white text-muted"><i class="bi bi-upload"></i></span>
                        </div>
                        <small class="text-success fw-medium"><i class="bi bi-info-circle me-1"></i>Sistem mewajibkan minimal 2 (dua) foto dari sudut yang berbeda. Format .jpg, .jpeg, .png</small>
                        
                        <!-- Preview Gambar -->
                        <div id="preview-container">
                            <!-- Preview gambar akan ditambahkan via JS -->
                        </div>
                    </div>

                    <hr class="mb-4">
                    <div class="text-end">
                        <button type="submit" name="action" value="add" class="btn btn-primary px-5 fw-bold" style="border-radius: var(--radius-pill); padding: 12px 24px;">
                            <i class="bi bi-plus-lg me-1"></i> Tambahkan ke Daftar Nota
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Panel Sidebar: Daftar Barang yang sudah masuk nota -->
    <div class="col-xl-4">
        <div class="card border-0 sticky-top" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); top: 90px;">
            <div class="card-header bg-primary text-white pt-4 pb-3 px-4" style="border-top-left-radius: var(--radius-lg); border-top-right-radius: var(--radius-lg);">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-outfit fw-bold"><i class="bi bi-cart-check me-2"></i>Barang dalam Nota</h5>
                    <span class="badge bg-white text-primary rounded-pill px-3 fs-6">{{ $barangNota->total() }} Item</span>
                </div>
            </div>
            
            <div class="card-body p-0">
                <div class="list-group list-group-flush" style="max-height: 500px; overflow-y: auto;">
                    @forelse($barangNota as $barang)
                    <div class="list-group-item p-4 border-bottom">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="fw-bold text-dark m-0">{{ $barang->nama_barang }}</h6>
                                <span class="text-primary fw-bold" style="font-size: 0.8rem;">{{ strtoupper(substr($barang->nama_barang, 0, 1)) . $barang->id_barang }}</span>
                            </div>
                            <span class="badge bg-light text-dark border">{{ $barang->status_barang }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="text-success fw-bold small">Rp{{ number_format($barang->harga_jual, 0, ',', '.') }}</span>
                            <a href="{{ route('pegawai_gudang.barangTitipan.edit', ['id' => $barang->id_barang, 'context' => 'create', 'id_nota' => $nota->id_nota]) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3" title="Edit draft barang ini">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="p-5 text-center text-muted">
                        <i class="bi bi-box d-block fs-1 text-light mb-3"></i>
                        <p class="mb-0">Belum ada barang ditambahkan ke nota penitipan ini.</p>
                    </div>
                    @endforelse
                </div>
                
                @if($barangNota->hasPages())
                <div class="p-3 border-top bg-light text-center d-flex justify-content-center">
                    {{ $barangNota->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>
            
            <div class="card-footer bg-white p-4 border-top text-center" style="border-bottom-left-radius: var(--radius-lg); border-bottom-right-radius: var(--radius-lg);">
                <p class="text-muted small mb-3">Jika semua barang dari penitip sudah dimasukkan, klik tombol selesai di bawah.</p>
                <form action="{{ route('pegawai_gudang.barangTitipan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_nota" value="{{ $nota->id_nota }}">
                    <input type="hidden" name="action" value="finish">
                    
                    <button type="submit" class="btn btn-success w-100 fw-bold" style="border-radius: var(--radius-pill); padding: 12px;" {{ $barangNota->isEmpty() ? 'disabled' : '' }}>
                        <i class="bi bi-check2-all me-1"></i> Kunci Nota & Selesai
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tglMasuk = document.getElementById('tanggal_masuk');
        const tglAkhir = document.getElementById('tanggal_akhir');

        function updateTanggalAkhir() {
            if (!tglMasuk || !tglAkhir) return;

            const masuk = new Date(tglMasuk.value);

            if (!isNaN(masuk.getTime())) {
                const akhir = new Date(masuk);
                akhir.setDate(masuk.getDate() + 30);
                akhir.setHours(masuk.getHours(), masuk.getMinutes(), 0, 0);

                const pad = n => n.toString().padStart(2, '0');
                const formatted = `${akhir.getFullYear()}-${pad(akhir.getMonth() + 1)}-${pad(akhir.getDate())}T${pad(akhir.getHours())}:${pad(akhir.getMinutes())}`;
                tglAkhir.value = formatted;
            }
        }

        updateTanggalAkhir();
        tglMasuk.addEventListener('input', updateTanggalAkhir);
        tglMasuk.addEventListener('change', updateTanggalAkhir);

        // Preview Image logic
        const inputFile = document.getElementById('foto_barang');
        const previewContainer = document.getElementById('preview-container');

        inputFile.addEventListener('change', function (event) {
            previewContainer.innerHTML = '';
            const files = event.target.files;
            if (files) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = file.name;
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    });
</script>
@endpush
