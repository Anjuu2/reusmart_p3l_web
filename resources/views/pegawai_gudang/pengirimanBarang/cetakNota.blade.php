@extends('pegawai_gudang.dashboard')

@section('isi')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0" role="alert" style="background: #dcfce7; color: #166534; border-radius: var(--radius-lg);">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div class="d-flex align-items-center gap-3">
        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 1.5rem;">
            <i class="bi bi-printer"></i>
        </div>
        <div>
            <h3 class="m-0 text-dark font-outfit">Cetak Nota Transaksi</h3>
            <p class="text-muted small m-0">Daftar transaksi aktif siap cetak bukti fisik.</p>
        </div>
    </div>
</div>

<div class="card border-0 mb-4" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
    <div class="card-body p-0">
        <div class="table-responsive" style="border-radius: var(--radius-lg);">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted" style="font-size: 0.8rem; text-transform: uppercase;">
                    <tr>
                        <th class="border-bottom-0 py-3 px-4">Info Transaksi</th>
                        <th class="border-bottom-0 py-3">Total Saldo</th>
                        <th class="border-bottom-0 py-3">Logistik</th>
                        <th class="border-bottom-0 py-3 px-4 text-end">Dokumen</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($transaksi as $item)
                        @php
                            $jadwalPengiriman = $item->penjadwalan->firstWhere('jenis_jadwal', 'Pengiriman') 
                                                ?? $item->penjadwalan->firstWhere('jenis_jadwal', 'Diambil');
                            $statusJadwal = $jadwalPengiriman && $jadwalPengiriman->status_jadwal ? strtolower($jadwalPengiriman->status_jadwal) : '';
                            $jenisJadwal = $jadwalPengiriman ? $jadwalPengiriman->jenis_jadwal : '-';
                            
                            $namaKurir = '-';
                            if ($jadwalPengiriman && $jadwalPengiriman->jenis_jadwal === 'Pengiriman') {
                                $namaKurir = $jadwalPengiriman->pengiriman && $jadwalPengiriman->pengiriman->id_pegawai
                                    ? optional($jadwalPengiriman->pengiriman->pegawai)->nama_pegawai
                                    : '-';
                            }
                        @endphp

                        @if($statusJadwal !== 'diproses')
                        <tr>
                            <td class="px-4">
                                <div class="d-flex flex-column gap-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-bold text-primary">{{ $item->nomor_transaksi }}</span>
                                        @php
                                            $st = strtolower($item->status_transaksi);
                                            $badgeConfig = match(true) {
                                                $st === 'menunggu pembayaran' => ['bg-warning text-dark', 'bi-hourglass-split'],
                                                $st === 'dibatalkan' => ['bg-danger text-white', 'bi-x-circle'],
                                                $st === 'selesai' => ['bg-success text-white', 'bi-check-circle'],
                                                default => ['bg-info text-dark', 'bi-box-seam']
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeConfig[0] }} rounded-pill" style="font-size: 0.7rem;">
                                            <i class="bi {{ $badgeConfig[1] }} me-1"></i>{{ $item->status_transaksi }}
                                        </span>
                                    </div>
                                    <span class="text-dark fw-medium"><i class="bi bi-person me-1 text-muted"></i>{{ $item->pembeli->nama_pembeli ?? 'Unknown Buyer' }}</span>
                                    <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>{{ $item->tanggal_transaksi ? \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d M Y, H:i') : '-' }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-success fs-6">Rp{{ number_format($item->total_pembayaran, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    <span class="badge {{ $jenisJadwal === 'Pengiriman' ? 'bg-primary' : 'bg-secondary' }} bg-opacity-10 {{ $jenisJadwal === 'Pengiriman' ? 'text-primary' : 'text-secondary' }} border rounded-pill d-inline-flex align-items-center justify-content-center" style="width: fit-content; padding: 4px 12px; font-size: 0.75rem;">
                                        <i class="bi {{ $jenisJadwal === 'Pengiriman' ? 'bi-truck' : 'bi-shop' }} me-1"></i>{{ $jenisJadwal }}
                                    </span>
                                    @if($jenisJadwal === 'Pengiriman')
                                        <span class="text-muted small"><i class="bi bi-person-badge me-1"></i>Kurir: <span class="fw-medium text-dark">{{ $namaKurir }}</span></span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-end px-4">
                                @if(strtolower($item->status_transaksi) !== 'menunggu pembayaran' && strtolower($item->status_transaksi) !== 'dibatalkan')
                                    <a href="{{ route('pegawai_gudang.cetakNotaPdf', ['id' => $item->id_transaksi]) }}"
                                    target="_blank"
                                    class="btn fw-bold text-primary bg-primary bg-opacity-10 border-primary border-opacity-25 shadow-sm hover-primary-solid transition-all"
                                    style="border-radius: var(--radius-pill);">
                                        <i class="bi bi-printer-fill me-1"></i> Cetak PDF
                                    </a>
                                @else
                                    <button class="btn btn-light fw-bold text-muted border" style="border-radius: var(--radius-pill);" disabled title="Kondisi transaksi tidak mengizinkan cetak fisik">
                                        <i class="bi bi-dash-circle me-1"></i> Terkunci
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                </div>
                                <h6 class="text-dark fw-bold mb-1">Data Kosong</h6>
                                <p class="text-muted m-0">Tidak ada bukti transaksi siap cetak saat ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($transaksi->hasPages())
        <div class="card-footer bg-white border-top p-3 d-flex justify-content-center" style="border-bottom-left-radius: var(--radius-lg); border-bottom-right-radius: var(--radius-lg);">
            {{ $transaksi->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

<style>
    .hover-primary-solid:hover {
        background-color: var(--admin-primary) !important;
        color: white !important;
    }
    .transition-all {
        transition: all 0.2s ease;
    }
</style>
@endsection
