<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Terima Penitipan #{{ $nota->no_nota }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        
        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            font-size: 13px;
            line-height: 1.5;
            color: #1e293b;
            margin: 0;
            padding: 30px;
            background: #f8fafc;
        }
        .document-wrapper {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 40px;
            border-top: 6px solid #f59e0b; /* Orange Accent */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .company-info h1 {
            color: #0f172a; /* Dark Blue */
            margin: 0 0 5px 0;
            font-size: 28px;
            font-weight: 800;
        }
        .company-info p {
            color: #64748b;
            margin: 0;
            font-size: 13px;
        }
        .doc-title-container {
            text-align: right;
        }
        .doc-title {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 0 5px 0;
        }
        .doc-number {
            display: inline-block;
            background: #f1f5f9;
            color: #334155;
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 14px;
            border: 1px solid #cbd5e1;
        }
        
        /* Grid Layout for Meta */
        .meta-grid {
            display: table;
            width: 100%;
            margin-bottom: 30px;
            border-spacing: 15px 0;
        }
        .meta-col {
            display: table-cell;
            width: 50%;
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }
        .meta-header {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 12px;
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 5px;
        }
        .meta-row {
            margin-bottom: 8px;
        }
        .meta-label {
            display: inline-block;
            width: 110px;
            color: #64748b;
            font-weight: 600;
            font-size: 12px;
        }
        .meta-value {
            display: inline-block;
            font-weight: 700;
            color: #0f172a;
        }
        
        /* Items Table */
        .items-title {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 15px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th {
            background-color: #0f172a;
            color: #fff;
            text-align: left;
            padding: 12px 15px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .items-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }
        .items-table tr.even {
            background-color: #f8fafc;
        }
        .item-name {
            font-weight: 700;
            color: #1e293b;
            font-size: 14px;
            display: block;
            margin-bottom: 4px;
        }
        .item-sku {
            color: #f59e0b;
            font-weight: 700;
            font-size: 11px;
        }
        .item-badge {
            display: inline-block;
            padding: 2px 6px;
            background: #e2e8f0;
            color: #475569;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            margin-top: 4px;
        }
        .item-badge.garansi {
            background: #dcfce7;
            color: #166534;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        
        /* Summary & Signatures */
        .summary-box {
            background: #f1f5f9;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 40px;
            border-left: 4px solid #0f172a;
        }
        .signatures {
            width: 100%;
            margin-top: 60px;
            page-break-inside: avoid;
        }
        .signatures td {
            width: 50%;
            text-align: center;
        }
        .sign-title {
            font-weight: 600;
            color: #64748b;
            font-size: 12px;
        }
        .sign-line {
            width: 60%;
            border-bottom: 1px solid #0f172a;
            margin: 70px auto 10px auto;
        }
        .sign-name {
            font-weight: 800;
            color: #0f172a;
            font-size: 14px;
        }
        .sign-id {
            color: #64748b;
            font-size: 11px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #94a3b8;
            border-top: 1px dotted #cbd5e1;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="document-wrapper">
        <!-- Header Section -->
        <table style="width: 100%; border-bottom: 2px solid #e2e8f0; padding-bottom: 20px; margin-bottom: 30px;">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <div style="color: #f59e0b; font-size: 28px; font-weight: 800; margin-bottom: 5px;">ReUseMart</div>
                    <div style="color: #64748b; font-size: 12px; line-height: 1.6;">
                        Jl. Green Eco Park No. 456<br>
                        Yogyakarta, Indonesia<br>
                        Gudang Penerimaan Barang
                    </div>
                </td>
                <td style="width: 50%; vertical-align: top; text-align: right;">
                    <div style="font-size: 20px; font-weight: 800; color: #0f172a; text-transform: uppercase; margin-bottom: 10px;">Tanda Terima Titip Jual</div>
                    <div style="display: inline-block; background: #f8fafc; padding: 8px 15px; border-radius: 6px; border: 1px solid #cbd5e1;">
                        <span style="font-weight: 700; color: #0f172a; font-size: 16px;">#{{ $nota->no_nota }}</span>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Metadata Section -->
        <div class="meta-grid">
            <div class="meta-col">
                <div class="meta-header">Informasi Penitipan</div>
                <div class="meta-row">
                    <span class="meta-label">Tanggal Masuk:</span>
                    <span class="meta-value">{{ \Carbon\Carbon::parse($nota->tanggal_penitipan)->format('d M Y, H:i') }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Status Aktif:</span>
                    <span class="meta-value" style="color: #10b981;">s/d {{ \Carbon\Carbon::parse($nota->masa_berakhir)->format('d M Y') }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Total Barang:</span>
                    <span class="meta-value">{{ count($barangNota) }} Item(s) Fisik</span>
                </div>
            </div>
            <div class="meta-col">
                <div class="meta-header">Pihak Penitip (Pemilik Barang)</div>
                <div class="meta-row">
                    <span class="meta-label">ID / Nama:</span>
                    <span class="meta-value">T{{ $penitip->id_penitip }} / {{ $penitip->nama_penitip }}</span>
                </div>
                <div class="meta-row" style="margin-top: 8px;">
                    <span class="meta-value" style="font-weight: normal; color: #475569; font-size: 12px; line-height: 1.5;">
                        {{ $penitip->alamat }}<br>
                        Email: {{ $penitip->email ?? '-' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Inventory Table -->
        <h4 class="items-title">Rincian Inventaris Barang Titipan</h4>
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 5%;" class="text-center">No</th>
                    <th style="width: 50%;">Spesifikasi Fisik Barang</th>
                    <th style="width: 20%;" class="text-center">Berat (kg)</th>
                    <th style="width: 25%;" class="text-right">Taksiran Nilai Jual</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangNota as $index => $barang)
                    <tr class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
                        <td class="text-center" style="color: #64748b; font-weight: 600;">{{ $index + 1 }}</td>
                        <td>
                            <span class="item-name">{{ $barang->nama_barang }}</span>
                            <span class="item-sku">SKU: {{ strtoupper(substr($barang->nama_barang, 0, 1)) . $barang->id_barang }}</span>
                            <div style="margin-top: 5px;">
                                @if($barang->garansi && $barang->tanggal_garansi)
                                    <span class="item-badge garansi">Garansi: {{ \Carbon\Carbon::parse($barang->tanggal_garansi)->format('M Y') }}</span>
                                @endif
                                <span class="item-badge">Kat: {{ $barang->kategori->nama_kategori ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="text-center" style="font-weight: 600; color: #475569;">{{ $barang->berat }} kg</td>
                        <td class="text-right">
                            <span style="font-weight: 700; color: #0f172a; font-size: 14px;">Rp{{ number_format($barang->harga_jual, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Summary & Legal -->
        <div class="summary-box">
            <span style="font-weight: 700; color: #0f172a; display: block; margin-bottom: 5px;">Ketentuan Titip Jual:</span>
            <ul style="margin: 0; padding-left: 20px; color: #475569; font-size: 11px; line-height: 1.6;">
                <li>Barang titipan akan dipamerkan secara fisik di etalase dan platform online ReUseMart.</li>
                <li>Pihak ReUseMart berhak menolak atau mengembalikan barang jika ditemukan cacat tersembunyi.</li>
                <li>Setelah masa penitipan berakhir, penitip wajib mengambil kembali barang yang tidak terjual dalam waktu 7 hari kerja.</li>
            </ul>
        </div>

        <!-- Signature Block -->
        <table class="signatures">
            <tr>
                <td>
                    <div class="sign-title">Pihak Pertama (Penitip)</div>
                    <div class="sign-line"></div>
                    <div class="sign-name">{{ $penitip->nama_penitip }}</div>
                    <div class="sign-id">ID: T{{ $penitip->id_penitip }}</div>
                </td>
                <td>
                    <div class="sign-title">Pihak Kedua (ReUseMart QC)</div>
                    <div class="sign-line"></div>
                    <div class="sign-name">{{ $nota->pegawaiQc->nama_pegawai }}</div>
                    <div class="sign-id">NIP: P{{ $nota->pegawaiQc->id_pegawai }}</div>
                </td>
            </tr>
        </table>

        <div class="footer">
            Dokumen ini dicetak secara otomatis oleh Sistem Inventaris ReUseMart.<br>
            Harap simpan dokumen ini sebagai bukti pengambilan atau penyelesaian transaksi.
        </div>
    </div>
</body>
</html>
