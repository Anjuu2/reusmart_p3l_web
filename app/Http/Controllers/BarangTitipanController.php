<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangTitipan;
use App\Models\Kategori;
use App\Models\Pegawai;
use App\Models\Penitip;
use App\Models\FotoBarang;
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
                ->orWhere('id_barang', 'like', "%$search%")
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

            if (preg_match('/^([A-Za-z])(\d+)$/', $search, $match)) {
                $huruf = strtoupper($match[1]);
                $angka = $match[2];

                $query->orWhere(function ($q) use ($huruf, $angka) {
                    $q->where('id_barang', $angka)
                    ->whereRaw('UPPER(LEFT(nama_barang, 1)) = ?', [$huruf]);
                });
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
        $pegawaiLogin = auth()->guard('pegawai')->user();
        $pegawaiQc = Pegawai::whereHas('jabatan', function ($q) {
            $q->where('nama_jabatan', 'Pegawai Gudang');
        })
        ->where('id_pegawai', '!=', $pegawaiLogin->id_pegawai)
        ->get();
        $pegawaiHunter = Pegawai::whereHas('jabatan', function ($q) {
            $q->where('nama_jabatan', 'Hunter');
        })->get();
        return view('pegawai_gudang.barangTitipan.create', compact('kategori', 'pegawaiQc', 'pegawaiHunter', 'penitip', 'pegawaiLogin'));
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
            'id_penitip' => 'required|exists:penitip,id_penitip',
            'id_kategori' => 'required',
            'id_qc_pegawai' => 'required',
            'berat' => 'required|numeric',
            'deskripsi' => 'required',
            'foto_barang' => 'required|array|min:2',
            'foto_barang.*' => 'image|mimes:jpg,jpeg,png|max:2048',

        ]);

        $tanggalMasuk = Carbon::now();
        $tanggalAkhir = $tanggalMasuk->copy()->addDays(30);

        $barang = new BarangTitipan([
            'nama_barang' => $request->nama_barang,
            'id_penitip' => $request->id_penitip,
            'id_kategori' => $request->id_kategori,
            'id_qc_pegawai' => $request->id_qc_pegawai, // ✅ DITAMBAHKAN DI SINI
            'id_hunter' => $request->id_hunter,
            'barang_hunter' => $request->id_hunter ? 1 : 0,
            'id_pegawai' => auth()->guard('pegawai')->user()->id_pegawai,
            'berat' => $request->berat,
            'harga_jual' => $request->harga_jual,
            'deskripsi' => $request->deskripsi,
            'status_barang' => $request->status_barang,
            'status_perpanjangan' => $request->status_perpanjangan,
            'garansi' => $request->garansi,
            'tanggal_garansi' => $request->tanggal_garansi,
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_akhir' => $tanggalAkhir,
        ]);
        
        $barang->save();

        foreach ($request->file('foto_barang') as $index => $file) {
            $filename = time() . '_' . $index . '.' . $file->extension();
            $file->move(public_path('images/barang/'), $filename);

            FotoBarang::create([
                'id_barang' => $barang->id_barang,
                'nama_file' => $filename,
                'urutan' => $index + 1,
            ]);
        }

        return redirect()->route('pegawai_gudang.barangTitipan.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang = BarangTitipan::findOrFail($id);
        $penitip = $barang->penitip;

        $kategori = Kategori::all();
        $pegawaiLogin = auth()->guard('pegawai')->user();

        $pegawaiQc = Pegawai::whereHas('jabatan', function ($q) {
            $q->where('nama_jabatan', 'Pegawai Gudang');
        })
        ->where('id_pegawai', '!=', $pegawaiLogin->id_pegawai)
        ->get();

        $pegawaiHunter = Pegawai::whereHas('jabatan', function ($q) {
            $q->where('nama_jabatan', 'Hunter');
        })->get();

        return view('pegawai_gudang.barangTitipan.edit', compact('barang', 'penitip', 'kategori', 'pegawaiLogin', 'pegawaiQc', 'pegawaiHunter'));
    }

    public function update(Request $request, $id)
    {
        $barang = BarangTitipan::findOrFail($id);

        $jumlahFotoLama = $barang->fotoBarang()->count();
        $jumlahFotoDihapus = is_array($request->hapus_foto) ? count($request->hapus_foto) : 0;
        $jumlahFotoUpload = $request->hasFile('foto_barang') ? count($request->file('foto_barang')) : 0;

        $totalFotoSetelahUpdate = ($jumlahFotoLama - $jumlahFotoDihapus) + $jumlahFotoUpload;

        if ($totalFotoSetelahUpdate < 2) {
            return back()->withErrors(['foto_barang' => 'Total foto setelah update minimal harus 2'])->withInput();
        }

        $request->validate([
            'nama_barang' => 'required',
            'harga_jual' => 'required|numeric',
            'id_penitip' => 'required|exists:penitip,id_penitip',
            'id_kategori' => 'required',
            'id_qc_pegawai' => 'required',
            'berat' => 'required|numeric',
            'deskripsi' => 'required',
            'status_barang' => 'required',
            'status_perpanjangan' => 'required|boolean',
            'garansi' => 'required|boolean',
            'tanggal_masuk' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'tanggal_garansi' => 'nullable|date',
            'id_hunter' => 'nullable|exists:pegawai,id_pegawai',
            'foto_barang.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Hapus foto yang ditandai
        if ($request->filled('hapus_foto')) {
            $fotoIds = $request->input('hapus_foto');
            foreach ($fotoIds as $idFoto) {
                $foto = FotoBarang::find($idFoto);
                if ($foto && $foto->id_barang == $barang->id_barang) {
                    $path = public_path('images/barang/' . $foto->nama_file);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                    $foto->delete();
                }
            }
        }

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'id_penitip' => $request->id_penitip,
            'id_kategori' => $request->id_kategori,
            'id_qc_pegawai' => $request->id_qc_pegawai,
            'id_hunter' => $request->id_hunter,
            'barang_hunter' => $request->id_hunter ? 1 : 0,
            'id_pegawai' => $request->id_pegawai,
            'berat' => $request->berat,
            'harga_jual' => $request->harga_jual,
            'deskripsi' => $request->deskripsi,
            'status_barang' => $request->status_barang,
            'status_perpanjangan' => $request->status_perpanjangan,
            'garansi' => $request->garansi,
            'tanggal_garansi' => $request->tanggal_garansi,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);

        if ($request->hasFile('foto_barang')) {
            foreach ($request->file('foto_barang') as $index => $file) {
                $filename = time() . '_' . $index . '.' . $file->extension();
                $file->move(public_path('images/barang/'), $filename);

                FotoBarang::create([
                    'id_barang' => $barang->id_barang,
                    'nama_file' => $filename,
                    'urutan' => $barang->fotoBarang()->count() + $index + 1,
                ]);
            }
        }
        // return redirect()->route('pegawai_gudang.barangTitipan.index')->with('success', 'Barang berhasil diperbarui!');
        return redirect()->route('pegawai_gudang.barangTitipan.showDetail', $barang->id_barang)
            ->with('success', 'Barang berhasil diperbarui!');
    }

    public function hapusFoto($id)
    {
        $foto = FotoBarang::findOrFail($id);

        $path = public_path('images/barang/' . $foto->nama_file);
        if (file_exists($path)) {
            unlink($path); // hapus file
        }

        $foto->delete(); // hapus record

        return back()->with('success', 'Foto berhasil dihapus.');
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
