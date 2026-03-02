@extends('pegawai_gudang.dashboard')

@section('isi')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('pegawai_gudang.barangTitipan.cariPenitip') }}" class="btn btn-light border" style="border-radius: 12px; padding: 8px 16px;">
            <i class="bi bi-arrow-left me-1"></i> Ganti Penitip
        </a>
        <h3 class="m-0 text-dark font-outfit">Buat Nota Penitipan</h3>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0" role="alert" style="background: #fee2e2; color: #991b1b; border-radius: var(--radius-lg);">
        <div class="d-flex align-items-center mb-2">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
            <strong>Terjadi Kesalahan!</strong>
        </div>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0" role="alert" style="background: #dcfce7; color: #166534; border-radius: var(--radius-lg);">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 mb-4" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
            <div class="card-header bg-white border-bottom pt-4 pb-3 px-4 d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-size: 1.25rem;">
                    <i class="bi bi-receipt"></i>
                </div>
                <div>
                    <h5 class="m-0 font-outfit text-dark fw-bold">Detail Nota Baru</h5>
                    <p class="text-muted small m-0">Lengkapi informasi inisiasi nota penitipan.</p>
                </div>
            </div>
            
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('pegawai_gudang.notaPenitipan.store') }}" method="POST">
                    @csrf

                    <!-- Penitip Terpilih -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Data Penitip Terpilih</label>
                        <input type="hidden" name="id_penitip" value="{{ $terpilih->id_penitip }}">
                        <div class="d-flex align-items-center p-3 rounded bg-light border">
                            <div class="bg-white rounded-circle border d-flex align-items-center justify-content-center text-primary fw-bold me-3 shadow-sm" style="width: 48px; height: 48px;">
                                T{{ $terpilih->id_penitip }}
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark m-0">{{ $terpilih->nama_penitip }}</h6>
                                <span class="text-muted small"><i class="bi bi-check-circle-fill text-success me-1"></i> Penjual Terverifikasi</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pegawai QC -->
                    <div class="mb-4">
                        <label for="id_qc_pegawai" class="form-label fw-bold text-dark">Pegawai QC <span class="text-danger">*</span></label>
                        <select name="id_qc_pegawai" id="id_qc_pegawai" class="form-select form-select-lg bg-light" style="border-radius: 12px; font-size: 1rem;" required>
                            <option value="">-- Tugaskan Pegawai QC --</option>
                            @foreach($pegawaiQc as $peg)
                                <option value="{{ $peg->id_pegawai }}" {{ old('id_qc_pegawai') == $peg->id_pegawai ? 'selected' : '' }}>
                                    P{{ $peg->id_pegawai }} - {{ $peg->nama_pegawai }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text mt-2"><i class="bi bi-info-circle me-1"></i>Pegawai Quality Control bertanggung jawab memeriksa barang fisik yang dititipkan.</div>
                    </div>

                    <div class="row g-4 mb-5">
                        <!-- Tanggal Penitipan -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Tanggal Penitipan <span class="text-danger">*</span></label>
                            <input type="datetime-local" id="tanggal_penitipan" name="tanggal_penitipan" class="form-control bg-light" style="border-radius: 12px; padding: 10px 15px;"
                                value="{{ old('tanggal_penitipan', now()->format('Y-m-d\TH:i')) }}">
                        </div>

                        <!-- Masa Berakhir -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Masa Berakhir (Sistem)</label>
                            <input type="datetime-local" id="masa_berakhir" name="masa_berakhir" class="form-control bg-secondary bg-opacity-10 text-muted" style="border-radius: 12px; padding: 10px 15px; border-style: dashed;"
                                value="{{ old('masa_berakhir', now()->addDays(30)->format('Y-m-d\TH:i')) }}" readonly>
                            <div class="form-text mt-1">Otomatis +30 Hari dari tanggal titip.</div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('pegawai_gudang.notaPenitipan.index') }}" class="btn btn-light" style="border-radius: var(--radius-pill); font-weight: 600; padding: 12px 24px;">Batal</a>
                        <button type="submit" class="btn btn-primary shadow-sm" style="border-radius: var(--radius-pill); font-weight: 600; padding: 12px 24px;">
                            Simpan & Lanjutkan <i class="bi bi-arrow-right ms-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tglMasuk = document.getElementById('tanggal_penitipan');
        const tglAkhir = document.getElementById('masa_berakhir');

        function updateTanggalAkhir() {
            if (!tglMasuk || !tglAkhir) return;
            const masuk = new Date(tglMasuk.value);

            if (!isNaN(masuk.getTime())) {
                const akhir = new Date(masuk);
                akhir.setDate(masuk.getDate() + 30);
                akhir.setHours(masuk.getHours(), masuk.getMinutes(), 0, 0);

                const pad = n => n.toString().padStart(2, '0');
                const formatted = `${akhir.getFullYear()}-${pad(akhir.getMonth() + 1)}-${pad(akhir.getDate())}T${pad(akhir.getHours())}:${pad(akhir.getMinutes())}`;
                tglAkhir.value = formatted;
            }
        }

        updateTanggalAkhir();
        tglMasuk.addEventListener('input', updateTanggalAkhir);
        tglMasuk.addEventListener('change', updateTanggalAkhir);
    });
</script>
@endpush
