<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $organisasi = $q
            ? Organisasi::where('nama_organisasi', 'like', "%{$q}%")->get()
            : Organisasi::all();

        return view('Admin.organisasiIndex', [
            'organisasi' => $organisasi,
            'q'           => $q,
        ]);
    }

    public function create()
    {
        return view('organisasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_organisasi' => 'required|string|max:255',
            'alamat'          => 'required|string|max:255',
            'password'        => 'required|string|min:6|confirmed',
        ]);

        Organisasi::create([
            'nama_organisasi' => $request->nama_organisasi,
            'alamat'          => $request->alamat,
            'password'        => bcrypt($request->password),
            'status_aktif'    => 1,
        ]);

        return redirect()
            ->route('organisasi.index')
            ->with('success', 'Organisasi berhasil dibuat.');
    }

    public function show($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        return view('organisasi.show', compact('organisasi'));
    }

    public function edit($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        return view('organisasi.edit', compact('organisasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_organisasi' => 'required|string|max:255',
            'alamat'          => 'required|string|max:255',
        ]);

        $org = Organisasi::findOrFail($id);
        $org->update($request->only('nama_organisasi', 'alamat'));

        return redirect()
            ->route('organisasi.index')
            ->with('success', 'Organisasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Organisasi::destroy($id);

        return redirect()
            ->route('organisasi.index')
            ->with('success', 'Organisasi berhasil dihapus.');
    }

    public function nonaktif($id)
    {
        $org = Organisasi::findOrFail($id);
        $org->update(['status_aktif' => 0]);

        return redirect()
            ->route('organisasi.index')
            ->with('success', 'Organisasi berhasil dinonaktifkan.');
    }
}
