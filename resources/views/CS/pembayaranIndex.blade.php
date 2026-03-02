@extends('CS.dashboard')

@section('isi')

<style>
    .card-modern { background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.05); }
    .table-custom { border-collapse: separate; border-spacing: 0 0.5rem; margin-top: -0.5rem; }
    .table-custom thead th { border: none; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; padding: 0.75rem 1.25rem; font-weight: 700; background: transparent; white-space: nowrap;}
    .table-custom tbody tr { background-color: #f8fafc; transition: transform 0.2s ease, box-shadow 0.2s ease; border-radius: 12px; }
    .table-custom tbody tr:hover { transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.1); z-index: 1; position: relative; }
    .table-custom tbody td { border: none; padding: 1rem 1.25rem; background-color: #fff; vertical-align: middle; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; font-size: 0.95rem; color: #334155;}
    .table-custom tbody td:first-child { border-left: 1px solid #f1f5f9; border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
    .table-custom tbody td:last-child { border-right: 1px solid #f1f5f9; border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
    
    .status-badge { padding: 6px 12px; border-radius: 30px; font-size: 0.8rem; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; gap: 4px; border: 1px solid transparent; width: 140px;}
    .status-active { background: #dcfce7; color: #166534; border-color: #bbf7d0; }
    .status-inactive { background: #fee2e2; color: #991b1b; border-color: #fecaca; }
    .status-pending { background: #fef3c7; color: #b45309; border-color: #fde68a; }
    
    .btn-action { padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; border: none;}
    .btn-verify { background: #eff6ff; color: #2563eb; }
    .btn-verify:hover { background: #3b82f6; color: white; transform: translateY(-2px); box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2); }
    
    /* Document Thumbnail Style */
    .doc-thumbnail { width: 45px; height: 45px; border-radius: 8px; object-fit: cover; border: 2px solid #e2e8f0; cursor: pointer; transition: transform 0.2s;}
    .doc-thumbnail:hover { transform: scale(1.1); border-color: #10b981; }
    
    .alert-custom { border-radius: 12px; border: none; font-weight: 600; padding: 1rem 1.25rem; }
    .alert-success-custom { background: #dcfce7; color: #166534; border-left: 4px solid #166534;}
    .alert-error-custom { background: #fee2e2; color: #991b1b; border-left: 4px solid #991b1b;}
</style>

<div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
    <div>
        <h3 class="m-0 text-dark font-outfit fw-bold">Verifikasi Pembayaran</h3>
        <p class="text-muted small m-0 mt-1">Sistem validasi mutasi pembayaran dari transaksi pembeli ReUseMart.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-custom alert-success-custom alert-dismissible fade show mb-4 d-flex align-items-center" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i> 
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-custom alert-error-custom alert-dismissible fade show mb-4 d-flex align-items-start shadow-sm">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5 mt-1"></i>
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close ms-auto mt-1" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card-modern p-4">
    <div class="table-responsive">
        <table class="table table-custom w-100 mb-0">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 15%;">Ref Transaksi</th>
                    <th style="width: 15%;">Tipe Identitas</th>
                    <th style="width: 25%;" class="text-center">Status Verifikasi</th>
                    <th style="width: 15%;" class="text-center">Dokumen Mutasi</th>
                    <th style="width: 15%;" class="text-end">Aksi CS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembayarans as $index => $pembayaran)
                    <tr>
                        <td class="text-muted fw-bold">#{{ $pembayarans->firstItem() + $index }}</td>
                        <td>
                            <div class="fw-bold text-dark">TRX-{{ str_pad($pembayaran->id_transaksi, 4, '0', STR_PAD_LEFT) }}</div>
                            <div class="small text-muted font-monospace mt-1">PAY-{{ str_pad($pembayaran->id_pembayaran, 4, '0', STR_PAD_LEFT) }}</div>
                        </td>
                        <td>
                            <div class="small text-dark fw-medium"><i class="bi bi-person me-1 text-muted"></i> Pembeli: <span class="fw-bold">B-{{ $pembayaran->id_pembeli }}</span></div>
                            <div class="small text-muted mt-1"><i class="bi bi-person-badge me-1"></i> Validator: <span class="fw-bold">{{ $pembayaran->id_pegawai ? 'PEG-'.$pembayaran->id_pegawai : 'Menunggu' }}</span></div>
                        </td>
                        <td class="text-center">
                            @php
                                $status = (int) $pembayaran->status_verifikasi;
                                $idPegawai = $pembayaran->id_pegawai;
                                $badgeClass = 'status-pending';
                                $statusText = 'Menunggu Validasi';
                                $icon = 'bi-hourglass-split';

                                if ($status === 0 && (is_null($idPegawai) || $idPegawai == '')) {
                                    $badgeClass = 'status-pending';
                                    $statusText = 'Menunggu Validasi';
                                    $icon = 'bi-hourglass-split';
                                } elseif ($status === 0 && !is_null($idPegawai) && $idPegawai != '') {
                                    $badgeClass = 'status-inactive';
                                    $statusText = 'Ditolak';
                                    $icon = 'bi-x-circle-fill';
                                } elseif ($status === 1) {
                                    $badgeClass = 'status-active';
                                    $statusText = 'Valid/Lunas';
                                    $icon = 'bi-check-circle-fill';
                                }
                            @endphp
                            <span class="status-badge {{ $badgeClass }}">
                                <i class="bi {{ $icon }}"></i> {{ $statusText }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if ($pembayaran->bukti_transfer)
                                <img src="{{ asset('images/bukti_pembayaran/' . $pembayaran->bukti_transfer) }}" class="doc-thumbnail" alt="Bukti" data-bs-toggle="modal" data-bs-target="#verifikasiModal{{ $pembayaran->id_pembayaran }}" title="Klik untuk perbesar">
                            @else
                                <span class="badge bg-light text-muted border px-2 py-1"><i class="bi bi-image-alt me-1"></i>Kosong</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if ($pembayaran->bukti_transfer)
                                <button type="button" class="btn-action btn-verify" data-bs-toggle="modal" data-bs-target="#verifikasiModal{{ $pembayaran->id_pembayaran }}">
                                    <i class="bi bi-shield-check"></i> Audit Mutasi
                                </button>
                            @else
                                <button type="button" class="btn-action btn-verify disabled opacity-50" disabled>
                                    <i class="bi bi-shield-slash"></i> Menunggu Upload
                                </button>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal Pemeriksaan Dokumen (Review Modal) -->
                    @if ($pembayaran->bukti_transfer)
                    <div class="modal fade" id="verifikasiModal{{ $pembayaran->id_pembayaran }}" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content" style="border-radius: var(--radius-lg); border: none; overflow:hidden;">
                                <div class="modal-header border-bottom px-4 pt-4 bg-light">
                                    <div>
                                        <h5 class="modal-title font-outfit fw-bold text-dark m-0"><i class="bi bi-search text-primary me-2"></i>Audit Bukti Transfer</h5>
                                        <p class="small text-muted m-0 mt-1">Referensi Pembayaran: <strong class="font-monospace text-dark">PAY-{{ str_pad($pembayaran->id_pembayaran, 4, '0', STR_PAD_LEFT) }}</strong></p>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body p-0 bg-dark text-center">
                                    <div style="max-height: 60vh; overflow-y: auto; padding: 20px;">
                                        <img src="{{ asset('images/bukti_pembayaran/' . $pembayaran->bukti_transfer) }}" alt="Bukti Pembayaran" class="img-fluid rounded shadow" style="max-width: 100%;">
                                    </div>
                                </div>
                                <div class="modal-footer border-top px-4 py-3 bg-light d-flex justify-content-between align-items-center">
                                    
                                    <form action="{{ route('cs.pembayaran.tolak', $pembayaran->id_transaksi) }}" method="POST" onsubmit="return confirm('Peringatan: Menolak pembayaran akan membatalkan pemesanan. Lanjutkan penolakan?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm" @if($pembayaran->status_verifikasi == 1) disabled @endif>
                                            <i class="bi bi-x-circle me-1"></i> Tolak (Palsu/Batal)
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('cs.pembayaran.verifikasi', $pembayaran->id_transaksi) }}" method="POST" onsubmit="return confirm('Konfirmasi: Dana telah masuk ke rekening perusahaan?')">
                                        @csrf
                                        <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold shadow-sm" @if($pembayaran->status_verifikasi == 1) disabled @endif>
                                            <i class="bi bi-check2-all me-1"></i> Verifikasi Sah
                                        </button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                <i class="bi bi-cash-stack fs-1 text-muted"></i>
                            </div>
                            <h6 class="text-dark fw-bold font-outfit">Papan Antrean Kosong</h6>
                            <p class="text-muted small m-0">Tidak ada data transaksi mutasi yang masuk ke sistem.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end pt-3">
        {!! $pembayarans->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>

@endsection
