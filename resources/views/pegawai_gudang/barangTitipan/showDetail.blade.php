@extends('pegawai_gudang.dashboard')

@section('isi')
<style>
    th {
        width: 200px;
        white-space: nowrap;
        padding: 10px;
        background-color: #f8f9fa;
    }

    td {
        padding: 10px;
        vertical-align: middle;
    }

    table {
        margin-bottom: 30px;
    }

    .container-fluid {
        max-width: 1065px;
        margin: auto;
    }

    .img-thumbnail {
        border: 1px solid #ddd;
        padding: 4px;
        background-color: #fff;
    }

    h5 {
        margin-top: 20px;
    }
</style>

<div class="container-fluid mt-2">
    <h3 class="mb-5 text-center"><strong>Detail Barang Titipan</strong></h3>

    <div class="row">
        <div class="col-12">

        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered table-striped table-hover">
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
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th class="text-center">Status Barang</th>
                    </tr>
                    <tr>
                        <td class="text-center">{{ $barang->status_barang }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered table-striped table-hover">
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
        </div>

        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>Penitip</th>
                        <td>T{{ $barang->penitip->id_penitip }} - {{ $barang->penitip->nama_penitip ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Pegawai QC</th>
                        <td>P{{ $barang->pegawaiQc->id_pegawai }} - {{ $barang->pegawaiQc->nama_pegawai ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Hunter</th>
                        <td colspan="3">
                            @if ($barang->hunter)
                                P{{ $barang->hunter->id_pegawai }} - {{ $barang->hunter->nama_pegawai }}
                                <span class="badge bg-success ms-2">Barang Hunter</span>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered table-striped table-hover">
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
        </div>

        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered table-striped table-hover">
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
        </div>

        <div class="row">
            <div class="col-md-5">
                <h5 style="font-size: 17px;"><strong>Foto Barang</strong></h5>
                <div class="d-flex flex-row flex-nowrap overflow-auto gap-3">
                    @foreach ($barang->fotoBarang as $index => $foto)
                        <div class="text-center">
                            <img src="{{ asset('images/barang/' . $foto->nama_file) }}"
                                class="img-thumbnail"
                                style="width: 200px; height: 200px; object-fit: contain; border: 1px solid #ccc;"
                                alt="Foto {{ $index + 1 }}">
                            <small class="text-muted d-block">Foto {{ $index + 1 }}</small>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('pegawai_gudang.barangTitipan.index') }}" class="btn btn-secondary mt-4 mb-4 px-4">← Kembali</a>
        <a href="{{ route('pegawai_gudang.barangTitipan.edit', $barang->id_barang) }}" class="btn btn-sm btn-warning mt-4 mb-4 px-4 w-20" style="font-size: 16px; ">Edit</a>
    </div>
    
</div>
@endsection
