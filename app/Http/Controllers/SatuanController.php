<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SatuanController extends Controller
{
    public function index()
    {
        if (!Gate::allows('is-toolman')) abort(403);
        
        // Menggunakan withCount untuk menghitung jumlah barang per satuan
        $satuans = Satuan::withCount('barangs')->latest('id')->paginate(10);
        return view('satuan.index', compact('satuans'));
    }

    public function create()
    {
        if (!Gate::allows('is-toolman')) abort(403);
        return view('satuan.create');
    }

    public function store(Request $request)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate([
            'nama_satuan' => 'required|string|max:50|unique:satuans,nama_satuan',
        ], [
            'nama_satuan.unique' => 'Nama satuan ini sudah ada.'
        ]);

        Satuan::create($request->all());

        return redirect()->route('satuan.index')->with('success', 'Satuan baru berhasil ditambahkan.');
    }

    public function show(Satuan $satuan)
    {
        // Tampilan 'show' tidak diperlukan untuk data sesederhana ini.
        return redirect()->route('satuan.index');
    }

    public function edit(Satuan $satuan)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        return view('satuan.edit', compact('satuan'));
    }

    public function update(Request $request, Satuan $satuan)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate([
            'nama_satuan' => 'required|string|max:50|unique:satuans,nama_satuan,' . $satuan->id,
        ], [
            'nama_satuan.unique' => 'Nama satuan ini sudah ada.'
        ]);

        $satuan->update($request->all());

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil diperbarui.');
    }

    public function destroy(Satuan $satuan)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        
        // Pencegahan hapus jika satuan masih digunakan oleh data barang atau peminjaman
        if ($satuan->barangs()->exists() || $satuan->peminjamans()->exists()) {
            return redirect()->route('satuan.index')->with('error', 'Satuan tidak dapat dihapus karena masih digunakan oleh data lain.');
        }

        $satuan->delete();

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil dihapus.');
    }
}