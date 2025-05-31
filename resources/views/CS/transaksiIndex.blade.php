@extends('CS.dashboard')

@section('isi')
<div class="container py-5">
    <h2 class="mb-4">Daftar Transaksi</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>ID Pembeli</th>
                    <th>Tanggal Transaksi</th>
                    <th>Nomor Transaksi</th>
                    <th>Status Transaksi</th>
                    <th>Bukti Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $index => $transaksi)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $transaksi->id_transaksi }}</td>
                        <td>{{ $transaksi->id_pembeli }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y') }}</td>
                        <td>{{ $transaksi->nomor_transaksi }}</td>
                        <td>
                            <span class="badge {{ $transaksi->status_transaksi === 'Lunas' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($transaksi->status_transaksi) }}
                            </span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#verifikasiModal{{ $transaksi->id_transaksi }}">
                                Verifikasi Bukti
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Data transaksi tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $transaksis->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>

    <div class="modal fade" id="verifikasiModal{{ $transaksi->id_transaksi }}" tabindex="-1" aria-labelledby="verifikasiModalLabel{{ $transaksi->id_transaksi }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifikasiModalLabel{{ $transaksi->id_transaksi }}">Verifikasi Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-center">
                    @if ($transaksi->bukti_pembayaran)
                        <img src="{{ asset('images/bukti_pembayaran/' . $transaksi->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid mb-3" style="max-height: 400px;">
                    @else
                        <p class="text-muted">Belum ada bukti pembayaran.</p>
                    @endif
                </div>
                <div class="modal-footer justify-content-between">
                    <form action="{{ route('cs.transaksi.verifikasi', $transaksi->id_transaksi) }}" method="POST" onsubmit="return confirm('Terima bukti pembayaran?')">
                        @csrf
                        <button type="submit" class="btn btn-success">Terima</button>
                    </form>

                    <form action="{{ route('cs.transaksi.tolak', $transaksi->id_transaksi) }}" method="POST" onsubmit="return confirm('Tolak bukti pembayaran?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
