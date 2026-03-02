@extends('Admin.dashboard')
@section('isi')

@php
    $admin = auth()->guard('pegawai')->user();
@endphp

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div class="d-flex align-items-center gap-3">
        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 1.5rem;">
            <i class="bi bi-people"></i>
        </div>
        <div>
            <h3 class="m-0 text-dark font-outfit">Manajemen Pegawai</h3>
            <p class="text-muted small m-0">Kelola data seluruh staf dan otorisasi akses sistem.</p>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('pegawai.create') }}" class="btn btn-primary fw-bold" style="border-radius: var(--radius-pill); padding: 10px 20px;">
            <i class="bi bi-plus-lg me-1"></i> Tambah Pegawai Baru
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0" role="alert" style="background: #dcfce7; color: #166534; border-radius: var(--radius-lg);">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 mb-4" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
    <div class="card-header bg-white border-bottom pt-4 pb-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <h5 class="m-0 font-outfit text-dark fw-bold"><i class="bi bi-person-lines-fill text-primary me-2"></i>Daftar Staf Internal</h5>
        
        <form class="d-flex" action="{{ route('pegawai.search') }}" method="GET" style="max-width: 350px; width: 100%;">
            <div class="input-group" style="background: #f8fafc; border-radius: var(--radius-pill); overflow: hidden; border: 1px solid #e2e8f0;">
                <span class="input-group-text bg-transparent border-0 text-muted ps-3">
                    <i class="bi bi-search"></i>
                </span>
                <input class="form-control border-0 bg-transparent shadow-none" 
                    type="search" 
                    name="search" 
                    placeholder="Cari ID, Nama, atau Jabatan..." 
                    value="{{ request('search') }}">
                @if(request('search'))
                    <a href="{{ route('pegawai.index') }}" class="btn btn-link text-muted border-0 text-decoration-none px-3"><i class="bi bi-x"></i></a>
                @endif
            </div>
        </form>
    </div>
    
    <div class="card-body p-0">
        @if($pegawai->isEmpty())
            <div class="text-center py-5">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                    <i class="bi bi-people text-muted" style="font-size: 2rem;"></i>
                </div>
                <h6 class="text-dark fw-bold mb-1">Data Pegawai Kosong</h6>
                <p class="text-muted m-0">Tidak ada staf yang sesuai dengan kriteria pencarian.</p>
                @if(request('search'))
                    <a href="{{ route('pegawai.index') }}" class="btn btn-outline-secondary rounded-pill mt-3 px-4">Tampilkan Semua</a>
                @endif
            </div>
        @else
            <div class="table-responsive" style="border-bottom-left-radius: var(--radius-lg); border-bottom-right-radius: var(--radius-lg);">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-muted" style="font-size: 0.8rem; text-transform: uppercase;">
                        <tr>
                            <th class="border-bottom-0 py-3 px-4">Profil Pegawai</th>
                            <th class="border-bottom-0 py-3">Kontak Info</th>
                            <th class="border-bottom-0 py-3">Jabatan & Hak Akses</th>
                            <th class="border-bottom-0 py-3 text-center">Status</th>
                            <th class="border-bottom-0 py-3 px-4 text-end">Konfigurasi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @foreach($pegawai as $p)
                            <tr>
                                <td class="px-4">
                                    <div class="d-flex flex-column gap-1">
                                        <span class="fw-bold text-dark fs-6">{{ $p->nama_pegawai }}</span>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-light text-primary border rounded-pill">P{{ $p->id_pegawai }}</span>
                                            <span class="text-muted small"><i class="bi bi-person-badge text-muted me-1"></i>{{ $p->username }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-1 text-dark small">
                                        <span><i class="bi bi-envelope text-muted me-2"></i>{{ $p->email }}</span>
                                        <span><i class="bi bi-telephone text-muted me-2"></i>{{ $p->notelp }}</span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $jabatan = strtolower($p->jabatan->nama_jabatan ?? '');
                                        $badgeClass = match(true) {
                                            str_contains($jabatan, 'admin') => 'bg-danger text-white',
                                            str_contains($jabatan, 'cs') || str_contains($jabatan, 'customer') => 'bg-info text-dark',
                                            str_contains($jabatan, 'gudang') => 'bg-warning text-dark',
                                            str_contains($jabatan, 'kurir') || str_contains($jabatan, 'logistik') => 'bg-primary text-white',
                                            str_contains($jabatan, 'hunter') => 'bg-success text-white',
                                            default => 'bg-secondary text-white'
                                        };
                                        $icon = match(true) {
                                            str_contains($jabatan, 'admin') => 'bi-shield-lock-fill',
                                            str_contains($jabatan, 'cs') || str_contains($jabatan, 'customer') => 'bi-headset',
                                            str_contains($jabatan, 'gudang') => 'bi-box-seam',
                                            str_contains($jabatan, 'kurir') || str_contains($jabatan, 'logistik') => 'bi-truck',
                                            str_contains($jabatan, 'hunter') => 'bi-shop-window',
                                            default => 'bi-briefcase'
                                        };
                                    @endphp
                                    <span class="badge {!! $badgeClass !!} rounded-pill px-3 py-2" style="font-size: 0.75rem;">
                                        <i class="bi {!! $icon !!} me-1"></i> {{ $p->jabatan->nama_jabatan ?? '-' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($p->status_aktif == 1)
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-1 rounded-pill"><i class="bi bi-check-circle-fill me-1"></i>Aktif</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary px-3 py-1 rounded-pill"><i class="bi bi-dash-circle-fill me-1"></i>Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-end px-4">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('pegawai.edit', $p->id_pegawai) }}" class="btn btn-sm btn-light border text-primary" title="Edit Data" style="border-radius: var(--radius-pill) 0 0 var(--radius-pill);">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        
                                        @if($p->status_aktif == 1)
                                            <form action="{{ route('pegawai.nonaktifkan', $p->id_pegawai) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin MELUMPUHKAN hak akses pegawai ini?');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-light border text-warning" title="Nonaktifkan Akun" style="border-radius: 0;">
                                                    <i class="bi bi-power"></i> Suspend
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('pegawai.aktifkan', $p->id_pegawai) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin MENGAKTIFKAN kembali hak akses pegawai ini?');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-light border text-success" title="Aktifkan Akun" style="border-radius: 0;">
                                                    <i class="bi bi-bootstrap-reboot"></i> Restore
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('pegawai.destroy', $p->id_pegawai) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin MENGHAPUS secara PERMANEN (Hard Delete) pegawai ini? Tindakan ini tidak bisa dibatalkan!');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border text-danger" title="Hapus Permanen" style="border-radius: 0 var(--radius-pill) var(--radius-pill) 0;">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection
