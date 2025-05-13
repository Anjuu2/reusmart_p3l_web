<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // LoginController.php
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function index()
    {
        // Cek jika pengguna belum login
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Anda perlu login untuk melanjutkan pembelian');
        }

        // Lanjutkan proses checkout
        return view('checkout.index');
    }


}
