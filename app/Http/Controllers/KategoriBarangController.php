<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class KategoriBarangController extends Controller
{
    public function index()
    {
        if (!Gate::allows('is-toolman')) abort(403);
        
        // Menggunakan withCount untuk menghitung jumlah barang per kategori secara efisien
        $kategoriBarangs = KategoriBarang::withCount('barangs')->latest('id')->paginate(10);
        return view('kategori-barang.index', compact('kategoriBarangs'));
    }

    public function create()
    {
        if (!Gate::allows('is-toolman')) abort(403);
        return view('kategori-barang.create');
    }

    public function store(Request $request)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_barangs,nama_kategori',
        ], [
            'nama_kategori.unique' => 'Nama kategori ini sudah terdaftar.'
        ]);

        KategoriBarang::create($request->all());

        return redirect()->route('kategori-barang.index')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    public function show(KategoriBarang $kategoriBarang)
    {
        return view('kategori-barang.show', compact('kategoriBarang'));
    }

    public function edit(KategoriBarang $kategoriBarang)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        return view('kategori-barang.edit', compact('kategoriBarang'));
    }

    public function update(Request $request, KategoriBarang $kategoriBarang)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_barangs,nama_kategori,' . $kategoriBarang->id,
        ], [
            'nama_kategori.unique' => 'Nama kategori ini sudah terdaftar.'
        ]);

        $kategoriBarang->update($request->all());

        return redirect()->route('kategori-barang.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(KategoriBarang $kategoriBarang)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        
        // Pencegahan hapus jika kategori masih digunakan oleh data barang
        if ($kategoriBarang->barangs()->exists()) {
            return redirect()->route('kategori-barang.index')->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh data barang.');
        }

        $kategoriBarang->delete();

        return redirect()->route('kategori-barang.index')->with('success', 'Kategori berhasil dihapus.');
    }
}