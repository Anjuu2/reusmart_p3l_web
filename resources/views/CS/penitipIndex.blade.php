@extends('CS.dashboard')

@section('isi')

<style>
    .card-modern { background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.05); }
    .table-custom { border-collapse: separate; border-spacing: 0 0.5rem; margin-top: -0.5rem; }
    .table-custom thead th { border: none; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; padding: 0.75rem 1.25rem; font-weight: 700; background: transparent; white-space: nowrap;}
    .table-custom tbody tr { background-color: #f8fafc; transition: transform 0.2s ease, box-shadow 0.2s ease; border-radius: 12px; }
    .table-custom tbody tr:hover { transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.1); z-index: 1; position: relative; }
    .table-custom tbody td { border: none; padding: 1rem 1.25rem; background-color: #fff; vertical-align: middle; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; font-size: 0.95rem; color: #334155;}
    .table-custom tbody td:first-child { border-left: 1px solid #f1f5f9; border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
    .table-custom tbody td:last-child { border-right: 1px solid #f1f5f9; border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
    
    .status-badge { padding: 6px 12px; border-radius: 30px; font-size: 0.8rem; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; gap: 4px; border: 1px solid transparent; width: 120px;}
    .status-active { background: #dcfce7; color: #166534; border-color: #bbf7d0; }
    .status-inactive { background: #fee2e2; color: #991b1b; border-color: #fecaca; }
    
    .search-box { position: relative; width: 320px; max-width: 100%;}
    .search-box input { width: 100%; padding: 12px 15px 12px 42px; border-radius: 50px; border: 1px solid #cbd5e1; background: #fff; font-size: 0.95rem; transition: all 0.2s; box-shadow: 0 2px 4px rgba(0,0,0,0.02);}
    .search-box input:focus { border-color: #10b981; outline: none; box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); }
    .search-box i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #64748b; font-size: 1.1rem; }
    
    .action-btn { width: 35px; height: 35px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.1rem; transition: all 0.2s; border: none; }
    .btn-edit { background: #fffbeb; color: #d97706; }
    .btn-edit:hover { background: #f59e0b; color: white; transform: translateY(-2px); box-shadow: 0 4px 6px rgba(245, 158, 11, 0.2); }
    .btn-delete { background: #fef2f2; color: #ef4444; }
    .btn-delete:hover { background: #ef4444; color: white; transform: translateY(-2px); box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2); }
    
    .btn-add { background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 50px; padding: 10px 24px; font-weight: 600; font-size: 0.95rem; transition: all 0.3s; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3); display: inline-flex; align-items: center; gap: 8px;}
    .btn-add:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(16, 185, 129, 0.4); color: white;}
    
    .ktp-link { color: #10b981; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #ecfdf5; border-radius: 8px; font-size: 0.85rem; transition: all 0.2s;}
    .ktp-link:hover { background: #10b981; color: white; }
    
    .alert-custom { border-radius: 12px; border: none; font-weight: 600; padding: 1rem 1.25rem; }
    .alert-success-custom { background: #dcfce7; color: #166534; border-left: 4px solid #166534;}
    .alert-error-custom { background: #fee2e2; color: #991b1b; border-left: 4px solid #991b1b;}
</style>

<!-- CSRF token untuk AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
    <div>
        <h3 class="m-0 text-dark font-outfit fw-bold">Verifikasi Identitas Penitip</h3>
        <p class="text-muted small m-0 mt-1">Review legalitas dokumen KTP dan manajemen akun mitra penitip barang.</p>
    </div>
    <div class="d-flex align-items-center gap-3 flex-wrap">
        <form class="search-box" method="GET" action="{{ route('cs.penitip.index') }}">
            <i class="bi bi-search"></i>
            <input type="search" name="q" placeholder="Cari NIK, Username, Email..." value="{{ old('q', $search ?? '') }}">
        </form>
        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="bi bi-person-plus-fill"></i> Tambah Entitas Penitip
        </button>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-custom alert-success-custom alert-dismissible fade show mb-4 d-flex align-items-center shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i> 
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-custom alert-error-custom alert-dismissible fade show mb-4 d-flex align-items-start shadow-sm">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5 mt-1"></i>
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close ms-auto mt-1" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card-modern p-4">
    <div class="table-responsive">
        <table class="table table-custom w-100 mb-0">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 25%;">Profil Penitip</th>
                    <th style="width: 25%;">Verifikasi Identitas</th>
                    <th style="width: 15%;" class="text-center">Dokumen KTP</th>
                    <th style="width: 15%;" class="text-center">Akses Auth</th>
                    <th style="width: 15%;" class="text-end">Aksi Admin</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penitips as $index => $penitip)
                <tr>
                    <td class="text-muted fw-bold">#{{ $penitips->firstItem() + $index }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; font-size: 1.1rem;">
                                {{ strtoupper(substr($penitip->nama_penitip, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold text-dark">{{ $penitip->nama_penitip }}</div>
                                <div class="small text-muted"><i class="bi bi-at me-1"></i>{{ $penitip->username }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="small text-dark fw-medium mb-1"><i class="bi bi-credit-card-2-front text-muted me-1"></i> {{ $penitip->no_ktp }}</div>
                        <div class="small text-muted"><i class="bi bi-envelope text-muted me-1"></i> {{ $penitip->email }}</div>
                    </td>
                    <td class="text-center">
                        @if($penitip->foto_ktp)
                            <a href="{{ asset('storage/' . $penitip->foto_ktp) }}" target="_blank" class="ktp-link">
                                <i class="bi bi-file-earmark-image"></i> Dokumen
                            </a>
                        @else
                            <span class="badge bg-light text-muted border px-2 py-1"><i class="bi bi-slash-circle me-1"></i>Miss KTP</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="status-badge {{ $penitip->status_aktif ? 'status-active' : 'status-inactive' }}">
                            @if($penitip->status_aktif)
                                <i class="bi bi-shield-check"></i> Aktif
                            @else
                                <i class="bi bi-shield-lock-fill"></i> Terkunci
                            @endif
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2 justify-content-end">
                            <button type="button" class="action-btn btn-edit" title="Perbarui Data" data-bs-toggle="modal" data-bs-target="#editModal{{ $penitip->id_penitip }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('cs.penitip.destroy', $penitip->id_penitip) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus identitas penitip ini SECARA PERMANEN?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn-delete" title="Hapus Permanen">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                {{-- Modal Edit per item --}}
                <div class="modal fade" id="editModal{{ $penitip->id_penitip }}" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content" style="border-radius: var(--radius-lg); border: none;">
                      <form action="{{ route('cs.penitip.update', $penitip->id_penitip) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Pastikan data yang diubah sudah benar. Lanjutkan pembaruan identitas?');">
                        @csrf
                        @method('PUT')
                        <div class="modal-header border-bottom px-4 pt-4">
                          <h5 class="modal-title font-outfit fw-bold text-dark"><i class="bi bi-pencil-square text-success me-2"></i>Perbarui Data Pribadi</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body px-4 py-4 bg-light">
                          <div class="bg-white p-4 rounded-3 border">
                              <div class="row g-4">
                                  <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark small">Nama Sesuai KTP</label>
                                    <input type="text" name="nama_penitip" class="form-control" value="{{ $penitip->nama_penitip }}" style="border-radius: 8px;" required>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark small">Nomor Induk Kependudukan (NIK)</label>
                                    <input type="text" name="no_ktp" class="form-control" value="{{ $penitip->no_ktp }}" style="border-radius: 8px;" required>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark small">Email Aktif</label>
                                    <input type="email" name="email" class="form-control" value="{{ $penitip->email }}" style="border-radius: 8px;" required>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark small">Username Aplikasi</label>
                                    <input type="text" name="username" class="form-control" value="{{ $penitip->username }}" style="border-radius: 8px;" required>
                                  </div>
                                  <div class="col-12">
                                      <label class="form-label fw-bold text-dark small">Dokumen Identitas Baru (KTP)</label>
                                      <input type="file" name="foto_ktp" class="form-control" accept="image/*" style="border-radius: 8px;">
                                      <div class="form-text mt-2">
                                          Lewati jika tidak ada pembaharuan scan KTP.
                                          @if($penitip->foto_ktp)
                                              <a href="{{ asset('storage/' . $penitip->foto_ktp) }}" target="_blank" class="fw-bold ms-1 text-success text-decoration-none"><i class="bi bi-link-45deg"></i> KTP Lama (Tersimpan)</a>
                                          @endif
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="modal-footer border-top px-4 pb-4 pt-3 d-flex justify-content-between">
                          <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-muted border" data-bs-dismiss="modal">Batalkan</button>
                          <button type="submit" class="btn btn-success rounded-pill px-5 shadow-sm fw-bold"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-slash-circle fs-1 text-muted"></i>
                        </div>
                        <h6 class="text-dark fw-bold font-outfit">Sistem Filter Kosong</h6>
                        <p class="text-muted small">Basis data tidak memuat kueri penitip yang Anda cari.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end pt-3">
        {!! $penitips->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: var(--radius-lg); border: none;">
      <form action="{{ route('cs.penitip.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Lanjutkan pembuatan entitas penitip di database?');">
        @csrf
        <div class="modal-header border-bottom px-4 pt-4 bg-success bg-opacity-10 text-success">
          <h5 class="modal-title font-outfit fw-bold"><i class="bi bi-person-plus-fill me-2"></i>Registrasi Penitip Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body px-4 py-4 bg-light">
          <div class="bg-white p-4 rounded-3 border">
              <div class="row g-4">
                  <div class="col-md-6">
                    <label class="form-label fw-bold text-dark small">Nama Sesuai KTP <span class="text-danger">*</span></label>
                    <input type="text" name="nama_penitip" class="form-control" style="border-radius: 8px;" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-bold text-dark small">Nomor Induk Kependudukan (NIK) <span class="text-danger">*</span></label>
                    <input type="text" name="no_ktp" class="form-control" style="border-radius: 8px;" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-bold text-dark small">Email Valid <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" style="border-radius: 8px;" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-bold text-dark small">Definisi Username Auth <span class="text-danger">*</span></label>
                    <input type="text" name="username" class="form-control" style="border-radius: 8px;" required>
                  </div>
                  <div class="col-md-12">
                      <label class="form-label fw-bold text-dark small">Alamat Domisili <span class="text-danger">*</span></label>
                      <textarea name="alamat" class="form-control" rows="2" style="border-radius: 8px;" required></textarea>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-bold text-dark small">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" style="border-radius: 8px;" required>
                  </div>
                  <div class="col-md-6">
                      <label class="form-label fw-bold text-dark small">Dokumen Identitas (KTP)</label>
                      <input type="file" name="foto_ktp" class="form-control" accept="image/*" style="border-radius: 8px;">
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer border-top px-4 pb-4 pt-3 d-flex justify-content-between">
          <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-muted border" data-bs-dismiss="modal">Batalkan</button>
          <button type="submit" class="btn btn-success rounded-pill px-5 shadow-sm fw-bold"><i class="bi bi-cloud-arrow-up-fill me-2"></i>Simpan Ke Database</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
