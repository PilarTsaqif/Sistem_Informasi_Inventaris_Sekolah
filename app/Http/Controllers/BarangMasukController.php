<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Pemasok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BarangMasukController extends Controller
{
    public function index()
    {
        // Eager load semua relasi yang dibutuhkan di halaman index
        $barangMasuks = BarangMasuk::with(['barang.kategoriBarang', 'satuan', 'pemasok', 'user'])->latest()->paginate(10);
        return view('barang-masuk.index', compact('barangMasuks'));
    }

    public function create()
    {
        if (!Gate::allows('is-toolman')) abort(403);
        
        $barangs = Barang::orderBy('nama_barang')->get();
        $satuans = Satuan::orderBy('nama_satuan')->get();
        $pemasoks = Pemasok::orderBy('nama_pemasok')->get();
        return view('barang-masuk.create', compact('barangs', 'satuans', 'pemasoks'));
    }

    public function store(Request $request)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate([
            'tgl_masuk' => 'required|date',
            'kode_barang' => 'required|exists:barangs,kode_barang',
            'jumlah_masuk' => 'required|integer|min:1',
            'id_satuan' => 'required|exists:satuans,id',
            'kondisi' => 'required|in:Baik,Rusak',
            'pemasok_id' => 'nullable|exists:pemasoks,id',
            'tgl_expired' => 'nullable|date|after_or_equal:tgl_masuk',
        ]);

        BarangMasuk::create(array_merge($request->all(), ['id_user' => Auth::id()]));

        return redirect()->route('barang-masuk.index')->with('success', 'Data barang masuk berhasil dicatat.');
    }

    public function show(BarangMasuk $barangMasuk)
    {
        $barangMasuk->load(['barang.kategoriBarang', 'satuan', 'pemasok', 'user']);
        return view('barang-masuk.show', compact('barangMasuk'));
    }

    public function edit(BarangMasuk $barangMasuk)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        
        $barangs = Barang::orderBy('nama_barang')->get();
        $satuans = Satuan::orderBy('nama_satuan')->get();
        $pemasoks = Pemasok::orderBy('nama_pemasok')->get();
        return view('barang-masuk.edit', compact('barangMasuk', 'barangs', 'satuans', 'pemasoks'));
    }

    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate([
            'tgl_masuk' => 'required|date',
            'kode_barang' => 'required|exists:barangs,kode_barang',
            'jumlah_masuk' => 'required|integer|min:1',
            'id_satuan' => 'required|exists:satuans,id',
            'kondisi' => 'required|in:Baik,Rusak',
            'pemasok_id' => 'nullable|exists:pemasoks,id',
            'tgl_expired' => 'nullable|date|after_or_equal:tgl_masuk',
        ]);

        $barangMasuk->update($request->all());

        return redirect()->route('barang-masuk.index')->with('success', 'Data barang masuk berhasil diperbarui.');
    }

    public function destroy(BarangMasuk $barangMasuk)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        
        $barangMasuk->delete();

        return redirect()->route('barang-masuk.index')->with('success', 'Catatan barang masuk berhasil dihapus.');
    }
}