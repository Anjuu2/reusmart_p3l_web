<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class PembeliHistoryController extends Controller
{
    public function index()
    {
        $pembeliId = Auth::guard('pembeli')->id();

        $transaksiList = Transaksi::with(['detailTransaksi.barang'])
            ->where('id_pembeli', $pembeliId)
            ->orderByDesc('tanggal_transaksi')
            ->get();

        return view('history', compact('transaksiList'));
    }
}
