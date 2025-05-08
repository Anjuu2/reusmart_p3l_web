<?php

namespace App\Http\Controllers;

use App\Models\Penitip;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class PenitipController extends Controller
{
    // Display a listing of the penitip
    public function index()
    {
        $penitip = Penitip::all();  // Retrieve all penitip
        return response()->json($penitip);
    }

    // Show the form for creating a new penitip
    public function create()
    {
        // Return a view to create penitip
        return view('penitip.create');
    }

    public function register(Request $request){
        try{
            $request->validate([
                'no_ktp' => 'required|max:16',
                'nama_penitip' => 'required|max:255',
                'username' => 'required|max:255|unique:penitip',
                'password' => 'required|max:255',
                'alamat' => 'required|max:255',
                'email' => 'required|email|max:255',
                'notelp' => 'required|max:255',
            ]);

            $penitip = Penitip::create(attributes:[
                'no_ktp' => $request->no_ktp,
                'nama_penitip' => $request->nama_penitip,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'alamat' => $request->alamat,
                'email' => $request->email,
                'notelp' => $request->notelp,
                'poin' => 0,
                'saldo_penitip' => 0,
                'status_aktif' => 1,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Penitip registered successfully!',
                'data' => $penitip
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
            'email' => 'required',
            'password' => 'required',
        ]);

        $penitip = Penitip::where('email', $request->email)->first();
        
        // cek akun ada atau ga
        if (!$penitip) {
            return response()->json([
                "status" => false,
                "message" => "Invalid credentials: Account not found.",
            ], 401);
        }

        // cek password
        if (!Hash::check($request->password, $penitip->password)) {
            return response()->json([
                "status" => false,
                "message" => "Invalid credentials: Incorrect password.",
            ], 401);
        }

        // cek akun aktif
        if (!$penitip->status_aktif) {
            return response()->json([
                "status" => false,
                "message" => "Account is inactive.",
            ], 403); // 403 Forbidden status
        }
        
        try {
            $token = $penitip->createToken('Personal Access Token')->plainTextToken;

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

    // Display the specified penitip
    public function show($id)
    {
        $penitip = Penitip::find($id);  // Find penitip by ID
        if ($penitip) {
            return response()->json($penitip);
        } else {
            return response()->json(['message' => 'Penitip not found'], 404);
        }
    }

    // Update the specified penitip in storage
    public function update(Request $request, $id)
    {
        $penitip = Penitip::find($id);

        if ($penitip) {
            $request->validate([
                'nama_penitip' => 'required|max:255',
                'username' => 'required',
                'alamat' => 'required|max:255',
                'email' => 'required|email|max:255',
                'notelp' => 'required|max:255',
            ]);

            $penitip->update([
                'nama_penitip' => $request->nama_penitip,
                'username' => $request->username,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'notelp' => $request->notelp,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data Penitip updated successfully.',
                'data' => $penitip,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Akun not found.',
            ], 404);
        }
    }

    // Remove the specified penitip from storage
    public function destroy($id)
    {
        $penitip = Penitip::find($id);
        if ($penitip) {
            $penitip->delete();
            return redirect()->route('penitip.index')->with('success', 'Penitip deleted successfully!');
        } else {
            return redirect()->route('penitip.index')->with('error', 'Penitip not found');
        }
    }

    public function nonaktif($id){
        $penitip = Penitip::find($id);
        
        if ($penitip) {
            $penitip->status_aktif = 0;
            $penitip->save();

            return response()->json([
                'message' => 'Penitip dinonaktifkan!'
            ], 200);
        }else{
            return response()->json(['message' => 'Penitip not found'], 404);
        }
    }
}
