@extends('pegawai_gudang.dashboard')

@section('isi')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
        white-space: nowrap;
    }
    th {
        background-color: #f8f9fa;
    }
    .container-fluid {
        max-width: 1065px;
        margin: auto;
    }
    .btn-action {
        font-size: 14px;
        padding: 6px 12px;
    }
    .table-sm th,
    .table-sm td {
        padding: 0.45rem 0.5rem;
        font-size: 0.875rem;
        vertical-align: middle;
        white-space: nowrap;
    }

    .table-sm {
        table-layout: auto;
        width: 100%;
    }
</style>

<div class="container-fluid mt-2">
    <h3 class="mb-4 text-center"><strong>Daftar Transaksi Pengiriman / Pengambilan</strong></h3>

    <table class="table table-bordered table-striped table-sm align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>Nomor Transaksi</th>
                <th>Nama Pembeli</th>
                <th>Tanggal Transaksi</th>
                <th>Tanggal Jadwal</th>
                <th>Jenis Pengiriman</th>
                <th>Status Pengiriman</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $item)
                <tr>
                    <td>{{ $item->id_transaksi }}</td>
                    <td>{{ $item->pembeli->nama_pembeli ?? '-' }}</td>
                    <td>
                        @if ($item->tanggal_transaksi)
                            {{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d/m/Y H:i') }}
                        @else
                            <em style="color: #888;">-</em>
                        @endif
                    </td>
                    @php
                        $jadwal = $item->penjadwalan->firstWhere('jenis_jadwal', 'Pengiriman') 
                            ?? $item->penjadwalan->firstWhere('jenis_jadwal', 'Diambil');
                    @endphp
                    <td>
                        @if ($jadwal && $jadwal->tanggal_jadwal)
                            {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->format('d/m/Y H:i') }}
                        @else
                            <em style="color: #888;">Belum ditentukan</em>
                        @endif
                    </td>
                    <td>{{ $jadwal->jenis_jadwal ?? '-' }}</td>
                    <td>{{ $jadwal->status_jadwal ?? '-' }}</td>
                    <td>
                        @if (!$jadwal || !$jadwal->tanggal_jadwal)
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#jadwalModal{{$item->id_transaksi}}">
                                Pilih Jadwal
                            </button>

                            <div class="modal fade" id="jadwalModal{{$item->id_transaksi}}" tabindex="-1" aria-labelledby="jadwalModalLabel{{$item->id_transaksi}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('pegawai_gudang.pengiriman.tambahJadwal') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_transaksi" value="{{ $item->id_transaksi }}">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Pilih Jadwal {{ $jadwal->jenis_jadwal }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="tanggal_jadwal" class="form-label">Tanggal Jadwal</label>
                                                    <input type="datetime-local" name="tanggal_jadwal" class="form-control" required>
                                                    <small class="text-muted">Jika transaksi setelah jam 16:00, jadwal tidak boleh di hari yang sama.</small>
                                                </div>
                                                @if ($jadwal && $jadwal->jenis_jadwal === 'Pengiriman')
                                                    <div class="mb-3">
                                                        <label for="id_kurir" class="form-label">Pilih Kurir</label>
                                                        <select name="id_kurir" class="form-select" required>
                                                            <option value="">-- Pilih Kurir --</option>
                                                            @foreach ($kurir as $k)
                                                                <option value="{{ $k->id_pegawai }}">{{ $k->nama_pegawai }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="badge bg-success">Jadwal sudah ditentukan</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; color: #888;">Tidak ada transaksi pengiriman atau pengambilan saat ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $transaksi->links() }}
    </div>
</div>

<script>
    @if (session('error_modal'))
        var modalId = 'jadwalModal' + {{ session('error_modal') }};
        var myModal = new bootstrap.Modal(document.getElementById(modalId));
        myModal.show();
    @endif
</script>

@endsection
