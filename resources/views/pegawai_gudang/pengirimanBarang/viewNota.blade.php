<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Penjualan {{ $noNota ?? $transaksi->nomor_transaksi }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap');
        
        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            font-size: 13px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #e2e8f0;
            padding: 40px;
            background: #fff;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #0f172a;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header-logo h1 {
            color: #f59e0b;
            margin: 0 0 5px 0;
            font-size: 28px;
            font-weight: 800;
        }
        .header-meta {
            text-align: right;
        }
        .invoice-title {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .meta-table {
            width: 100%;
            margin-bottom: 30px;
        }
        .meta-table td {
            vertical-align: top;
            padding: 0;
        }
        .meta-col {
            width: 50%;
        }
        .meta-label {
            font-weight: 600;
            color: #64748b;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: block;
            margin-bottom: 3px;
        }
        .meta-value {
            font-weight: 700;
            font-size: 14px;
            color: #0f172a;
            margin-bottom: 15px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th {
            background-color: #f1f5f9;
            color: #0f172a;
            font-weight: 700;
            text-align: left;
            padding: 12px;
            border-top: 1px solid #cbd5e1;
            border-bottom: 2px solid #cbd5e1;
            font-size: 12px;
            text-transform: uppercase;
        }
        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }
        .items-table th.text-right, 
        .items-table td.text-right {
            text-align: right;
        }
        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }
        .totals-table td {
            padding: 8px 12px;
            text-align: right;
        }
        .totals-table td:first-child {
            width: 60%;
            font-weight: 600;
            color: #64748b;
        }
        .totals-table tr.grand-total td {
            font-weight: 800;
            color: #0f172a;
            font-size: 16px;
            border-top: 2px solid #0f172a;
            padding-top: 15px;
        }
        .totals-table tr.discount td {
            color: #ef4444;
        }
        .footer {
            margin-top: 50px;
            padding-top: 30px;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #64748b;
        }
        .signatures {
            width: 100%;
            margin-top: 40px;
        }
        .signatures td {
            width: 33.33%;
            text-align: center;
        }
        .signature-line {
            width: 80%;
            border-bottom: 1px solid #000;
            margin: 60px auto 10px auto;
        }
        
        /* Utility */
        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 10px;
            font-weight: 700;
            border-radius: 4px;
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
        }
    </style>
</head>
<body>
    @php
        $tanggalTransaksi = \Carbon\Carbon::parse($transaksi->tanggal_transaksi);
        $tahun = $tanggalTransaksi->format('y');
        $bulan = $tanggalTransaksi->format('m');
        $nomorUrut = $transaksi->id_transaksi;
        $noNota = "{$tahun}.{$bulan}.{$nomorUrut}";

        $jadwalPengiriman = $transaksi->penjadwalan->firstWhere('jenis_jadwal', 'Pengiriman') 
                            ?? $transaksi->penjadwalan->firstWhere('jenis_jadwal', 'Diambil');
        $labelTanggalKirim = ($jadwalPengiriman && $jadwalPengiriman->jenis_jadwal === 'Diambil') ? 'Tgl. Diambil' : 'Tgl. Dikirim';
        
        if ($jadwalPengiriman && $jadwalPengiriman->jenis_jadwal === 'Pengiriman') {
            $kurir = $jadwalPengiriman->pengiriman && $jadwalPengiriman->pengiriman->pegawai ? $jadwalPengiriman->pengiriman->pegawai->nama_pegawai : '-';
            $delivery = "ReUseMart Logistik ({$kurir})";
            $diterimaLabel = "Kurir/Pengirim";
        } elseif ($jadwalPengiriman && $jadwalPengiriman->jenis_jadwal === 'Diambil') {
            $delivery = "Ambil Mandiri (Gudang)";
            $diterimaLabel = "Staff Gudang";
        } else {
            $delivery = '-';
            $diterimaLabel = "Petugas";
        }
    @endphp

    <div class="invoice-container">
        <!-- Header -->
        <table style="width: 100%; margin-bottom: 30px;">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <div style="color: #f59e0b; font-size: 32px; font-weight: 800; margin-bottom: 5px; font-family: 'Outfit', sans-serif;">ReUseMart</div>
                    <div style="color: #64748b; font-size: 12px; line-height: 1.6;">
                        Jl. Green Eco Park No. 456<br>
                        Yogyakarta, Indonesia<br>
                        cs@reusemart.com | (0274) 123-4567
                    </div>
                </td>
                <td style="width: 50%; vertical-align: top; text-align: right;">
                    <div style="font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 2px;">INVOICE</div>
                    <div style="display: inline-block; background: #f8fafc; border: 1px solid #e2e8f0; padding: 10px 15px; border-radius: 6px; text-align: left;">
                        <span style="display: block; font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase;">No. Transaksi</span>
                        <span style="display: block; font-size: 16px; font-weight: 800; color: #0f172a;">#{{ $noNota }}</span>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Metadata -->
        <table class="meta-table">
            <tr>
                <!-- Bill To -->
                <td class="meta-col" style="padding-right: 20px;">
                    <div style="background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid #f1f5f9; height: 100%;">
                        <span class="meta-label">Ditagihkan Kepada:</span>
                        <div class="meta-value" style="margin-bottom: 5px;">{{ $transaksi->pembeli->nama_pembeli ?? 'Unknown Buyer' }}</div>
                        <div style="color: #64748b; font-size: 12px; line-height: 1.6;">
                            {{ $transaksi->pembeli->email ?? '-' }}<br>
                            @if ($transaksi->alamat)
                                {{ $transaksi->alamat->jalan }}, Kel. {{ $transaksi->alamat->kelurahan }}<br>
                                Kec. {{ $transaksi->alamat->kecamatan }}, {{ $transaksi->alamat->kota }}<br>
                                {{ $transaksi->alamat->provinsi }} {{ $transaksi->alamat->kode_pos }}
                            @else
                                <em>Alamat pengiriman tidak dispesifikasi.</em>
                            @endif
                        </div>
                    </div>
                </td>
                <!-- Dates & Info -->
                <td class="meta-col">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 50%;">
                                <span class="meta-label">Tgl. Pesanan</span>
                                <div class="meta-value">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y, H:i') }}</div>
                            </td>
                            <td style="width: 50%;">
                                <span class="meta-label">{{ $labelTanggalKirim }}</span>
                                <div class="meta-value">{{ \Carbon\Carbon::parse($transaksi->tanggal_kirim)->format('d M Y') ?? '-' }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">
                                <span class="meta-label">Status Bayar</span>
                                <div class="meta-value" style="color: #10b981;">LUNAS ({{ \Carbon\Carbon::parse($transaksi->tanggal_lunas)->format('d/m/Y') ?? '-' }})</div>
                            </td>
                            <td style="width: 50%;">
                                <span class="meta-label">Metode Logistik</span>
                                <div class="meta-value" style="font-size: 12px;">{{ $delivery }}</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Items -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 55%;">Deskripsi Produk</th>
                    <th style="width: 15%; text-align: center;">Qty</th>
                    <th style="width: 25%;" class="text-right">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->detailTransaksi as $index => $detail)
                    <tr>
                        <td style="color: #64748b;">{{ $index + 1 }}</td>
                        <td>
                            <div style="font-weight: 700; color: #0f172a;">{{ $detail->barang->nama_barang }}</div>
                            <div style="font-size: 11px; color: #64748b; margin-top: 3px;">SKU: {{ strtoupper(substr($detail->barang->nama_barang, 0, 1)) . $detail->barang->id_barang }} | Kategori: {{ $detail->barang->kategori->nama_kategori ?? '-' }}</div>
                        </td>
                        <td style="text-align: center;">1</td>
                        <td class="text-right" style="font-weight: 600;">Rp{{ number_format($detail->barang->harga_jual, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Calculations -->
        @php
            $subtotalBarang = $transaksi->detailTransaksi->sum(function($d) { return $d->barang->harga_jual; });
            
            $poinDidapat = floor($transaksi->total_pembayaran / 10000);
            $poinDigunakan = $transaksi->poin_digunakan ?? 0;
            $potonganPoinRp = floor($poinDigunakan / 100) * 10000;

            $ongkosKirim = 100000;
            if ($transaksi->total_pembayaran > 1500000 || ($jadwalPengiriman && $jadwalPengiriman->jenis_jadwal === 'Diambil')) {
                $ongkosKirim = 0;
            }
        @endphp

        <table style="width: 100%;">
            <tr>
                <td style="width: 50%; vertical-align: top; padding-right: 30px;">
                    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                        <span style="display: block; font-weight: 700; color: #166534; font-size: 14px; margin-bottom: 5px;">Ringkasan Poin ReUseMart</span>
                        <table style="width: 100%; font-size: 12px; color: #15803d;">
                            <tr>
                                <td>Poin Digunakan:</td>
                                <td style="text-align: right; font-weight: 600;">- {{ $poinDigunakan }} pts</td>
                            </tr>
                            <tr>
                                <td>Poin Didapat dari Transaksi Ini:</td>
                                <td style="text-align: right; font-weight: 600;">+ {{ $transaksi->poin_didapat }} pts</td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table class="totals-table">
                        <tr>
                            <td>Subtotal Produk:</td>
                            <td>Rp{{ number_format($subtotalBarang, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Biaya Pengiriman:</td>
                            <td>{{ $ongkosKirim == 0 ? 'GRATIS' : 'Rp' . number_format($ongkosKirim, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="discount">
                            <td>Diskon Tukar Poin:</td>
                            <td>- Rp{{ number_format($potonganPoinRp, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="grand-total">
                            <td>TOTAL DIBAYAR:</td>
                            <td>Rp{{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Signatures -->
        <table class="signatures">
            <tr>
                <td>
                    <div style="font-weight: 600; color: #64748b; font-size: 11px; text-transform: uppercase;">Divisi Quality Control</div>
                    <div class="signature-line"></div>
                    <div style="font-weight: 700; color: #0f172a;">P{{ $transaksi->qc->id_pegawai ?? '-' }} - {{ $transaksi->qc->nama_pegawai ?? 'Petugas Gudang' }}</div>
                </td>
                <td>
                    <div style="font-weight: 600; color: #64748b; font-size: 11px; text-transform: uppercase;">{{ $diterimaLabel }}</div>
                    <div class="signature-line"></div>
                    <div style="font-weight: 700; color: #0f172a;">( Tanda Tangan & Nama Terang )</div>
                </td>
                <td>
                    <div style="font-weight: 600; color: #64748b; font-size: 11px; text-transform: uppercase;">Penerima (Customer)</div>
                    <div class="signature-line"></div>
                    <div style="font-weight: 700; color: #0f172a;">{{ $transaksi->pembeli->nama_pembeli ?? 'Customer' }}</div>
                </td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="footer text-center" style="text-align: center;">
            <strong>Terima kasih telah berbelanja di ReUseMart!</strong><br>
            Jika Anda memiliki pertanyaan mengenai invoice ini, silakan hubungi Customer Service kami.<br>
            <em>Dokumen ini sah dan dicetak oleh sistem secara otomatis.</em>
        </div>
    </div>
</body>
</html>
