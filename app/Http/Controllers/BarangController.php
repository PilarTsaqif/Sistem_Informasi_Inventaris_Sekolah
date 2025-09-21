<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\Satuan;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Terapkan middleware otorisasi pada constructor.
     * Semua user bisa melihat data (index, show).
     * Hanya TOOLMAN yang bisa mengelola (create, store, edit, update, destroy).
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:TOOLMAN')->except(['index', 'show']);
    }

    public function index()
    {
        $barangs = Barang::with('kategori', 'satuan')->latest()->get();
        return view('master.barang.index', compact('barangs'));
    }

    public function create()
    {
        $kategoris = KategoriBarang::all();
        $satuans = Satuan::all();
        return view('master.barang.create', compact('kategoris', 'satuans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|unique:barangs,kode_barang|max:50',
            'nama_barang' => 'required|string|max:100',
            'kategori_barang_id' => 'nullable|exists:kategori_barangs,id',
            'id_satuanbarang' => 'required|exists:satuans,id',
        ]);

        Barang::create($request->all());
        return redirect()->route('master.barang.index')->with('success', 'Data barang berhasil ditambahkan.');
    }

    public function show(Barang $barang)
    {
        return view('master.barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        $kategoris = KategoriBarang::all();
        $satuans = Satuan::all();
        return view('master.barang.edit', compact('barang', 'kategoris', 'satuans'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:100',
            'kategori_barang_id' => 'nullable|exists:kategori_barangs,id',
            'id_satuanbarang' => 'required|exists:satuans,id',
        ]);

        $barang->update($request->all());
        return redirect()->route('master.barang.index')->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        try {
            $barang->delete();
            return redirect()->route('master.barang.index')->with('success', 'Data barang berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('master.barang.index')->with('error', 'Gagal menghapus data karena terikat dengan data lain.');
        }
    }
}