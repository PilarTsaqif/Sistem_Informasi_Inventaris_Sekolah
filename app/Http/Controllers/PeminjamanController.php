<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PeminjamanController extends Controller
{
    // Fungsi helper untuk mendapatkan stok terkini dari sebuah barang
    private function getCurrentStock($kode_barang)
    {
        $barang = Barang::withSum('barangMasuks as total_masuk', 'jumlah_masuk')
            ->withSum('barangKeluars as total_keluar', 'jumlah_keluar')
            ->find($kode_barang);
        
        if (!$barang) return 0;
        
        // Stok saat ini adalah total masuk dikurangi total keluar DITAMBAH total yang sedang dipinjam
        $total_peminjaman_aktif = Peminjaman::where('kode_barang', $kode_barang)->whereDoesntHave('pengembalian')->sum('jumlah');
        $stok_fisik = ($barang->total_masuk ?? 0) - ($barang->total_keluar ?? 0);
        
        return $stok_fisik - $total_peminjaman_aktif;
    }

    public function index()
    {
        $peminjamans = Peminjaman::with(['barang.kategoriBarang', 'satuan', 'pengembalian'])->latest()->paginate(10);
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        if (!Gate::any(['is-toolman', 'is-guru'])) abort(403);
        
        $barangs = Barang::orderBy('nama_barang')->get();
        $satuans = Satuan::orderBy('nama_satuan')->get();
        return view('peminjaman.create', compact('barangs', 'satuans'));
    }

    public function store(Request $request)
    {
        if (!Gate::any(['is-toolman', 'is-guru'])) abort(403);

        $request->validate([
            'nama_peminjam' => 'required|string|max:100',
            'kode_barang' => 'required|exists:barangs,kode_barang',
            'jumlah' => 'required|integer|min:1',
            'id_satuan_pjm' => 'required|exists:satuans,id',
            'tanggal_peminjaman' => 'required|date',
            'lama_peminjaman' => 'required|string|max:50',
            'kondisi' => 'required|in:Baik,Rusak',
        ]);

        $stokTersedia = $this->getCurrentStock($request->kode_barang);
        if ($request->jumlah > $stokTersedia) {
            return back()->withErrors(['jumlah' => "Stok tidak mencukupi. Sisa stok tersedia untuk dipinjam adalah {$stokTersedia}."])->withInput();
        }

        $tanggal = date('Ymd');
        $urutan = Peminjaman::whereDate('created_at', today())->count() + 1;
        $kode = "PJ-{$tanggal}-" . str_pad($urutan, 4, '0', STR_PAD_LEFT);

        Peminjaman::create(array_merge($request->all(), ['kode_peminjaman' => $kode]));

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dicatat.');
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['barang.kategoriBarang', 'satuan', 'pengembalian']);
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        if (!Gate::any(['is-toolman', 'is-guru'])) abort(403);
        
        if ($peminjaman->pengembalian) {
            return redirect()->route('peminjaman.index')->with('error', 'Data yang sudah dikembalikan tidak dapat diedit.');
        }

        $barangs = Barang::orderBy('nama_barang')->get();
        $satuans = Satuan::orderBy('nama_satuan')->get();
        return view('peminjaman.edit', compact('peminjaman', 'barangs', 'satuans'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        if (!Gate::any(['is-toolman', 'is-guru'])) abort(403);

        $request->validate([
            'nama_peminjam' => 'required|string|max:100',
            'kode_barang' => 'required|exists:barangs,kode_barang',
            'jumlah' => 'required|integer|min:1',
            'id_satuan_pjm' => 'required|exists:satuans,id',
            'tanggal_peminjaman' => 'required|date',
            'lama_peminjaman' => 'required|string|max:50',
            'kondisi' => 'required|in:Baik,Rusak',
        ]);

        $stokSaatDiedit = $peminjaman->jumlah;
        $stokTersedia = $this->getCurrentStock($request->kode_barang) + ($peminjaman->kode_barang == $request->kode_barang ? $stokSaatDiedit : 0);
        if ($request->jumlah > $stokTersedia) {
            return back()->withErrors(['jumlah' => "Stok tidak mencukupi. Sisa stok tersedia {$stokTersedia}."])->withInput();
        }

        $peminjaman->update($request->all());
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        if (!Gate::any(['is-toolman', 'is-guru'])) abort(403);
        
        if ($peminjaman->pengembalian) {
            return redirect()->route('peminjaman.index')->with('error', 'Data yang sudah dikembalikan tidak dapat dihapus.');
        }

        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}