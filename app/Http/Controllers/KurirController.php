<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;
use App\Models\Pengiriman;

class KurirController extends Controller
{
    public function index()
    {
        // Pastikan sudah login dengan guard 'pegawai'
        $pegawai = Auth::guard('sanctum')->user();

        // Tambahkan validasi untuk role 'kurir'
        if ($pegawai && $pegawai->jabatan && strtolower($pegawai->jabatan->nama_jabatan) === 'kurir') {
            return response()->json([
                'status' => true,
                'message' => 'Data kurir berhasil diambil.',
                'data' => [
                    'id_pegawai' => $pegawai->id_pegawai,
                    'nama_pegawai' => $pegawai->nama_pegawai,
                    'username' =>$pegawai->username,
                    'email' => $pegawai->email,
                    'notelp' => $pegawai->notelp,
                    'tanggal_lahir' => $pegawai->tanggal_lahir,
                    'jabatan' => $pegawai->jabatan->nama_jabatan
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Pegawai bukan kurir atau belum login.'
            ], 403);
        }
    }

    public function historyPengiriman()
    {
        $kurir = Auth::guard('sanctum')->user();

        if (!$kurir) {
            return response()->json([
                'success' => false,
                'message' => 'Kurir tidak terautentikasi.'
            ], 401);
        }

        $history = Pengiriman::with([
            'penjadwalan.transaksi.detailTransaksi.barang_titipan'
        ])
        ->where('id_pegawai', $kurir->id_pegawai)
        ->where('status_pengiriman', 'Sampai')
        ->orderBy('id_pengiriman', 'desc')
        ->get()
        ->map(function ($item) {
            // Ambil nama_barang dari detailTransaksi pertama (jika ada)
            $detail = optional($item->penjadwalan->transaksi->detailTransaksi->first());
            $namaBarang = optional($detail->barang_titipan)->nama_barang ?? '-';

            return [
                'id_pengiriman' => $item->id_pengiriman,
                'nama_barang' => $namaBarang,
                'tanggal_jadwal' => optional($item->penjadwalan)->tanggal_jadwal
                    ? $item->penjadwalan->tanggal_jadwal->format('d/m/Y')
                    : '-',
                'status_pengiriman' => $item->status_pengiriman ?? '-',
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $history
        ]);
    }

    public function showPengiriman()
    {
        $kurir = Auth::guard('sanctum')->user();

        if (!$kurir) {
            return response()->json([
                'success' => false,
                'message' => 'Kurir tidak terautentikasi.'
            ], 401);
        }

        $history = Pengiriman::with([
            'penjadwalan.transaksi.detailTransaksi.barang_titipan'
        ])
        ->where('id_pegawai', $kurir->id_pegawai)
        ->where('status_pengiriman', 'Diantar')
        ->orderBy('id_pengiriman', 'desc')
        ->get()
        ->map(function ($item) {
            // Ambil nama_barang dari detailTransaksi pertama (jika ada)
            $detail = optional($item->penjadwalan->transaksi->detailTransaksi->first());
            $namaBarang = optional($detail->barang_titipan)->nama_barang ?? '-';

            return [
                'id_pengiriman' => $item->id_pengiriman,
                'nama_barang' => $namaBarang,
                'tanggal_jadwal' => optional($item->penjadwalan)->tanggal_jadwal
                    ? $item->penjadwalan->tanggal_jadwal->format('d/m/Y H:i')
                    : '-',
                'status_pengiriman' => $item->status_pengiriman ?? '-',
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $history
        ]);
    }

    public function detailPengiriman($id)
    {
        $kurir = Auth::guard('sanctum')->user();

        if (!$kurir) {
            return response()->json([
                'success' => false,
                'message' => 'Kurir tidak terautentikasi.'
            ], 401);
        }

        $pengiriman = Pengiriman::with([
            'penjadwalan.transaksi.pembeli',
            'penjadwalan.transaksi.alamat',
            'penjadwalan.transaksi.detailTransaksi.barang_titipan'
        ])
        ->where('id_pengiriman', $id)
        ->where('id_pegawai', $kurir->id_pegawai)
        ->first();

        if (!$pengiriman) {
            return response()->json([
                'success' => false,
                'message' => 'Pengiriman tidak ditemukan.'
            ], 404);
        }

        $detail = optional($pengiriman->penjadwalan->transaksi->detailTransaksi->first());
        $namaBarang = optional($detail->barang_titipan)->nama_barang ?? '-';
        $namaPembeli = optional($pengiriman->penjadwalan->transaksi->pembeli)->nama_pembeli ?? '-';
        $alamatPembeli = optional($pengiriman->penjadwalan->transaksi->alamat);
        $alamatLengkap = $alamatPembeli 
        ? "{$alamatPembeli->jalan}, {$alamatPembeli->kelurahan}, {$alamatPembeli->kecamatan}, {$alamatPembeli->kota}, {$alamatPembeli->provinsi}, {$alamatPembeli->kode_pos}" 
        : '-';

        return response()->json([
            'success' => true,
            'data' => [
                'id_pengiriman' => $pengiriman->id_pengiriman,
                'nama_barang' => $namaBarang,
                'tanggal_jadwal' => optional($pengiriman->penjadwalan)->tanggal_jadwal
                    ? $pengiriman->penjadwalan->tanggal_jadwal->format('d/m/Y H:i')
                    : '-',
                'status_pengiriman' => $pengiriman->status_pengiriman ?? '-',
                'nama_pembeli' => $namaPembeli,
                'alamat_pembeli' => $alamatLengkap,
            ]
        ]);
    }

    public function konfirmasiPengiriman($id)
    {
        $kurir = Auth::guard('sanctum')->user();

        if (!$kurir) {
            return response()->json([
                'success' => false,
                'message' => 'Kurir tidak terautentikasi.'
            ], 401);
        }

        $pengiriman = Pengiriman::where('id_pengiriman', $id)
            ->where('id_pegawai', $kurir->id_pegawai)
            ->first();

        if (!$pengiriman) {
            return response()->json([
                'success' => false,
                'message' => 'Pengiriman tidak ditemukan.'
            ], 404);
        }

        if ($pengiriman->status_pengiriman !== 'Diantar') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya pengiriman dengan status Diantar yang dapat dikonfirmasi.'
            ], 400);
        }

        $pengiriman->status_pengiriman = 'Sampai';
        $pengiriman->save();

        return response()->json([
            'success' => true,
            'message' => 'Pengiriman berhasil dikonfirmasi menjadi Sampai.'
        ]);
    }
}
