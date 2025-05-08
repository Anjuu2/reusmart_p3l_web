<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class OrganisasiController extends Controller
{
    public function index()
    {
        // Get all organizations
        $organisasi = Organisasi::all();

        return response()->json([
            'status' => true,
            'message' => 'All Organisasi retrieved successfully.',
            'data' => $organisasi
        ], 200);
    }

    public function register(Request $request)
    {
        try{
            $request->validate([
                'nama_organisasi' => 'required|max:255',
                'alamat' => 'required|max:255',
                'password' => 'required',
            ]);

            $organisasi = Organisasi::create(attributes:[
                'nama_organisasi' => $request['nama_organisasi'],
                'alamat' => $request['alamat'],
                'password' => Hash::make($request['password']),
                'status_aktif' => 1,
            ]);

            return response()->json([
                'message' => 'Organisasi created successfully!',
                'data' => $organisasi
            ], 201);
        }catch (Exception $e){
            return response()->json([
                "status" => false,
                "message" => "something went wrong",
                "error" => $e->getMessage(),
            ], 400);
        }
    }

    public function login(Request $request){
        $request->validate([
            'nama_organisasi' => 'required',
            'password' => 'required',
        ]);

        $organisasi = Organisasi::where('nama_organisasi', $request->nama_organisasi)->first();
        
        // cek akun ada atau ga
        if (!$organisasi) {
            return response()->json([
                "status" => false,
                "message" => "Invalid credentials: Account not found.",
            ], 401);
        }

        // cek password
        if (!Hash::check($request->password, $organisasi->password)) {
            return response()->json([
                "status" => false,
                "message" => "Invalid credentials: Incorrect password.",
            ], 401);
        }

        // cek akun aktif
        if (!$organisasi->status_aktif) {
            return response()->json([
                "status" => false,
                "message" => "Account is inactive.",
            ], 403); // 403 Forbidden status
        }
        
        try {
            $token = $organisasi->createToken('Personal Access Token')->plainTextToken;

            session(['token' => $token]);

            return response()->json([
                'status' => true,
                'message' => 'Login successful.',
                'token' => $token,  // Send the token in the response
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Error creating token: " . $e->getMessage(),
            ], 500);
        }
    }

    public function logout (Request $request)
    {
        if(Auth::check()){
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logged out successfully']);
        }

        return response()->json(['message' => 'Not logged in'], 401);
    }

    public function show($id)
    {
        // Find the organization by ID
        $organisasi = Organisasi::find($id);

        // If organization is found
        if ($organisasi) {
            return response()->json($organisasi);
        } else {
            return response()->json(['message' => 'Organisasi not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_organisasi' => 'required|max:255',
            'alamat' => 'required|max:255',
        ]);

        // Find the organization by ID
        $organisasi = Organisasi::find($id);

        if ($organisasi) {
            // Update organization details
            $organisasi->update([
                'nama_organisasi' => $request->input('nama_organisasi'),
                'alamat' => $request->input('alamat'),
            ]);

            return response()->json([
                'message' => 'Organisasi updated successfully!',
                'data' => $organisasi
            ], 200);
        } else {
            return response()->json(['message' => 'Organisasi not found'], 404);
        }
    }

    public function destroy($id)
    {
        // Find the organization by ID
        $organisasi = Organisasi::find($id);

        if ($organisasi) {
            // Delete the organization
            $organisasi->delete();

            return response()->json([
                'message' => 'Organisasi deleted successfully!'
            ], 200);
        } else {
            return response()->json(['message' => 'Organisasi not found'], 404);
        }
    }

    public function nonaktif($id){
        $organisasi = Organisasi::find($id);
        
        if ($organisasi) {
            $organisasi->status_aktif = 0;
            $organisasi->save();

            return response()->json([
                'message' => 'Organisasi dinonaktifkan!'
            ], 200);
        }else{
            return response()->json(['message' => 'Organisasi not found'], 404);
        }
    }
}
