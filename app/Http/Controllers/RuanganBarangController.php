<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class RuanganBarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Otorisasi menggunakan Gate agar lebih fleksibel, pastikan Gate 'is-toolman' terdefinisi
        $this->middleware('can:is-toolman')->except('index');
    }

    public function index(Ruangan $ruangan)
    {
        $ruangan->load('barangs.kategori', 'barangs.satuan');
        return view('fasilitas.index', compact('ruangan'));
    }

    public function create(Ruangan $ruangan)
    {
        $barangTersedia = Barang::whereDoesntHave('ruangans', fn($q) => $q->where('ruangan_id', $ruangan->id))
            ->orderBy('nama_barang')->get();
        return view('fasilitas.create', compact('ruangan', 'barangTersedia'));
    }

    public function store(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'kode_barang' => ['required', 'exists:barangs,kode_barang', Rule::unique('barang_ruangan')->where('ruangan_id', $ruangan->id)],
            'jumlah' => 'required|integer|min:1',
        ], ['kode_barang.unique' => 'Barang ini sudah ada di dalam ruangan.']);

        $ruangan->barangs()->attach($request->kode_barang, ['jumlah' => $request->jumlah]);
        return redirect()->route('fasilitas.index', $ruangan->id)->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Ruangan $ruangan, Barang $barang)
    {
        $fasilitas = $ruangan->barangs()->where('barangs.kode_barang', $barang->kode_barang)->firstOrFail();
        return view('fasilitas.edit', compact('ruangan', 'fasilitas'));
    }

    public function update(Request $request, Ruangan $ruangan, Barang $barang)
    {
        $request->validate(['jumlah' => 'required|integer|min:1']);
        $ruangan->barangs()->updateExistingPivot($barang->kode_barang, ['jumlah' => $request->jumlah]);
        return redirect()->route('fasilitas.index', $ruangan->id)->with('success', 'Jumlah fasilitas berhasil diperbarui.');
    }

    public function destroy(Ruangan $ruangan, Barang $barang)
    {
        $ruangan->barangs()->detach($barang->kode_barang);
        return redirect()->route('fasilitas.index', $ruangan->id)->with('success', 'Fasilitas berhasil dihapus dari ruangan.');
    }
}