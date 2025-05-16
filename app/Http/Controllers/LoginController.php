<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembeli;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Route;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        $organisasiList = \App\Models\Organisasi::where('status_aktif', 1)->get();
        return view('login', compact('organisasiList'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'tipe_user' => 'required|in:pembeli,penitip,organisasi,pegawai',
            'password' => 'required|string',
        ]);

        $tipe = $request->tipe_user;
        $password = $request->password;

        if ($tipe === 'pembeli') {
            $request->validate(['email' => 'required|email']);
            $user = \App\Models\Pembeli::where('email', $request->email)->first();
            if ($user && $user->password === $password) {
                Auth::guard('pembeli')->login($user);
                $request->session()->regenerate();
                return redirect()->route('home');
            }
        }

        if ($tipe === 'penitip') {
            $request->validate(['email' => 'required|email']);
            $user = \App\Models\Penitip::where('email', $request->email)->first();
            if ($user && $user->password === $password) {
                Auth::guard('penitip')->login($user);
                $request->session()->regenerate();
                // return redirect()->route('dashboard.penitip');
                return redirect()->route('penitip.profil');
            }
        }

        if ($tipe === 'organisasi') {
            $request->validate(['id_organisasi' => 'required|exists:organisasi,id_organisasi']);
            $org = \App\Models\Organisasi::find($request->id_organisasi);
            if ($org && $org->password === $password) {
                Auth::guard('organisasi')->login($org);
                $request->session()->regenerate();
                // return redirect()->route('organisasi.request.index');
                return redirect()->route('dashboard.organisasi');
            }
        }

        if ($tipe === 'pegawai') {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
        
            $pegawai = \App\Models\Pegawai::where('email', $request->email)->first();
        
            if ($pegawai && $pegawai->password === $request->password) {
                Auth::guard('pegawai')->login($pegawai);
                $request->session()->regenerate();
        
                $jabatan = strtolower(trim($pegawai->jabatan->nama_jabatan));
        
                switch ($jabatan) {
                    case 'admin':
                        return redirect()->route('dashboard.admin');
                    case 'kurir':
                        return redirect()->route('dashboard.kurir');
                    case 'owner':
                        return redirect()->route('dashboard.owner');
                        // return redirect()->route('dashboard.pembeli');
                    case 'kepala gudang':
                        return redirect()->route('dashboard.kepala_gudang');
                    case 'customer service':
                        return redirect()->route('dashboard.cs');
                    default:
                        return redirect()->route('dashboard.pegawai');
                }
            }
        
            return back()->withErrors(['error' => 'Email atau password salah.']);
        }
        

        return back()->withErrors(['error' => 'Login gagal. Periksa kembali data Anda.']);
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
