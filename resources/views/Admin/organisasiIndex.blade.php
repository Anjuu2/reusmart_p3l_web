@extends('Admin.dashboard')

@section('isi')

<style>
    .card-modern { background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.05); }
    .table-custom { border-collapse: separate; border-spacing: 0 0.5rem; margin-top: -0.5rem; }
    .table-custom thead th { border: none; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; padding: 0.75rem 1.25rem; font-weight: 700; background: transparent; }
    .table-custom tbody tr { background-color: #f8fafc; transition: transform 0.2s ease, box-shadow 0.2s ease; border-radius: 12px; }
    .table-custom tbody tr:hover { transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.1); z-index: 1; position: relative; }
    .table-custom tbody td { border: none; padding: 1rem 1.25rem; background-color: #fff; vertical-align: middle; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; }
    .table-custom tbody td:first-child { border-left: 1px solid #f1f5f9; border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
    .table-custom tbody td:last-child { border-right: 1px solid #f1f5f9; border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
    
    .status-badge { padding: 6px 12px; border-radius: 30px; font-size: 0.8rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;}
    .status-active { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .status-inactive { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    
    .search-box { position: relative; width: 320px; max-width: 100%;}
    .search-box input { width: 100%; padding: 12px 15px 12px 42px; border-radius: 50px; border: 1px solid #cbd5e1; background: #fff; font-size: 0.95rem; transition: all 0.2s; box-shadow: 0 2px 4px rgba(0,0,0,0.02);}
    .search-box input:focus { border-color: #3b82f6; outline: none; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
    .search-box i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #64748b; font-size: 1.1rem; }
    
    .action-btn { width: 35px; height: 35px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.1rem; transition: all 0.2s; border: none; }
    .btn-edit { background: #fffbeb; color: #d97706; }
    .btn-edit:hover { background: #f59e0b; color: white; transform: translateY(-2px); box-shadow: 0 4px 6px rgba(245, 158, 11, 0.2); }
    .btn-suspend { background: #fef2f2; color: #ef4444; }
    .btn-suspend:hover { background: #ef4444; color: white; transform: translateY(-2px); box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2); }
    .btn-delete { background: #f1f5f9; color: #475569; }
    .btn-delete:hover { background: #0f172a; color: white; transform: translateY(-2px); box-shadow: 0 4px 6px rgba(15, 23, 42, 0.2); }
</style>

<!-- CSRF token untuk AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
    <div>
        <h3 class="m-0 text-dark font-outfit fw-bold">Manajemen Organisasi</h3>
        <p class="text-muted small m-0 mt-1">Sistem informasi pendataan mitra CSR & Filantropi Eksternal.</p>
    </div>
    <form class="search-box" method="GET" action="{{ route('organisasi.show') }}">
        <i class="bi bi-search"></i>
        <input type="search" name="q" placeholder="Cari nama organisasi/mitra..." value="{{ old('q', $q ?? '') }}">
    </form>
</div>

<div class="card-modern p-4">
    <div class="table-responsive">
        <table class="table table-custom w-100 mb-0" id="organisasi-table">
            <thead>
                <tr>
                    <th style="width: 15%;">Serial ID</th>
                    <th style="width: 30%;">Entitas Organisasi</th>
                    <th style="width: 30%;">Alamat Representatif</th>
                    <th style="width: 10%;" class="text-center">Status</th>
                    <th style="width: 15%;" class="text-end">Aksi Admin</th>
                </tr>
            </thead>
            <tbody>
                @forelse($organisasi as $org)
                <tr data-id="{{ $org->id_organisasi }}">
                    <td>
                        <span class="badge bg-light text-secondary border px-2 py-1 user-select-all font-monospace fs-6">ORG-{{ str_pad($org->id_organisasi, 4, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td class="col-nama">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; font-size: 1.1rem;">
                                {{ strtoupper(substr($org->nama_organisasi, 0, 1)) }}
                            </div>
                            <span class="fw-bold text-dark" style="font-size: 1.05rem;">{{ $org->nama_organisasi }}</span>
                        </div>
                    </td>
                    <td class="col-alamat">
                        <div class="text-muted small text-truncate" style="max-width: 250px;" title="{{ $org->alamat }}">
                            <i class="bi bi-geo-alt me-1"></i> {{ $org->alamat }}
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="status-badge {{ $org->status_aktif ? 'status-active' : 'status-inactive' }}">
                            @if($org->status_aktif)
                                <i class="bi bi-check-circle-fill"></i> Aktif
                            @else
                                <i class="bi bi-slash-circle-fill"></i> Nonaktif
                            @endif
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2 justify-content-end">
                            <button type="button" class="action-btn btn-edit" title="Perbarui Data" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $org->id_organisasi }}" data-nama="{{ $org->nama_organisasi }}" data-alamat="{{ $org->alamat }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="action-btn btn-suspend" title="Toggle Status (Suspend)" data-bs-toggle="modal" data-bs-target="#nonaktifModal" data-id="{{ $org->id_organisasi }}">
                                <i class="bi bi-power"></i>
                            </button>
                            <button type="button" class="action-btn btn-delete" title="Hapus Permanen" data-bs-toggle="modal" data-bs-target="#hapusModal" data-id="{{ $org->id_organisasi }}">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-building fs-1 text-muted"></i>
                        </div>
                        <h6 class="text-dark fw-bold font-outfit">Belum Ada Organisasi Terdaftar</h6>
                        <p class="text-muted small">Registrasi organisasi mitra baru ke sistem.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: var(--radius-lg); border: none;">
      <form id="editForm">
        @csrf
        <div class="modal-header border-bottom px-4 pt-4">
          <h5 class="modal-title font-outfit fw-bold text-dark"><i class="bi bi-pencil-square text-primary me-2"></i>Perbarui Entitas Mitra</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body px-4 py-4 bg-light">
          <input type="hidden" id="editId">
          <div class="bg-white p-4 rounded-3 border">
              <div class="mb-3">
                <label class="form-label fw-bold text-dark small">Nama Organisasi Institusi</label>
                <input type="text" id="editNama" name="nama_organisasi" class="form-control" style="border-radius: 8px;" required>
              </div>
              <div>
                <label class="form-label fw-bold text-dark small">Alamat Representatif</label>
                <textarea id="editAlamat" name="alamat" class="form-control" rows="3" style="border-radius: 8px;" required></textarea>
              </div>
          </div>
        </div>
        <div class="modal-footer border-top px-4 pb-4 pt-3 d-flex justify-content-between">
          <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batalkan Pembatalan</button>
          <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm">Simpan Otorisasi</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Modal Nonaktif --}}
<div class="modal fade" id="nonaktifModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: var(--radius-lg); border: none;">
      <form id="nonaktifForm">
        @csrf
        <div class="modal-header border-0 bg-warning bg-opacity-10 text-warning" style="border-top-left-radius: var(--radius-lg); border-top-right-radius: var(--radius-lg);">
          <h5 class="modal-title font-outfit fw-bold"><i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Status Logika</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <input type="hidden" id="nonaktifId">
        <div class="modal-body text-center py-4 px-5">
            <i class="bi bi-power text-warning mb-3 d-block" style="font-size: 3rem;"></i>
            <h4 class="font-outfit text-dark fw-bold mb-2">Suspend Akses?</h4>
            <p class="text-muted mb-0">Apakah Anda yakin ingin melakukan <strong>Toggle (Suspend/Active)</strong> pada organisasi ini? Hal ini mengubah flag logika di sistem tanpa menghapus data.</p>
        </div>
        <div class="modal-footer border-0 d-flex justify-content-center pt-0 pb-4">
          <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning rounded-pill px-4 text-white fw-bold shadow-sm">Eksekusi Toggle</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="hapusModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: var(--radius-lg); border: none;">
      <form id="hapusForm">
        @csrf
        <div class="modal-header border-0 bg-dark text-white" style="border-top-left-radius: var(--radius-lg); border-top-right-radius: var(--radius-lg);">
          <h5 class="modal-title font-outfit fw-bold"><i class="bi bi-trash3-fill me-2 text-danger"></i>Destruksi Data Permanen</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <input type="hidden" id="hapusId">
        <div class="modal-body text-center py-4 px-5 bg-danger bg-opacity-10">
            <h4 class="font-outfit text-danger fw-bold mb-2">Tindakan Fatal!</h4>
            <p class="text-dark mb-0">Record organisasi ini akan di DROP dari database selamanya. Proses ini bersifat <strong>Irreversible</strong>. Lanjutkan destruksi?</p>
        </div>
        <div class="modal-footer border-0 d-flex justify-content-between pt-3 pb-4 px-4 bg-light">
          <button type="button" class="btn btn-light border rounded-pill px-4 fw-bold text-muted" data-bs-dismiss="modal">Abort</button>
          <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm"><i class="bi bi-skull-fill me-2"></i>Konfirmasi Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
$(function(){
  $.ajaxSetup({ headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

  $('#editModal').on('show.bs.modal', function(e){
    const btn  = $(e.relatedTarget);
    $('#editId').val(btn.data('id'));
    $('#editNama').val(btn.data('nama'));
    $('#editAlamat').val(btn.data('alamat'));
  });

  $('#editForm').on('submit', function(e){
    e.preventDefault();
    const id = $('#editId').val();
    $.post(`/organisasi/${id}`, { nama_organisasi: $('#editNama').val().trim(), alamat: $('#editAlamat').val().trim() })
      .done(res=>{ location.reload(); })
      .fail(xhr=>{ alert('Gagal update: '+xhr.responseJSON?.message||xhr.statusText); });
  });

  $('#nonaktifModal').on('show.bs.modal', function(e){ $('#nonaktifId').val($(e.relatedTarget).data('id')); });
  $('#nonaktifForm').on('submit', function(e){
    e.preventDefault();
    $.post(`/organisasi/${$('#nonaktifId').val()}/nonaktif`, {})
      .done(res=>{ location.reload(); })
      .fail(xhr=>{ alert('Gagal nonaktif: '+xhr.responseJSON?.message||xhr.statusText); });
  });

  $('#hapusModal').on('show.bs.modal', function(e){ $('#hapusId').val($(e.relatedTarget).data('id')); });
  $('#hapusForm').on('submit', function(e){
    e.preventDefault();
    $.post(`/organisasi/${$('#hapusId').val()}/hapus`, {})
      .done(res=>{ location.reload(); })
      .fail(xhr=>{ alert('Gagal hapus: '+xhr.responseJSON?.message||xhr.statusText); });
  });
});
</script>
@endpush