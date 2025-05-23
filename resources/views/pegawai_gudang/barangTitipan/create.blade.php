@extends('pegawai_gudang.dashboard')
@section('isi')
<div class="d-flex justify-content-center align-items-center" style="min-height: 200vh;">
    <div class="card shadow" style="width: 800px; height: 1100px; margin-top: 20px; margin-bottom: 20px;">
        <div class="card-body">
            <h2 class="mb-4 text-center">Form Tambah Barang Titipan</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Oops!</strong> Ada kesalahan pada input:<br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pegawai_gudang.barangTitipan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" required value="{{ old('nama_barang') }}">
                </div>

                <input type="hidden" name="id_penitip" value="{{ $penitip->idPenitip }}">
                <div class="mb-3">
                    <label class="form-label">Penitip</label>
                    <input type="text" class="form-control" value="{{ $penitip->nama_penitip }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <select name="id_kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_qc_pegawai" class="form-label">Pegawai QC</label>
                    <select name="id_qc_pegawai" class="form-select" required>
                        <option value="">-- Pilih Pegawai QC --</option>
                        @foreach ($pegawaiQc as $qc)
                            <option value="{{ $qc->id_pegawai }}" {{ old('id_qc_pegawai') == $qc->id_pegawai ? 'selected' : '' }}>
                                {{ $qc->nama_pegawai }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_hunter" class="form-label">Hunter (opsional)</label>
                    <select name="id_hunter" class="form-select">
                        <option value="">-- Tidak ada --</option>
                        @foreach ($pegawaiQc as $hunter)
                            <option value="{{ $hunter->id_pegawai }}" {{ old('id_hunter') == $hunter->id_pegawai ? 'selected' : '' }}>
                                {{ $hunter->nama_pegawai }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="berat" class="form-label">Berat (kg)</label>
                    <input type="number" step="0.01" name="berat" class="form-control" required value="{{ old('berat') }}">
                </div>

                <div class="mb-3">
                    <label for="harga_jual" class="form-label">Harga Jual</label>
                    <input type="number" name="harga_jual" class="form-control" required value="{{ old('harga_jual') }}">
                </div>

                <div class="mb-3">
                    <label for="garansi" class="form-label">Garansi</label>
                    <select name="garansi" class="form-select">
                        <option value="">-- Tidak Ada --</option>
                        <option value="Tersedia" {{ old('garansi') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Tidak Tersedia" {{ old('garansi') == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_garansi" class="form-label">Tanggal Garansi</label>
                    <input type="date" name="tanggal_garansi" class="form-control" value="{{ old('tanggal_garansi') }}">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('pegawai_gudang.barangTitipan.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
