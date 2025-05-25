@extends('pegawai_gudang.dashboard')
@section('isi')

@php
    $pegawai = auth()->guard('pegawai')->user();
@endphp

<div class="d-flex justify-content-center align-items-center" style="padding-top: 40px; padding-bottom: 40px;">
    <div class="card shadow" style="width: 1000px; height: 1100px;">
        <div class="card-body">
            <h2 class="mb-2 text-center"><strong>Tambah Barang Titipan</strong></h2>
            <p class="text-center">
                <strong>Oleh:</strong> P{{ $pegawai->id_pegawai }} - {{ $pegawai->nama_pegawai }}
            </p>

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

            <form action="{{ route('pegawai_gudang.barangTitipan.store') }}" method="POST"  enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id_penitip" value="{{ $penitip->id_penitip }}">
                <div class="mb-3">
                    <label class="form-label">Penitip</label>
                    <input type="text" class="form-control"
                        value="T{{ $penitip->id_penitip }} - {{ $penitip->nama_penitip }}" readonly>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="id_qc_pegawai" class="form-label">Pegawai QC</label>
                        <select name="id_qc_pegawai" class="form-select" required>
                            <option value="">-- Pilih Pegawai QC --</option>
                            @foreach ($pegawaiQc as $qc)
                                <option value="{{ $qc->id_pegawai }}" {{ old('id_qc_pegawai') == $qc->id_pegawai ? 'selected' : '' }}>
                                    P{{ $qc->id_pegawai }} - {{ $qc->nama_pegawai }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Hunter</label>
                        <select name="id_hunter" class="form-select">
                            <option value="">-- Tidak Ada --</option>
                            @foreach ($pegawaiHunter as $hunter)
                                <option value="{{ $hunter->id_pegawai }}">P{{ $hunter->id_pegawai }} - {{ $hunter->nama_pegawai }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" required value="{{ old('nama_barang') }}">
                    </div>

                    <div class="col-md-6 mb-3">
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
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="berat" class="form-label">Berat (kg)</label>
                        <input type="number" step="0.01" name="berat" class="form-control" required value="{{ old('berat') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="number" name="harga_jual" class="form-control" required value="{{ old('harga_jual') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Garansi</label>
                        <select name="garansi" class="form-select">
                            <option value="1">Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tanggal_garansi" class="form-label">Tanggal Garansi</label>
                        <input type="date" name="tanggal_garansi" class="form-control" value="{{ old('tanggal_garansi') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status Barang</label>
                        <input type="text" name="status_barang" class="form-control" value="{{ old('status_barang', 'Tersedia') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status Perpanjangan</label>
                        <select name="status_perpanjangan" class="form-select">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="datetime-local" id="tanggal_masuk" name="tanggal_masuk" class="form-control"
                            value="{{ old('tanggal_masuk', now()->format('Y-m-d\TH:i')) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="datetime-local" id="tanggal_akhir" name="tanggal_akhir" class="form-control"
                            value="{{ old('tanggal_akhir', now()->addDays(30)->format('Y-m-d\TH:i')) }}" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Barang (minimal 2 gambar)</label>
                    <input type="file" name="foto_barang[]" class="form-control" multiple required>
                    <small class="text-muted">Upload minimal 2 gambar. File bertipe .jpg, .jpeg, .png</small>
                </div>

                <div class="text-end">
                    <a href="{{ route('pegawai_gudang.barangTitipan.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tglMasuk = document.getElementById('tanggal_masuk');
        const tglAkhir = document.getElementById('tanggal_akhir');

        function updateTanggalAkhir() {
            if (!tglMasuk || !tglAkhir) return;

            const masuk = new Date(tglMasuk.value);

            console.log("Tanggal masuk:", tglMasuk.value);

            if (!isNaN(masuk.getTime())) {
                const akhir = new Date(masuk);
                akhir.setDate(masuk.getDate() + 30);
                akhir.setHours(masuk.getHours(), masuk.getMinutes(), 0, 0);

                const pad = n => n.toString().padStart(2, '0');
                const formatted = `${akhir.getFullYear()}-${pad(akhir.getMonth() + 1)}-${pad(akhir.getDate())}T${pad(akhir.getHours())}:${pad(akhir.getMinutes())}`;
                tglAkhir.value = formatted;
            }
        }

        // Jalankan sekali saat halaman load
        updateTanggalAkhir();

        // Jalankan saat user ubah input
        tglMasuk.addEventListener('input', updateTanggalAkhir);
        tglMasuk.addEventListener('change', updateTanggalAkhir);
    });
</script>
@endpush


