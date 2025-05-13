<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pembeli;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\BarangTitipan;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    public function profilePembeli()
    {
        $pembeli = auth()->guard('pembeli')->user(); // pastikan guard 'pembeli'

        $transaksiList = Transaksi::with('detailTransaksi.barang')
            ->where('id_pembeli', $pembeli->id_pembeli)
            ->orderByDesc('tanggal_transaksi')
            ->get();

        return view('profilePembeli', compact('pembeli', 'transaksiList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pembeli' => 'required',
            'username' => 'required',
            'notelp' => 'required',
            'email' => 'required|email',
        ]);

        $pembeli = Pembeli::findOrFail($id);
        $pembeli->update($request->all());

        return redirect()->route('pembeli.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function toggleStatus($id)
    {
        $pembeli = \App\Models\Pembeli::findOrFail($id);

        \App\Models\Pembeli::where('id_pembeli', $id)->update([
            'status_aktif' => !$pembeli->status_aktif
        ]);

        return redirect()->back()->with('success', 'Status akun diperbarui.');
    }

}
