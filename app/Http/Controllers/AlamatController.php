<?php

namespace App\Http\Controllers;

use App\Models\AlamatPembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class AlamatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Retrieve all alamat records from the database
        $alamat = AlamatPembeli::where('id_pembeli', $user->id_pembeli)->get();

        // Return as a JSON response
        return response()->json($alamat);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'jalan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:255',
            'detail' => 'nullable|string|max:255',
        ]);

        $alamat = AlamatPembeli::create([
            'id_pembeli' => $user->id_pembeli,
            'jalan' => $request->jalan,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
            'detail' => $request->detail,
        ]);

        // Return a success message
        return response()->json([
            'message' => 'AlamatPembeli created successfully!',
            'data' => $alamat
        ], 201);
    }

    public function show($id)
    {
        $user = Auth::user();

        // Find the alamat by ID
        $alamat = AlamatPembeli::find($id);

        // If found, return the alamat; otherwise, return an error message
        if ($alamat) {
            return response()->json($alamat);
        } else {
            return response()->json(['message' => 'AlamatPembeli not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $request->validate([
            'jalan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:255',
            'detail' => 'nullable|string|max:255',
        ]);

        // Find the alamat by ID
        $alamat = AlamatPembeli::find($id);

        // If alamat exists, update it
        if ($alamat) {
            $alamat->update([
                'id_pembeli' => $user->id_pembeli,
                'jalan' => $request->jalan,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'kode_pos' => $request->kode_pos,
                'detail' => $request->detail,
            ]);

            return response()->json([
                'message' => 'AlamatPembeli updated successfully!',
                'data' => $alamat
            ], 200);
        } else {
            return response()->json(['message' => 'AlamatPembeli not found'], 404);
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();
        
        // Cari alamat berdasarkan ID
        $alamat = AlamatPembeli::where('id_alamat_pembeli', $id)->where('id_pembeli', $user->id_pembeli)->first();

        // Jika alamat ditemukan
        if ($alamat) {
            // Mengecek jumlah alamat milik pembeli yang sedang login
            $jumlahAlamat = AlamatPembeli::where('id_pembeli', $user->id_pembeli)->count();

            if ($jumlahAlamat == 1) {
                return response()->json([
                    'message' => 'Alamat default tidak dapat dihapus jika hanya ada satu alamat.',
                ], 400); // 400 Bad Request
            }

            // Menghapus alamat jika tidak terhalang oleh logika di atas
            $alamat->delete();

            return response()->json([
                'message' => 'Alamat berhasil dihapus.',
            ], 200);
        }

        // Jika alamat tidak ditemukan
        return response()->json(['message' => 'Alamat tidak ditemukan'], 404);
    }

}
