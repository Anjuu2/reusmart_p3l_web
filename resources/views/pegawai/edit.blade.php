@extends('Admin.dashboard')
@section('isi')

<style>
    .form-label { font-weight: 600; color: var(--admin-text-main); font-size: 0.9rem; margin-bottom: 0.5rem; }
    .form-control, .form-select { border-radius: 10px; padding: 0.75rem 1rem; border-color: var(--admin-border); font-size: 0.95rem; background-color: #f8fafc; }
    .form-control:focus, .form-select:focus { border-color: var(--admin-primary); background-color: #fff; box-shadow: 0 0 0 0.25rem rgba(15, 23, 42, 0.1); }
    .custom-section { background: #fff; border-radius: 16px; padding: 30px; border: 1px solid var(--admin-border); box-shadow: var(--shadow-sm); margin-bottom: 24px; }
    .input-icon-wrapper { position: relative; }
    .input-icon-wrapper i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 1.1rem; }
    .input-icon-wrapper .form-control, .input-icon-wrapper .form-select { padding-left: 45px; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('pegawai.index') }}" class="btn btn-light border" style="border-radius: 12px; padding: 8px 16px;">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <div>
            <h3 class="m-0 text-dark font-outfit">Edit Profil Pegawai</h3>
            <p class="text-muted small m-0">Menyunting data akun <strong class="text-primary">P{{ $pegawai->id_pegawai }}</strong> milik {{ $pegawai->nama_pegawai }}.</p>
        </div>
    </div>
    
    <div class="text-end">
        @if($pegawai->status_aktif == 1)
            <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-pill"><i class="bi bi-check-circle-fill me-1"></i>Akun Aktif</span>
        @else
            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary px-3 py-2 rounded-pill"><i class="bi bi-dash-circle-fill me-1"></i>Akun Suspended</span>
        @endif
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0" role="alert" style="background: #fee2e2; color: #991b1b; border-radius: var(--radius-lg);">
        <div class="d-flex align-items-center mb-2">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
            <strong>Terjadi Kesalahan! Periksa input Anda:</strong>
        </div>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-8">
        <form action="{{ route('pegawai.update', $pegawai->id_pegawai) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="custom-section">
                <h5 class="font-outfit text-primary fw-bold mb-4 pb-2 border-bottom"><i class="bi bi-person-vcard me-2"></i>Informasi Data Diri</h5>
                
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label">Nama Lengkap Pegawai <span class="text-danger">*</span></label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-person"></i>
                            <input type="text" name="nama_pegawai" class="form-control" value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nomor WhatsApp/Telepon <span class="text-danger">*</span></label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-telephone"></i>
                            <input type="text" name="notelp" class="form-control" value="{{ old('notelp', $pegawai->notelp) }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="custom-section">
                <h5 class="font-outfit text-primary fw-bold mb-4 pb-2 border-bottom"><i class="bi bi-shield-lock me-2"></i>Kredensial & Hak Akses</h5>
                
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Username <span class="text-danger">*</span></label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-at"></i>
                            <input type="text" name="username" class="form-control" value="{{ old('username', $pegawai->username) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-envelope"></i>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $pegawai->email) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ubah Password</label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-key"></i>
                            <input type="password" name="password" class="form-control bg-warning bg-opacity-10 border-warning" value="{{ old('password', $pegawai->password) }}" required>
                        </div>
                        <div class="form-text text-warning mt-1"><i class="bi bi-exclamation-triangle me-1"></i>Perbarui hanya jika diminta oleh user yang bersangkutan.</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Penempatan Jabatan (Otorisasi Akses) <span class="text-danger">*</span></label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-briefcase"></i>
                            <select name="id_jabatan" class="form-select @error('id_jabatan') is-invalid @enderror" required style="padding-left: 45px;">
                                @foreach($jabatan as $j)
                                    <option value="{{ $j->id_jabatan }}" {{ (old('id_jabatan', $pegawai->id_jabatan) == $j->id_jabatan) ? 'selected' : '' }}>
                                        {{ $j->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-text mt-1 text-danger"><i class="bi bi-exclamation-triangle me-1"></i>Hati-hati, merubah level otorisasi mengubah hak akses secara drastis!</div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-2 pt-4 border-top">
                    <a href="{{ route('pegawai.index') }}" class="btn btn-light" style="border-radius: var(--radius-pill); font-weight: 600; padding: 12px 24px;">Batalkan</a>
                    <button type="submit" class="btn btn-warning shadow-sm" style="border-radius: var(--radius-pill); font-weight: 600; padding: 12px 24px;">
                        <i class="bi bi-save2-fill me-1"></i> Terapkan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection