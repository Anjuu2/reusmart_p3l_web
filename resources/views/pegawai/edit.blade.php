@extends('Admin.dashboard')
@section('isi')
<div class="container py-4">
    <h3 class="mb-4">Edit Pegawai</h3>
    <form action="{{ route('pegawai.update', $pegawai->id_pegawai) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama_pegawai" class="form-control" value="{{ $pegawai->nama_pegawai }}" required>
        </div>
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ $pegawai->username }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $pegawai->email }}" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="{{ $pegawai->password }}" required>
        </div>
        <div class="mb-3">
            <label>No Telp</label>
            <input type="text" name="notelp" class="form-control" value="{{ $pegawai->notelp }}" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $pegawai->tanggal_lahir }}" required>
        </div>
        <div class="mb-3">
            <label>Jabatan</label>
            <select name="id_jabatan" class="form-control" required>
                @foreach($jabatan as $j)
                    <option value="{{ $j->id_jabatan }}" {{ $pegawai->id_jabatan == $j->id_jabatan ? 'selected' : '' }}>{{ $j->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection