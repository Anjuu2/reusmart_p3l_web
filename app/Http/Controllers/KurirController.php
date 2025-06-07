<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;

class KurirController extends Controller
{
    public function index()
    {
        // Pastikan sudah login dengan guard 'pegawai'
        $pegawai = Auth::guard('pegawai')->user();

        // Tambahkan validasi untuk role 'kurir'
        if ($pegawai && $pegawai->jabatan && strtolower($pegawai->jabatan->nama_jabatan) === 'kurir') {
            return response()->json([
                'status' => true,
                'message' => 'Data kurir berhasil diambil.',
                'data' => [
                    'id_pegawai' => $pegawai->id_pegawai,
                    'nama_pegawai' => $pegawai->nama_peagwai, // typo di database? seharusnya 'nama_pegawai'
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
}
