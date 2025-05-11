<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PembeliController extends Controller
{
    public function profilePembeli()
    {
        $pembeli = Auth::guard('pembeli')->user();
        return view('profilePembeli', compact('pembeli'));
    }
}
