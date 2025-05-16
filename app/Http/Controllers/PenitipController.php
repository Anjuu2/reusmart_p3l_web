<?php

namespace App\Http\Controllers;

use App\Models\Penitip;
use App\Models\BarangTitipan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PenitipController extends Controller
{
    public function profilePenitip()
    {
        $penitip = auth()->guard('penitip')->user(); // pastikan guard 'penitip'

        $transaksiList = BarangTitipan::with('penitip')
            ->where('id_penitip', $penitip->id_penitip)
            ->where('status_barang', 'terjual')
            ->orderByDesc('tanggal_keluar')
            ->get();

        return view('Penitip.profilePenitip', compact('penitip', 'transaksiList'));
    }

    public function index(Request $request)
    {
        $search = $request->input('q');

        $penitips = Penitip::when($search, function ($query, $search) {
            return $query->where('nama_penitip', 'like', "%$search%")
                        ->orWhere('no_ktp', 'like', "%$search%")->orWhere('username', 'like', "%$search%")->orWhere('email', 'like', "%$search%");
        })->paginate(10);

        return view('dashboardCS', [
            'penitips' => $penitips,
            'search' => $search
        ]);        
        
    }

    public function create()
    {
        return view('cs.penitip.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'no_ktp.unique' => 'No KTP sudah terdaftar. Silakan gunakan yang lain.',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan yang lain.',
            'username.unique' => 'Username sudah terdaftar. Silakan pilih yang lain.',
        ];

        $request->validate([
            'no_ktp' => 'required|unique:penitip,no_ktp',
            'foto_ktp' => 'nullable|image|max:2048',
            'nama_penitip' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:penitip,email',
            'username' => 'required|unique:penitip,username',
            'password' => 'required|min:6',
        ], $messages); 

        $data = $request->all();

        if ($request->hasFile('foto_ktp')) {
            $data['foto_ktp'] = $request->file('foto_ktp')->store('ktp', 'public');
        }

        $data['poin'] = 0;
        $data['saldo_penitip'] = 0;
        $data['status_aktif'] = 1;

        Penitip::create($data);

        return redirect()->route('cs.penitip.index')->with('success', 'Penitip berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penitip = Penitip::findOrFail($id);
        return view('cs.penitip.edit', compact('penitip'));
    }

    public function update(Request $request, $id)
    {
        $penitip = Penitip::findOrFail($id);
        $messages = [
            'no_ktp.unique' => 'No KTP sudah terdaftar. Silakan gunakan yang lain.',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan yang lain.',
            'username.unique' => 'Username sudah terdaftar. Silakan pilih yang lain.',
        ];

        $request->validate([
            'no_ktp' => 'required|unique:penitip,no_ktp,' . $id . ',id_penitip',
            'foto_ktp' => 'nullable|image|max:2048',
            'nama_penitip' => 'required',
            'email' => 'required|email|unique:penitip,email,' . $id . ',id_penitip',
            'username' => 'required|unique:penitip,username,' . $id . ',id_penitip',
        ]);

        $data = $request->all();
        if ($request->hasFile('foto_ktp')) {
            if ($penitip->foto_ktp) {
                Storage::disk('public')->delete($penitip->foto_ktp);
            }
            $data['foto_ktp'] = $request->file('foto_ktp')->store('ktp', 'public');
        }

        $penitip->update($data);

        return redirect()->route('cs.penitip.index')->with('success', 'Penitip berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penitip = Penitip::findOrFail($id);
        if ($penitip->foto_ktp) {
            Storage::disk('public')->delete($penitip->foto_ktp);
        }
        $penitip->delete();
        return redirect()->route('cs.penitip.index')->with('success', 'Penitip berhasil dihapus.');
    }
}