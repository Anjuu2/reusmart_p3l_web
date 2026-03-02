@extends('pegawai_gudang.dashboard')

@section('isi')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('pegawai_gudang.notaPenitipan.index') }}" class="btn btn-light border" style="border-radius: 12px; padding: 8px 16px;">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <h3 class="m-0 text-dark font-outfit">Cari Penitip</h3>
    </div>
</div>

<div class="card border-0 mb-4" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
    <div class="card-body p-4 p-md-5">
        <div class="text-center mb-4">
            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 64px; height: 64px; font-size: 2rem;">
                <i class="bi bi-person-search"></i>
            </div>
            <h4 class="font-outfit fw-bold text-dark mb-2">Pilih Akun Penitip</h4>
            <p class="text-muted">Cari profil penitip untuk memulai pembuatan Nota Penitipan baru.</p>
        </div>

        <form method="GET" action="{{ route('pegawai_gudang.barangTitipan.cariPenitip') }}" class="mb-5 max-w-lg mx-auto" style="max-width: 600px;">
            <div class="input-group input-group-lg shadow-sm" style="border-radius: var(--radius-pill);">
                <span class="input-group-text bg-white border-end-0" style="border-radius: var(--radius-pill) 0 0 var(--radius-pill); padding-left: 20px;">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" name="search" class="form-control border-start-0 border-end-0 px-0" placeholder="Ketik ID, Nama, No KTP, Username, Email..." value="{{ request('search') }}" style="font-size: 1rem;">
                <button class="btn btn-primary px-4 fw-bold" style="border-radius: 0 var(--radius-pill) var(--radius-pill) 0;">
                    Cari Penitip
                </button>
            </div>
            @if(!request('search'))
                <div class="text-center mt-3">
                    <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Masukkan setidaknya 3 karakter untuk hasil yang akurat.</small>
                </div>
            @endif
        </form>

        @if(count($penitip) > 0)
        <div class="table-responsive" style="border-radius: 12px; border: 1px solid var(--admin-border);">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted" style="font-size: 0.8rem; text-transform: uppercase;">
                    <tr>
                        <th class="border-bottom-0 py-3 px-4">Profil Penitip</th>
                        <th class="border-bottom-0 py-3">Kontak & Alamat</th>
                        <th class="border-bottom-0 py-3 text-center">Status</th>
                        <th class="border-bottom-0 py-3 px-4 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach($penitip as $p)
                    <tr>
                        <td class="px-4">
                            <div class="d-flex flex-column">
                                <span class="fw-bold text-dark mb-1">{{ $p->nama_penitip }}</span>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-light text-primary border rounded-pill">T{{ $p->id_penitip }}</span>
                                    <span class="text-muted small"><i class="bi bi-person-badge me-1"></i>{{ $p->username }}</span>
                                </div>
                                <span class="text-muted small mt-1"><i class="bi bi-credit-card-2-front me-1"></i>{{ $p->no_ktp }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-1">
                                <span class="text-dark small"><i class="bi bi-envelope me-2 text-muted"></i>{{ $p->email }}</span>
                                <span class="text-muted small" style="max-width: 250px; white-space: normal;"><i class="bi bi-geo-alt me-2 text-muted"></i>{{ $p->alamat }}</span>
                            </div>
                        </td>
                        <td class="text-center">
                            @if($p->status_aktif == 1)
                                <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-pill fw-bold" style="font-size: 0.75rem;"><i class="bi bi-person-check-fill me-1"></i>Aktif</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary px-3 py-2 rounded-pill fw-bold" style="font-size: 0.75rem;"><i class="bi bi-person-dash-fill me-1"></i>Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-end px-4">
                            @if($p->status_aktif == 1)
                                <a href="{{ route('pegawai_gudang.notaPenitipan.create', ['id_penitip' => $p->id_penitip]) }}" class="btn btn-primary fw-bold" style="border-radius: var(--radius-pill);">
                                    Pilih Penitip <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            @else
                                <button class="btn btn-light text-muted fw-bold" style="border-radius: var(--radius-pill);" disabled title="Akun penitip tidak aktif">
                                    <i class="bi bi-lock-fill me-1"></i> Terkunci
                                </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @elseif(request('search'))
            <div class="text-center py-5">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                    <i class="bi bi-search text-muted" style="font-size: 2rem;"></i>
                </div>
                <h5 class="text-dark fw-bold mb-2">Penitip Tidak Ditemukan</h5>
                <p class="text-muted mb-4">Tidak ada data penitip yang cocok dengan kata kunci "{{ request('search') }}".</p>
                <a href="{{ route('pegawai_gudang.barangTitipan.cariPenitip') }}" class="btn btn-outline-secondary rounded-pill px-4">Reset Pencarian</a>
            </div>
        @endif
    </div>
</div>
@endsection
