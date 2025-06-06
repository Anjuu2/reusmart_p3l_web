<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\Pembeli;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'semua');
        $search = $request->query('search');
        $tanggalKlaim = $request->query('tanggal_klaim');
        // $tanggalAkhir = $request->query('tanggal_akhir');

        $query = Reward::with(['pembeli', 'merchandise'])
            ->where('jenis_reward', 'Merchandise');

        if ($filter === 'belum') {
            $query->where('status_penukaran', false);
        }

        if($search){
            $query->where(function ($q) use ($search) {
                $q->where('id_reward', 'like', "%$search%")
                ->orWhere('jumlah_tukar_poin', 'like', "%$search%")
                ->orWhereHas('pembeli', function ($q) use ($search) {
                    $q->where('nama_pembeli', 'like', "%$search%");
                })
                ->orWhereHas('merchandise', function ($q) use ($search) {
                    $q->where('nama_merchandise', 'like', "%$search%");
                });
            });
        }

        if ($tanggalKlaim) {
            $query->whereDate('tanggal_klaim', $tanggalKlaim);
        }

        $rewards = $query->orderBy('tanggal_klaim', 'desc')->paginate(10);

        return view('cs.reward.index', compact('rewards', 'filter', 'search', 'tanggalKlaim'));
    }

    public function ambilMerch($id)
    {
        $reward = Reward::findOrFail($id);

        if ($reward->jenis_reward !== 'Merchandise') {
            return redirect()->back()->with('error', 'Bukan klaim merchandise.');
        }

        $reward->status_penukaran = true;
        $reward->tanggal_ambil = now()->toDateString();
        $reward->save();

        return redirect()->route('cs.reward.index')->with('success', 'Merchandise telah diambil.');
    }
}
