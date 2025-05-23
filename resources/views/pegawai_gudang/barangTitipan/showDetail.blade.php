@extends('pegawai_gudang.dashboard')

@section('isi')
<style>
    th {
        width: 200px;
        white-space: nowrap;
    }
</style>

<div class="container mt-4">
    <h3 class="mb-5 text-center"><strong>Detail Barang Titipan</strong></h3>

    <div class="row">
        <div class="col-12">

        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered">
                    <tr>
                        <th>Kode Barang</th>
                        <td>{{ strtoupper(substr($barang->nama_barang, 0, 1)) . $barang->id_barang }}</td>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <td>{{ $barang->nama_barang }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td colspan="3">{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-3">
                <table class="table table-bordered">
                    <tr>
                        <th class="text-center">Status Barang</th>
                    </tr>
                    <tr>
                        <td class="text-center">{{ $barang->status_barang }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-9">
            <table class="table table-bordered">
                <tr>
                    <th>Berat</th>
                    <td>{{ $barang->berat }} kg</td>
                </tr>
                <tr>
                    <th>Harga Jual</th>
                    <td colspan="3">Rp{{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $barang->deskripsi }}</td>
                </tr>
            </table>
        </div>

        <div class="col-md-9">
            <table class="table table-bordered">
                <tr>
                    <th>Penitip</th>
                    <td>{{ $barang->penitip->nama_penitip ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Pegawai QC</th>
                    <td>{{ $barang->pegawaiQc->nama_pegawai ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Hunter</th>
                    <td colspan="3">
                        {{ $barang->hunter->nama_pegawai ?? '-' }}
                        @if ($barang->id_hunter)
                            <span class="badge bg-success ms-2">Barang Hunter</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-md-9">
            <table class="table table-bordered">
                <tr>
                    <th>Perpanjangan</th>
                    <td>{{ $barang->status_perpanjangan ? 'Ya' : 'Tidak' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td>{{ \Carbon\Carbon::parse($barang->tanggal_masuk)->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Tanggal Akhir</th>
                    <td>{{ \Carbon\Carbon::parse($barang->tanggal_akhir)->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Tanggal Keluar</th>
                    <td>{{ $barang->tanggal_keluar ? \Carbon\Carbon::parse($barang->tanggal_keluar)->format('d/m/Y H:i') : '-' }}</td>
                </tr>
            </table>
        </div>

        <div class="col-md-9">
            <table class="table table-bordered">
                <tr>
                    <th>Garansi</th>
                    <td>{{ $barang->garansi ? 'Tersedia' : 'Tidak Tersedia' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Garansi</th>
                    <td>{{ $barang->tanggal_garansi ? \Carbon\Carbon::parse($barang->tanggal_garansi)->format('d/m/Y') : '-' }}</td>
                </tr>
            </table>
        </div>

        <div class="col-md-5">
            <h5 style="font-size: 17px;"><strong>Foto Barang</strong></h5>
            <div class="d-flex flex-wrap gap-3">
                @if ($barang->foto_barang)
                    <img src="{{ asset('images/' . $barang->foto_barang) }}"
                        class="img-thumbnail"
                        style="max-width: 45%; height: auto;" alt="Foto 1">
                @endif

                @if ($barang->foto_barang_2)
                    <img src="{{ asset('images/' . $barang->foto_barang_2) }}"
                        class="img-thumbnail"
                        style="max-width: 45%; height: auto;" alt="Foto 2">
                @endif
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('pegawai_gudang.barangTitipan.index') }}" class="btn btn-secondary mt-4 mb-4 px-4">← Kembali</a>
        <a href="{{ route('pegawai_gudang.barangTitipan.edit', $barang->id_barang) }}" class="btn btn-sm btn-warning mt-4 mb-4 px-4 w-20" style="font-size: 16px; ">Edit</a>
    </div>
    
</div>
@endsection
