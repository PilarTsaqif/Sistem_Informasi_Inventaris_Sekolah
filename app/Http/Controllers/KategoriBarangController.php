<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:TOOLMAN')->except(['index', 'show']);
    }

    public function index()
    {
        $kategoriBarangs = KategoriBarang::all();
        return view('master.kategori-barang.index', compact('kategoriBarangs'));
    }

    public function create()
    {
        return view('master.kategori-barang.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_kategori' => 'required|string|unique:kategori_barangs,nama_kategori|max:100']);
        KategoriBarang::create($request->all());
        return redirect()->route('master.kategori-barang.index')->with('success', 'Kategori berhasil ditambahkan.');
    }
    
    public function show(KategoriBarang $kategoriBarang)
    {
        return view('master.kategori-barang.show', compact('kategoriBarang'));
    }

    public function edit(KategoriBarang $kategoriBarang)
    {
        return view('master.kategori-barang.edit', compact('kategoriBarang'));
    }

    public function update(Request $request, KategoriBarang $kategoriBarang)
    {
        $request->validate(['nama_kategori' => 'required|string|max:100|unique:kategori_barangs,nama_kategori,' . $kategoriBarang->id]);
        $kategoriBarang->update($request->all());
        return redirect()->route('master.kategori-barang.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(KategoriBarang $kategoriBarang)
    {
        if ($kategoriBarang->barangs()->exists()) {
            return redirect()->route('master.kategori-barang.index')->with('error', 'Kategori tidak bisa dihapus karena digunakan oleh data barang.');
        }
        $kategoriBarang->delete();
        return redirect()->route('master.kategori-barang.index')->with('success', 'Kategori berhasil dihapus.');
    }
}