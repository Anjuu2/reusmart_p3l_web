<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangTitipan;

class BarangTitipanController extends Controller
{
    public function show($id)
    {
        $produk = BarangTitipan::findOrFail($id);
        return view('produk.show', compact('produk'));
    }
}
