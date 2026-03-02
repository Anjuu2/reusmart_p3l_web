@extends('owner.dashboard')

@section('isi')

<style>
    .form-label { font-weight: 600; color: #334155; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; }
    .form-control, .form-select { border-radius: 12px; padding: 0.75rem 1rem; border-color: #cbd5e1; font-size: 0.95rem; background-color: #f8fafc; }
    .form-control:focus, .form-select:focus { border-color: var(--owner-gold); background-color: #fff; box-shadow: 0 0 0 0.25rem rgba(245, 158, 11, 0.15); }
    .custom-section { background: #fff; border-radius: 16px; padding: 1.5rem; border: 1px solid #f1f5f9; box-shadow: var(--shadow-sm); height: 100%; display: flex; flex-direction: column; }
    .section-title { font-family: 'Outfit', sans-serif; font-size: 1.1rem; font-weight: 700; color: var(--owner-dark); margin-bottom: 1.2rem; display: flex; align-items: center; gap: 0.5rem; }
    
    .table-custom { border-collapse: separate; border-spacing: 0 0.5rem; margin-top: -0.5rem; }
    .table-custom thead th { border: none; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; padding: 0.75rem 1.25rem; font-weight: 700; }
    .table-custom tbody tr { background-color: #f8fafc; box-shadow: 0 2px 4px rgba(0,0,0,0.02); transition: transform 0.2s ease, box-shadow 0.2s ease; border-radius: 12px; }
    .table-custom tbody tr:hover { transform: translateY(-2px); box-shadow: var(--shadow-sm); z-index: 1; position: relative; }
    .table-custom tbody td { border: none; padding: 1rem 1.25rem; background-color: #fff; vertical-align: middle; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; }
    .table-custom tbody td:first-child { border-left: 1px solid #f1f5f9; border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
    .table-custom tbody td:last-child { border-right: 1px solid #f1f5f9; border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div class="d-flex align-items-center gap-3">
        <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 1.5rem;">
            <i class="bi bi-gift text-warning"></i>
        </div>
        <div>
            <h3 class="m-0 text-dark font-outfit">Sistem CSR & Donasi</h3>
            <p class="text-muted small m-0">Kelola permintaan panti asuhan/organisasi dan alokasikan inventaris perusahaan.</p>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0" role="alert" style="background: #dcfce7; color: #166534; border-radius: var(--radius-lg);">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if ($errors->has('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0" role="alert" style="background: #fee2e2; color: #991b1b; border-radius: var(--radius-lg);">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <strong>Terjadi Kesalahan!</strong> {{ $errors->first('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row g-4 mb-4">
    <!-- Panel Kiri: Alokasi Form & Pending Requests -->
    <div class="col-xl-4 col-lg-5">
        <div class="custom-section mb-4">
            <h5 class="section-title"><i class="bi bi-boxes text-warning"></i> Eksekusi Alokasi Barang</h5>
            <p class="text-muted small mb-4">Pilih barang inventaris yang tersedia dan pasangkan dengan institusi yang membutuhkan.</p>
            
            <form method="POST" action="{{ route('owner.donasi.allocate') }}" class="mt-auto">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Inventaris Gudang (Siap Donasi)</label>
                    <select name="id_barang" class="form-select border-warning" required>
                        <option value="" disabled selected>-- Pilih Barang Titipan --</option>
                        @forelse($barangSiapDonasi as $b)
                            <option value="{{ $b->id_barang }}">SKU {{ strtoupper(substr($b->nama_barang, 0, 1)) }}{{ $b->id_barang }} - {{ $b->nama_barang }}</option>
                        @empty
                            <option value="" disabled>Tidak ada barang berstatus "Tersedia"</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tujuan Distribusi (Panti/Organisasi)</label>
                    <select name="id_request" class="form-select border-primary" required>
                        <option value="" disabled selected>-- Pilih Permintaan Aktif --</option>
                        @forelse($requests as $r)
                            <option value="{{ $r->id_request }}">[REQ-{{ $r->id_request }}] {{ $r->organisasi->nama_organisasi }} (Butuh: {{ $r->barang_dibutuhkan }})</option>
                        @empty
                            <option value="" disabled>Tidak ada permintaan antrean</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Perwakilan Penerima</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-person-badge text-muted"></i></span>
                        <input type="text" name="penerima" class="form-control border-start-0 ps-0" placeholder="Cth: Bpk. Haryanto" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Jadwal Penyerahan Donasi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-calendar-event text-muted"></i></span>
                        <input type="datetime-local" name="tanggal_donasi" class="form-control border-start-0 ps-0" value="{{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d\TH:i') }}" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-premium w-100 fw-bold py-3">
                    <i class="bi bi-send-check-fill me-2"></i> Eksekusi Logistik CSR
                </button>
            </form>
        </div>
    </div>

    <!-- Panel Kanan: Antrean & Histori -->
    <div class="col-xl-8 col-lg-7 d-flex flex-column gap-4">
        
        <!-- Tabel Antrean Permintaan -->
        <div class="custom-section">
            <h5 class="section-title"><i class="bi bi-inbox text-primary"></i> <span class="me-auto">Antrean Permintaan Organisasi</span> <span class="badge bg-primary rounded-pill fw-normal fs-6">{{ count($requests) }} Pending</span></h5>
            
            <div class="table-responsive flex-grow-1">
                <table class="table table-custom w-100 mb-0">
                    <thead>
                        <tr>
                            <th style="width: 35%;">Institusi Pemohon</th>
                            <th style="width: 35%;">Kebutuhan</th>
                            <th style="width: 15%;" class="text-center">Status</th>
                            <th style="width: 15%;" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $r)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $r->organisasi->nama_organisasi }}</div>
                                    <div class="small text-muted text-truncate" style="max-width: 200px;" title="{{ $r->organisasi->alamat }}"><i class="bi bi-geo-alt me-1"></i>{{ $r->organisasi->alamat }}</div>
                                </td>
                                <td>
                                    <div class="fw-medium text-primary"><i class="bi bi-basket text-muted me-1"></i>{{ $r->barang_dibutuhkan }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill"><i class="bi bi-hourglass-split me-1"></i>{{ $r->status_request }}</span>
                                </td>
                                <td class="text-end">
                                    <form method="POST" action="{{ route('owner.donasi.reject') }}" onsubmit="return confirm('Tolak permintaan donasi {{ $r->organisasi->nama_organisasi }} ini secara permanen?')">
                                        @csrf
                                        <input type="hidden" name="id_request" value="{{ $r->id_request }}">
                                        <button class="btn btn-sm btn-outline-danger rounded-circle p-2" title="Tolak Permintaan" style="width: 34px; height: 34px; display: inline-flex; justify-content: center; align-items: center;">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 bg-transparent border-0">
                                    <p class="text-muted m-0"><i class="bi bi-check-circle text-success me-2"></i>Tidak ada antrean logistik baru. Semua permintaan terlayani.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Histori Keseluruhan -->
        <div class="custom-section flex-grow-1">
            <h5 class="section-title"><i class="bi bi-clock-history text-success"></i> Portofolio Logistik CSR Berhasil</h5>
            
            <div class="table-responsive">
                <table class="table table-custom w-100 mb-0">
                    <thead>
                        <tr>
                            <th style="width: 25%;">Aset Didonasikan</th>
                            <th style="width: 30%;">Institusi Mayoritas</th>
                            <th style="width: 25%;">Serah Terima</th>
                            <th style="width: 20%;">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donasiHistori as $d)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $d->barang_titipan->nama_barang ?? '-' }}</div>
                                    <div class="small text-warning fw-bold">SKU {{ strtoupper(substr($d->barang_titipan->nama_barang ?? '-', 0, 1)) }}{{ $d->barang_titipan->id_barang ?? '-' }}</div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-success bg-opacity-10 text-success rounded p-2 d-none d-sm-block">
                                            <i class="bi bi-building"></i>
                                        </div>
                                        <span class="fw-medium text-dark">{{ $d->request_donasi->organisasi->nama_organisasi ?? '-' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted"><i class="bi bi-person-check me-2"></i>{{ $d->penerima }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1"><i class="bi bi-calendar3 me-1"></i>{{ $d->tanggal_donasi->format('d M Y') }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 bg-transparent border-0">
                                    <p class="text-muted m-0"><i class="bi bi-info-circle me-2"></i>Belum ada histori logistik donasi yang dikerjakan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection
