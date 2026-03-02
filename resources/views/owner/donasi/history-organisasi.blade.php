@extends('owner.dashboard')

@section('isi')

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div class="d-flex align-items-center gap-3">
        <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 1.5rem;">
            <i class="bi bi-clock-history"></i>
        </div>
        <div>
            <h3 class="m-0 text-dark font-outfit">Histori Donasi Distribusi</h3>
            <p class="text-muted small m-0">Riwayat pengiriman donasi kepada organisasi: <strong class="text-dark">{{ $organisasi->nama_organisasi }}</strong></p>
        </div>
    </div>
</div>

<div class="card border-0 mb-4" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
    <div class="card-header bg-white border-bottom pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-outfit text-dark fw-bold"><i class="bi bi-box2-heart text-warning me-2"></i>Detail Riwayat Logistik</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive" style="border-bottom-left-radius: var(--radius-lg); border-bottom-right-radius: var(--radius-lg);">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">
                    <tr>
                        <th class="border-bottom-0 py-3 px-4">Info Barang</th>
                        <th class="border-bottom-0 py-3">Tanggal Distribusi</th>
                        <th class="border-bottom-0 py-3">Penerima Resmi</th>
                        <th class="border-bottom-0 py-3 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($donasiHistori as $d)
                        <tr>
                            <td class="px-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center text-secondary" style="width: 45px; height: 45px; font-weight: bold;">
                                        {{ strtoupper(substr($d->barang_titipan->nama_barang ?? '-', 0, 1)) }}{{ $d->barang_titipan->id_barang ?? '-' }}
                                    </div>
                                    <div>
                                        <span class="fw-bold text-dark d-block">{{ $d->barang_titipan->nama_barang ?? '-' }}</span>
                                        <span class="text-muted small"><i class="bi bi-box me-1"></i>Inventaris ReUseMart</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-medium text-dark"><i class="bi bi-calendar-event text-muted me-2"></i>{{ $d->tanggal_donasi->format('d M Y') }}</span>
                            </td>
                            <td>
                                <span class="text-dark fw-medium"><i class="bi bi-person-check text-muted me-2"></i>{{ $d->penerima }}</span>
                            </td>
                            <td class="px-4 text-center">
                                <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3 py-2">
                                    <i class="bi bi-check2-all me-1"></i>Terkirim
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-hourglass-bottom fs-1 text-muted"></i>
                                </div>
                                <h6 class="text-dark fw-bold mb-1">Papan Histori Kosong</h6>
                                <p class="text-muted m-0">Belum ada donasi fisik yang dialokasikan ke organisasi ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
