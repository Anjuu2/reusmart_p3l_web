@extends('pegawai_gudang.dashboard')

@section('isi')
<div class="container mt-4">
    <h4 class="mb-3"><strong>Cari Penitip</strong></h4>

    <form method="GET" action="{{ route('pegawai_gudang.barangTitipan.cariPenitip') }}" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Cari Data Penitip (ID, Nama, No KTP, Nama, Username, Alamat, Email)" value="{{ request('search') }}">
        <button class="btn btn-outline-dark">Cari</button>
    </form>

    @if(count($penitip) > 0)
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>No KTP</th>
                <th>Username</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penitip as $p)
            <tr>
                <td>T{{ $p->id_penitip }}</td>
                <td>{{ $p->nama_penitip }}</td>
                <td>{{ $p->no_ktp }}</td>
                <td>{{ $p->username}}</td>
                <td>{{ $p->alamat }}</td>
                <td>{{ $p->email}}</td>
                <td>
                    <span class="badge {{ $p->status_aktif == 1 ? 'bg-success' : 'bg-secondary' }}">
                        {{ $p->status_aktif == 1 ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('pegawai_gudang.barangTitipan.create', $p->id_penitip) }}" class="btn btn-success btn-sm">
                        Pilih
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @elseif(request('search'))
        <p class="text-muted">Data Penitip tidak ditemukan.</p>
    @endif
</div>
@endsection
