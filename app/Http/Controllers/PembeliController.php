<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pembeli;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\BarangTitipan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PembeliController extends Controller
{
    public function profilePembeli()
    {
        $pembeli = auth()->guard('pembeli')->user(); 

        $transaksiList = Transaksi::with('detailTransaksi.barang')
            ->where('id_pembeli', $pembeli->id_pembeli)
            ->orderByDesc('tanggal_transaksi')
            ->get();

        return view('profilePembeli', compact('pembeli', 'transaksiList'));
    }

    public function detailRiwayat()
    {
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pembeli' => 'required',
            'username'     => 'required|unique:pembeli,username,' . $id . ',id_pembeli',
            'notelp'       => 'required|unique:pembeli,notelp,' . $id . ',id_pembeli',
            'email'        => 'required|email|unique:pembeli,email,' . $id . ',id_pembeli',
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

    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required',
            'username' =>'required',
            'notelp' =>'required',
            'email' =>'required',
            'password'=>'required',
        ]);

        Pembeli::create([
            'nama_pembeli' => $request->nama_pembeli,
            'username' => $request->username,
            'notelp' => $request->notelp,
            'email' => $request->email,
            'password' => Hash::Make($request->password),
            'poin' => 0,
            'status_aktif' => 1,
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Pembeli berhasil dibuat.');
    }

    public function showPoin(){
        $pembeli = auth()->guard('pembeli')->user();

        return view('checkout', ['poin' => $pembeli->poin]);
    }
}
