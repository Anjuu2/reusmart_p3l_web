<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangTitipan;
use App\Models\Kategori;
use App\Models\Pegawai;
use App\Models\Penitip;
use Carbon\Carbon;
use Illuminate\Http\Support\Facades\Storage;
use PDF;



class BarangTitipanController extends Controller
{
    public function show($id)
    {
        $produk = BarangTitipan::findOrFail($id);
        return view('produk.show', compact('produk'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');  // Ambil kata kunci pencarian dari parameter 'search'

        // Cari produk berdasarkan nama barang dan hanya menampilkan barang yang statusnya 'Tersedia'
        $produk = BarangTitipan::where('nama_barang', 'like', '%' . $query . '%')
            ->where('status_barang', 'Tersedia')  // Menambahkan filter untuk hanya barang yang tersedia
            ->get();

        // Mengirim data produk yang ditemukan ke view
        return view('kategori', compact('produk'));
    }

    public function index(Request $request)
    {
        $query = BarangTitipan::with(['kategori', 'penitip', 'pegawaiQc', 'hunter']);

        $search = $request->search;

        if (!empty($search)) {
            $searchLower = strtolower(trim($search));

            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%$search%")
                ->orWhere('deskripsi', 'like', "%$search%")
                ->orWhere('harga_jual', 'like', "%$search%")
                ->orWhere('berat', 'like', "%$search%")
                ->orWhere('tanggal_masuk', 'like', "%$search%")
                ->orWhere('tanggal_akhir', 'like', "%$search%")
                ->orWhere('tanggal_keluar', 'like', "%$search%")
                ->orWhere('status_barang', 'like', "%$search%")
                ->orWhere('garansi', 'like', "%$search%")
                ->orWhere('tanggal_garansi', 'like', "%$search%")
                ->orWhere('status_perpanjangan', 'like', "%$search%")
                ->orWhere('barang_hunter', 'like', "%$search%")
                ->orWhere('id_pegawai', 'like', "%$search%")
                ->orWhereHas('penitip', fn($p) => $p->where('nama_penitip', 'like', "%$search%"))
                ->orWhereHas('pegawaiQc', fn($qc) => $qc->where('nama_pegawai', 'like', "%$search%"))
                ->orWhereHas('hunter', fn($h) => $h->where('nama_pegawai', 'like', "%$search%"))
                ->orWhereHas('kategori', fn($p) => $p->where('nama_kategori', 'like', "%$search%"));
            });

            // 1. Filter berdasarkan nama bulan (ex: agustus)
            $bulanMap = [
                'januari' => 1, 'februari' => 2, 'maret' => 3, 'april' => 4,
                'mei' => 5, 'juni' => 6, 'juli' => 7, 'agustus' => 8,
                'september' => 9, 'oktober' => 10, 'november' => 11, 'desember' => 12
            ];

            if (isset($bulanMap[$searchLower])) {
                $query->orWhereMonth('tanggal_masuk', $bulanMap[$searchLower]);
            }

            // 2. Filter berdasarkan X hari terakhir
            if (preg_match('/(\d+)\s*hari/', $searchLower, $matches)) {
                $jumlahHari = (int) $matches[1];
                $tanggalBatas = now()->subDays($jumlahHari);
                $query->orWhere('tanggal_masuk', '>=', $tanggalBatas);
            }
        }

        $barang = $query->paginate(10)->appends($request->only('search'));

        return view('pegawai_gudang.barangTitipan.index', compact('barang'));
    }

    public function cariPenitipForm(Request $request)
    {
        $penitip = [];

        if ($request->filled('search')) {
            $keyword = $request->search;
            $penitip = Penitip::where('id_penitip', 'like', "%$keyword%")
                        ->orWhere('nama_penitip', 'like', "%$keyword%")
                        ->orWhere('no_ktp', 'like', "%$keyword%")
                        ->orWhere('username', 'like', "%$keyword%")
                        ->orWhere('alamat', 'like', "%$keyword%")
                        ->orWhere('email', 'like', "%$keyword%")
                        ->get();
        }

        return view('pegawai_gudang.barangTitipan.cariPenitip', compact('penitip'));
    }

    public function create($id_penitip)
    {
        
        $penitip = Penitip::findOrFail($id_penitip);
        $kategori = Kategori::all();
        $pegawaiQc = Pegawai::whereHas('jabatan', fn($q) =>
            $q->where('nama_jabatan', 'Pegawai Gudang')
        )->get();
        return view('pegawai_gudang.barangTitipan.create', compact('kategori', 'pegawaiQc', 'penitip'));
    }

    public function createBlank()
    {
        return redirect()->route('pegawai_gudang.barangTitipan.cariPenitip');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_jual' => 'required|numeric',
            'id_penitip' => 'required|exists:penitip,idPenitip',
            'id_kategori' => 'required',
            'id_qc_pegawai' => 'required',
            'berat' => 'required|numeric',
        ]);

        $tanggalMasuk = Carbon::now();
        $tanggalAkhir = $tanggalMasuk->copy()->addDays(30);

        $barang = new BarangTitipan([
            'nama_barang' => $request->nama_barang,
            'harga_jual' => $request->harga_jual,
            'id_penitip' => $request->id_penitip,
            'id_kategori' => $request->id_kategori,
            'id_qc_pegawai' => $request->id_qc_pegawai,
            'id_hunter' => $request->id_hunter,
            'barang_hunter' => $request->id_hunter ? 1 : 0,
            'berat' => $request->berat,
            'garansi' => $request->garansi ?? null,
            'tanggal_garansi' => $request->tanggal_garansi ?? null,
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_akhir' => $tanggalAkhir,
            'status_barang' => 'Tersedia',
            'status_perpanjangan' => 0,
        ]);

        $barang->save();

        return redirect()->route('pegawai_gudang.barangTitipan.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang = BarangTitipan::findOrFail($id);
        $kategori = Kategori::all();
        $pegawaiQc = Pegawai::where('jabatan', 'gudang')->get();
        $penitip = Penitip::all();
        return view('pegawai_gudang.barangTitipan.edit', compact('barang', 'kategori', 'pegawaiQc', 'penitip'));
    }

    public function update(Request $request, $id)
    {
        $barang = BarangTitipan::findOrFail($id);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'harga_jual' => $request->harga_jual,
            'id_penitip' => $request->id_penitip,
            'id_kategori' => $request->id_kategori,
            'id_qc_pegawai' => $request->id_qc_pegawai,
            'id_hunter' => $request->id_hunter,
            'barang_hunter' => $request->id_hunter ? 1 : 0,
            'berat' => $request->berat,
            'garansi' => $request->garansi ?? null,
            'tanggal_garansi' => $request->tanggal_garansi ?? null,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_akhir' => $request->tanggal_akhir,
            'status_barang' => $request->status_barang,
            'status_perpanjangan' => $request->status_perpanjangan,
        ]);

        return redirect()->route('pegawai_gudang.barangTitipan.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barang = BarangTitipan::findOrFail($id);
        $barang->delete();

        return redirect()->route('pegawai_gudang.barangTitipan.index')->with('success', 'Barang berhasil dihapus!');
    }

    public function showDetail($id)
    {
        $barang = BarangTitipan::with(['penitip', 'kategori', 'pegawaiQc', 'hunter'])->findOrFail($id);
        return view('pegawai_gudang.barangTitipan.showDetail', compact('barang'));
    }

    public function searchAll(Request $request)
    {

    }

}
