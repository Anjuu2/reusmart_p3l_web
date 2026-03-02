@extends('pegawai_gudang.dashboard')
@section('isi')

@php
    $pegawai = auth()->guard('pegawai')->user();
@endphp

<style>
    .form-label { font-weight: 600; color: var(--admin-text-main); font-size: 0.9rem; margin-bottom: 0.5rem; }
    .form-control, .form-select { border-radius: 10px; padding: 0.6rem 1rem; border-color: var(--admin-border); font-size: 0.95rem; }
    .form-control:focus, .form-select:focus { border-color: var(--admin-primary); box-shadow: 0 0 0 0.25rem rgba(15, 23, 42, 0.1); }
    .custom-section { background: #f8fafc; border-radius: 12px; padding: 20px; border: 1px solid var(--admin-border); margin-bottom: 24px; }
    .custom-section-title { font-family: 'Outfit', sans-serif; font-size: 1.1rem; font-weight: 700; color: var(--admin-primary); margin-bottom: 15px; display: flex; align-items: center; gap: 8px; }
    .image-preview-wrapper { position: relative; width: 150px; height: 150px; overflow: hidden; border-radius: 10px; border: 2px solid var(--admin-border); transition: all 0.2s;}
    .image-preview-wrapper img { width: 100%; height: 100%; object-fit: cover; }
    .image-preview-wrapper:hover { border-color: #ef4444; }
    .delete-checkbox { position: absolute; top: 8px; right: 8px; transform: scale(1.5); accent-color: #ef4444; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.2); }
    #previewFotoBaru img { width: 120px; height: 120px; object-fit: cover; border-radius: 10px; border: 2px solid var(--admin-border); margin-right: 15px; margin-top: 15px; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-3">
        <h3 class="m-0 text-dark font-outfit">Edit Master Data Barang</h3>
    </div>
    <div class="text-end">
        <p class="mb-0 text-muted small fw-bold text-uppercase">Otorisasi Ubah</p>
        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill"><i class="bi bi-person-badge me-1"></i> P{{ $pegawai->id_pegawai }} - {{ $pegawai->nama_pegawai }}</span>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0" role="alert" style="background: #fee2e2; color: #991b1b; border-radius: var(--radius-lg);">
        <div class="d-flex align-items-center mb-2">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
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

<form action="{{ route('pegawai_gudang.barangTitipan.update', $barang->id_barang) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <input type="hidden" name="context" value="{{ $context }}">
    @if($context === 'create')
        <input type="hidden" name="id_nota" value="{{ $idNota }}">
    @endif
    <input type="hidden" name="id_penitip" value="{{ $barang->id_penitip }}">
    <input type="hidden" name="id_pegawai" value="{{ $barang->id_pegawai }}">

    <div class="row g-4">
        <!-- Main Form Column -->
        <div class="col-lg-8">
            <div class="card border-0 mb-4" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
                <div class="card-header bg-white border-bottom pt-4 pb-3 px-4">
                    <h5 class="m-0 font-outfit text-dark fw-bold"><i class="bi bi-pencil-square text-primary me-2"></i>Formulir Perubahan Data</h5>
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    <!-- Meta Data -->
                    <div class="custom-section bg-warning bg-opacity-10 border-warning border-opacity-25 pb-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase mb-1">Target Perubahan</label>
                                <div class="d-flex align-items-center p-2 rounded bg-white">
                                    <span class="fw-bold text-dark fs-5">{{ $barang->nama_barang }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase mb-1">Identitas Penitip Terikat</label>
                                <div class="d-flex align-items-center p-2 rounded bg-white">
                                    <span class="badge bg-light text-primary border rounded-pill me-2">T{{ $barang->penitip->id_penitip }}</span>
                                    <span class="fw-bold text-dark">{{ $barang->penitip->nama_penitip }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="custom-section-title mt-4"><i class="bi bi-people text-muted"></i> Penugasan Staff Terkait</div>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Pegawai Quality Control (QC)</label>
                            <select name="id_qc_pegawai" class="form-select bg-light" required>
                                @foreach ($pegawaiQc as $qc)
                                    <option value="{{ $qc->id_pegawai }}" {{ $barang->id_qc_pegawai == $qc->id_pegawai ? 'selected' : '' }}>
                                        P{{ $qc->id_pegawai }} - {{ $qc->nama_pegawai }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hunter (Jika Ada)</label>
                            <select name="id_hunter" class="form-select bg-light">
                                <option value="">-- Bukan Barang Hunter --</option>
                                @foreach ($pegawaiHunter as $hunter)
                                    <option value="{{ $hunter->id_pegawai }}" {{ $barang->id_hunter == $hunter->id_pegawai ? 'selected' : '' }}>
                                        P{{ $hunter->id_pegawai }} - {{ $hunter->nama_pegawai }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="custom-section-title mt-4"><i class="bi bi-box text-muted"></i> Rincian Fisik & Komersial</div>
                    <div class="row g-4 mb-4 custom-section">
                        <div class="col-md-6">
                            <label class="form-label">Nama Barang Aktual</label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Klasifikasi Kategori</label>
                            <select name="id_kategori" class="form-select" required>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id_kategori }}" {{ $barang->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Berat Fix (kg)</label>
                            <input type="number" step="0.01" name="berat" class="form-control" value="{{ $barang->berat }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Taksiran Harga Jual (Rp)</label>
                            <input type="number" name="harga_jual" class="form-control" value="{{ $barang->harga_jual }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi Lengkap Kondisi Secara Historis</label>
                            <textarea name="deskripsi" rows="4" class="form-control">{{ $barang->deskripsi }}</textarea>
                        </div>
                    </div>

                    <div class="custom-section-title mt-4"><i class="bi bi-camera text-muted"></i> Manajemen Dokumentasi Foto</div>
                    <div class="custom-section bg-white border shadow-sm">
                        @if ($barang->fotoBarang->count())
                            <div class="mb-4">
                                <label class="form-label text-danger"><i class="bi bi-trash text-danger me-1"></i> Mode Penghapusan Foto Lama</label>
                                <p class="text-muted small mb-3">Centang checkbox <input type="checkbox" checked disabled> di sudut gambar untuk **menghapus** foto yang tidak relevan. Wajib menyisakan/mengganti agar total minimal 2 foto terpelihara sistem.</p>
                                
                                <div class="d-flex flex-wrap gap-3 p-3 bg-light rounded border">
                                    @foreach ($barang->fotoBarang as $foto)
                                        <div class="image-preview-wrapper shadow-sm">
                                            <img src="{{ asset('images/barang/' . $foto->nama_file) }}" alt="Foto Barang">
                                            <input type="checkbox" name="hapus_foto[]" value="{{ $foto->id_foto }}" class="delete-checkbox form-check-input" title="Tandai untuk Dihapus">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div>
                            <label class="form-label text-success"><i class="bi bi-plus-circle text-success me-1"></i> Unggah Foto Tambahan (Baru)</label>
                            <input type="file" name="foto_barang[]" class="form-control" id="inputFotoBaru" multiple accept=".jpg,.jpeg,.png">
                            <small class="text-muted d-block mt-1">Hanya pilih file jika ada penambahan visual baru dari proses re-QC. Tinjau previe di bawah ini:</small>
                            <div id="previewFotoBaru" class="d-flex flex-wrap gap-2"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Sidebar / Secondary Configurations -->
        <div class="col-lg-4">
            <div class="card border-0 sticky-top" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); top: 90px;">
                <div class="card-header bg-dark text-white pt-4 pb-3 px-4" style="border-top-left-radius: var(--radius-lg); border-top-right-radius: var(--radius-lg);">
                    <h5 class="m-0 font-outfit fw-bold"><i class="bi bi-gear-fill me-2"></i>Konfigurasi Status</h5>
                </div>
                
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Garansi Berjalan</label>
                        <select name="garansi" class="form-select bg-light mb-2">
                            <option value="1" {{ $barang->garansi ? 'selected' : '' }}>🟢 Tersedia Active</option>
                            <option value="0" {{ !$barang->garansi ? 'selected' : '' }}>🔴 Void / Tidak Ada</option>
                        </select>
                        <label class="form-label small text-muted">Batas Akhir Claim</label>
                        <input type="date" name="tanggal_garansi" class="form-control bg-light" value="{{ $barang->tanggal_garansi ? $barang->tanggal_garansi->format('Y-m-d') : '' }}">
                    </div>

                    <div class="mb-4 pb-4 border-bottom">
                        <label class="form-label fw-bold d-block">Status Ketersediaan</label>
                        <input type="text" name="status_barang" class="form-control fw-bold border-primary text-primary" value="{{ $barang->status_barang }}" required>
                        <small class="text-muted mt-1 d-block">Ubah manual hanya jika intervensi CS/Admin gagal.</small>
                    </div>

                    <div class="mb-4 text-center p-3 bg-light rounded border-dashed hstack gap-2 justify-content-center flex-wrap">
                        <label class="form-label w-100 fw-bold m-0"><i class="bi bi-clock-history me-1"></i> Lifecycle Barang</label>
                        <div class="w-100 mt-2">
                            <div class="badge bg-secondary p-2 w-100 mb-2 text-start"><span class="fw-normal d-block small mb-1">IN:</span> {{ \Carbon\Carbon::parse($barang->tanggal_masuk)->format('d M Y, H:i') }}</div>
                            <div class="badge bg-danger p-2 w-100 text-start"><span class="fw-normal d-block small mb-1">EXP:</span> {{ \Carbon\Carbon::parse($barang->tanggal_akhir)->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}</div>
                        </div>
                        
                        <!-- hidden but preserved logic for post requests -->
                        <input type="hidden" name="tanggal_masuk" value="{{ \Carbon\Carbon::parse($barang->tanggal_masuk)->format('Y-m-d\TH:i') }}">
                        <input type="hidden" name="tanggal_akhir" value="{{ \Carbon\Carbon::parse($barang->tanggal_akhir)->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i') }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-danger"><i class="bi bi-bezier2 me-1"></i> Perpanjangan Paksa</label>
                        <select name="status_perpanjangan" class="form-select bg-danger border-danger border-opacity-25 bg-opacity-10 text-danger fw-bold">
                            <option value="0" {{ !$barang->status_perpanjangan ? 'selected' : '' }}>NORMAL (False)</option>
                            <option value="1" {{ $barang->status_perpanjangan ? 'selected' : '' }}>DIPERPANJANG (True)</option>
                        </select>
                    </div>
                </div>
                
                <div class="card-footer bg-white p-4 text-center border-top" style="border-bottom-left-radius: var(--radius-lg); border-bottom-right-radius: var(--radius-lg);">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-warning btn-lg fw-bold" style="border-radius: var(--radius-pill);">
                            <i class="bi bi-save2-fill me-1"></i> Terapkan Perubahan
                        </button>
                        @if($context === 'create')
                            <a href="{{ route('pegawai_gudang.barangTitipan.create', ['id_nota' => $idNota]) }}" class="btn btn-light fw-bold text-muted border" style="border-radius: var(--radius-pill);">Batalkan & Kembali</a>
                        @else
                            <a href="{{ route('pegawai_gudang.barangTitipan.showDetail', $barang->id_barang) }}" class="btn btn-light fw-bold text-muted border" style="border-radius: var(--radius-pill);">Batalkan Edit</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const inputFoto = document.querySelector('input[name="foto_barang[]"]');
    const totalFotoLama = {{ $barang->fotoBarang->count() }};

    form.addEventListener('submit', function (e) {
        
        const deleteCheckboxes = document.querySelectorAll('.delete-checkbox:checked');
        const numDeleted = deleteCheckboxes.length;
        
        const totalFotoBaru = inputFoto?.files?.length || 0;
        const totalSetelahSubmit = (totalFotoLama - numDeleted) + totalFotoBaru;

        if (totalSetelahSubmit < 2) {
            e.preventDefault();
            alert("Operasi Ditolak! Total foto fisik barang SELESAI diubah minimal harus berjumlah 2 file atau lebih untuk validasi pembeli.");
        }
    });

    const inputFotoElem = document.getElementById('inputFotoBaru');
    const previewDiv = document.getElementById('previewFotoBaru');

    inputFotoElem.addEventListener('change', function () {
        previewDiv.innerHTML = ''; // reset preview
        Array.from(this.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.createElement('img');
                img.src = e.target.result;
                previewDiv.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
});
</script>
@endpush