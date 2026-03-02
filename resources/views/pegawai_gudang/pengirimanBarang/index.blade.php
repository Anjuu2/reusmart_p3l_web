@extends('pegawai_gudang.dashboard')

@section('isi')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="m-0 text-dark font-outfit">Transaksi Pengiriman & Pengambilan</h3>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0" role="alert" style="background: #dcfce7; color: #166534; border-radius: var(--radius-lg);">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0" role="alert" style="background: #fee2e2; color: #991b1b; border-radius: var(--radius-lg);">
        <div class="d-flex align-items-center mb-2">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Terjadi Kesalahan!</strong>
        </div>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
        <form class="d-flex gap-2 flex-wrap" action="{{ route('pegawai_gudang.pengiriman.index') }}" method="GET">
            <div class="input-group" style="width: 280px;">
                <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="bi bi-search text-muted"></i></span>
                <input class="form-control bg-light border-start-0 ps-0" type="search" name="search" placeholder="Cari transaksi..." value="{{ request('search') }}" style="border-radius: 0 12px 12px 0; font-size: 0.95rem;">
            </div>

            <input class="form-control bg-light text-muted" type="date" name="date" value="{{ request('date') }}" style="border-radius: 12px; width: 160px; font-size: 0.95rem;">

            <select name="status_pengiriman" class="form-select bg-light text-muted" style="border-radius: 12px; width: 180px; font-size: 0.95rem;">
                <option value="" disabled selected>Pilih Status</option>
                <option value="Diterima" {{ request('status_pengiriman') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="Dibatalkan" {{ request('status_pengiriman') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                <option value="Sampai" {{ request('status_pengiriman') == 'Sampai' ? 'selected' : '' }}>Sampai</option>
                <option value="Disiapkan" {{ request('status_pengiriman') == 'Disiapkan' ? 'selected' : '' }}>Disiapkan</option>
                <option value="Diantar" {{ request('status_pengiriman') == 'Diantar' ? 'selected' : '' }}>Diantar</option>
            </select>

            <button class="btn btn-dark" type="submit" style="border-radius: 12px; font-weight: 600; background: var(--admin-secondary);"><i class="bi bi-funnel me-1"></i> Filter</button>
        </form>
    </div>
    
    <div class="card-body p-4">
        <div class="table-responsive" style="border-radius: 12px; border: 1px solid var(--admin-border);">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">
                    <tr>
                        <th class="fw-bold border-bottom-0 px-4 py-3 text-center">ID</th>
                        <th class="fw-bold border-bottom-0 py-3">Nama Pembeli</th>
                        <th class="fw-bold border-bottom-0 py-3 text-center">Tgl. Transaksi</th>
                        <th class="fw-bold border-bottom-0 py-3 text-center">Tgl. Jadwal</th>
                        <th class="fw-bold border-bottom-0 py-3 text-center">Jenis</th>
                        <th class="fw-bold border-bottom-0 py-3 text-center">Status</th>
                        <th class="fw-bold border-bottom-0 px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($transaksi as $item)
                        <tr>
                            <td class="text-center fw-bold text-dark px-4">#{{ $item->id_transaksi }}</td>
                            <td class="fw-medium text-dark">
                                <i class="bi bi-person-circle text-muted me-2"></i>{{ $item->pembeli->nama_pembeli ?? '-' }}
                            </td>
                            <td class="text-center text-muted">
                                @if ($item->tanggal_transaksi)
                                    {{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d/m/Y H:i') }}
                                @else
                                    <em class="text-light-emphasis">-</em>
                                @endif
                            </td>
                            
                            @php
                                $jadwal = $item->penjadwalan->firstWhere('jenis_jadwal', 'Pengiriman') 
                                    ?? $item->penjadwalan->firstWhere('jenis_jadwal', 'Diambil');
                            @endphp

                            <td class="text-center fw-medium {{ $jadwal && $jadwal->tanggal_jadwal ? 'text-primary' : 'text-danger' }}">
                                @if ($jadwal && $jadwal->tanggal_jadwal)
                                    <i class="bi bi-calendar-event me-1"></i>{{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->format('d/m/Y H:i') }}
                                @else
                                    <em class="small">Belum ditentukan</em>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($jadwal && $jadwal->jenis_jadwal == 'Pengiriman')
                                    <span class="badge bg-light text-primary border border-primary px-3 rounded-pill"><i class="bi bi-truck me-1"></i> Kirim</span>
                                @elseif($jadwal && $jadwal->jenis_jadwal == 'Diambil')
                                    <span class="badge bg-light text-success border border-success px-3 rounded-pill"><i class="bi bi-shop me-1"></i> Ambil</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($jadwal && $jadwal->pengiriman && $jadwal->pengiriman->status_pengiriman)
                                    @php
                                        $status = $jadwal->pengiriman->status_pengiriman;
                                        $badgeClass = match($status) {
                                            'Diterima' => 'bg-success',
                                            'Dibatalkan' => 'bg-danger',
                                            'Sampai' => 'bg-primary',
                                            'Disiapkan' => 'bg-warning text-dark',
                                            'Diantar' => 'bg-info text-dark',
                                            default => 'bg-secondary',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2 fw-bold" style="font-size: 0.75rem;">{{ $status }}</span>
                                @else
                                    <span class="badge bg-light text-muted border px-2 py-1 rounded-pill small">Belum Disiapkan</span>
                                @endif
                            </td>
                            <td class="text-center px-4">
                                @if (!$jadwal || !$jadwal->tanggal_jadwal)
                                    @if ($jadwal && $jadwal->jenis_jadwal === 'Pengiriman')
                                        <!-- Pengiriman -->
                                        <button type="button" class="btn btn-sm btn-primary fw-bold px-3" style="border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#jadwalModal{{$item->id_transaksi}}">
                                            <i class="bi bi-calendar-plus me-1"></i> Pilih Jadwal
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="jadwalModal{{$item->id_transaksi}}" tabindex="-1" aria-hidden="true" style="text-align: left;">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0">
                                                    <form action="{{ route('pegawai_gudang.pengiriman.tambahJadwal') }}" method="POST" onsubmit="return confirm('Yakin ingin menyimpan jadwal ini?');">
                                                        @csrf
                                                        <input type="hidden" name="id_transaksi" value="{{ $item->id_transaksi }}">
                                                        <div class="modal-header bg-white">
                                                            <h5 class="modal-title m-0 font-outfit text-primary"><i class="bi bi-truck me-2"></i>Pilih Jadwal & Kurir</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body bg-light">
                                                            <div class="card border-0 shadow-sm p-3 mb-3">
                                                                <label for="tanggal_jadwal" class="form-label fw-bold small text-muted text-uppercase">Tanggal & Waktu Jadwal</label>
                                                                <input type="datetime-local" name="tanggal_jadwal" class="form-control bg-light" required min="{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('Y-m-d') }}T{{ (\Carbon\Carbon::parse($item->tanggal_transaksi)->hour >= 16 ? '00:00' : '00:00') }}">
                                                                <small class="text-danger mt-2 d-block"><i class="bi bi-info-circle me-1"></i>Jika transaksi setelah jam 16:00, jadwal tidak boleh di hari yang sama.</small>
                                                            </div>
                                                            <div class="card border-0 shadow-sm p-3">
                                                                <label for="id_kurir" class="form-label fw-bold small text-muted text-uppercase">Tugaskan Kurir</label>
                                                                <select name="id_kurir" class="form-select bg-light" required>
                                                                    <option value="">-- Pilih Kurir Pengantar --</option>
                                                                    @foreach ($kurir as $k)
                                                                        <option value="{{ $k->id_pegawai }}">{{ $k->nama_pegawai }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-white">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary px-4 fw-bold rounded-pill">Simpan Jadwal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($jadwal && $jadwal->jenis_jadwal === 'Diambil')
                                        <!-- Diambil -->
                                        <button type="button" class="btn btn-sm btn-primary fw-bold" style="border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#jadwalModal{{$item->id_transaksi}}">
                                            <i class="bi bi-calendar-check me-1"></i> Tentukan Jadwal
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="jadwalModal{{$item->id_transaksi}}" tabindex="-1" aria-hidden="true" style="text-align: left;">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0">
                                                    <form action="{{ route('pegawai_gudang.pengiriman.tambahJadwal') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_transaksi" value="{{ $item->id_transaksi }}">
                                                        <div class="modal-header bg-white">
                                                            <h5 class="modal-title font-outfit text-success"><i class="bi bi-shop me-2"></i>Pilih Jadwal Pengambilan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body bg-light">
                                                            <div class="card border-0 shadow-sm p-3">
                                                                <label for="tanggal_jadwal" class="form-label fw-bold small text-muted text-uppercase">Tanggal Jadwal Pengambilan</label>
                                                                <input type="datetime-local" name="tanggal_jadwal" class="form-control bg-light" required min="{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('Y-m-d') }}T{{ (\Carbon\Carbon::parse($item->tanggal_transaksi)->hour >= 16 ? '00:00' : '00:00') }}">
                                                                <small class="text-danger mt-2 d-block"><i class="bi bi-info-circle me-1"></i>Jika transaksi setelah jam 16:00, jadwal tidak boleh di hari yang sama.</small>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-white">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success px-4 fw-bold rounded-pill">Simpan Jadwal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    @if ($jadwal && $jadwal->pengiriman && $jadwal->pengiriman->status_pengiriman)
                                        @php
                                            $status = $jadwal->pengiriman->status_pengiriman;
                                            $showConfirmButton = 
                                                ($jadwal->jenis_jadwal === 'Pengiriman' && $status === 'Diantar') ||
                                                ($jadwal->jenis_jadwal === 'Diambil' && $status === 'Disiapkan');
                                        @endphp

                                        @if ($showConfirmButton)
                                            @if ($showConfirmButton && $jadwal->jenis_jadwal === 'Diambil')
                                                <form action="{{ route('pegawai_gudang.pengiriman.konfirmasi', ['id_jadwal' => $jadwal->id_jadwal]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin melakukan konfirmasi?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-dark fw-bold rounded-pill px-3">
                                                        <i class="bi bi-check-lg me-1"></i> Konfirmasi Ambil
                                                    </button>
                                                </form>
                                            @else
                                                <span class="badge bg-light text-muted border"><i class="bi bi-hourglass-split me-1"></i> Diproses</span>
                                            @endif
                                        @else
                                            <span class="badge bg-light text-muted border"><i class="bi bi-hourglass-split me-1"></i> Diproses</span>
                                        @endif
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="bi bi-box2 fs-1 d-block mb-3 text-light"></i>
                                Tidak ada transaksi pengiriman atau pengambilan saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-4">
            {{ $transaksi->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection
