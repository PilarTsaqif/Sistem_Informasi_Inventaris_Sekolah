<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Satuan;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with(['satuan', 'kategoriBarang'])->latest()->paginate(10);
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        if (!Gate::allows('is-toolman')) abort(403);
        
        $satuans = Satuan::orderBy('nama_satuan')->get();
        $kategoriBarangs = KategoriBarang::orderBy('nama_kategori')->get();
        
        return view('barang.create', compact('satuans', 'kategoriBarangs'));
    }

    public function store(Request $request)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate([
            'kode_barang' => 'required|string|max:50|unique:barangs,kode_barang',
            'nama_barang' => 'required|string|max:100',
            'kategori_barang_id' => 'required|exists:kategori_barangs,id',
            'id_satuanbarang' => 'required|exists:satuans,id',
            'info_maintenance' => 'nullable|string|max:255',
            'stok_minimal' => 'required|integer|min:0',
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang baru berhasil ditambahkan.');
    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        
        $satuans = Satuan::orderBy('nama_satuan')->get();
        $kategoriBarangs = KategoriBarang::orderBy('nama_kategori')->get();
        
        return view('barang.edit', compact('barang', 'satuans', 'kategoriBarangs'));
    }

    public function update(Request $request, Barang $barang)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate([
            'nama_barang' => 'required|string|max:100',
            'kategori_barang_id' => 'required|exists:kategori_barangs,id',
            'id_satuanbarang' => 'required|exists:satuans,id',
            'info_maintenance' => 'nullable|string|max:255',
            'stok_minimal' => 'required|integer|min:0',
        ]);

        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        
        if ($barang->barangMasuks()->exists() || $barang->peminjamans()->exists()) {
            return redirect()->route('barang.index')
                   ->with('error', 'Barang tidak dapat dihapus karena sudah memiliki riwayat transaksi.');
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus.');
    }
}