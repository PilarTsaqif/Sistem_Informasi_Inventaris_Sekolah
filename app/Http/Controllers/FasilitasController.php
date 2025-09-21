<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class FasilitasController extends Controller
{
    /**
     * Menampilkan daftar fasilitas di satu ruangan.
     */
    public function index(Ruangan $ruangan)
    {
        $ruangan->load('barangs.kategoriBarang', 'barangs.satuan');
        return view('fasilitas.index', compact('ruangan'));
    }

    /**
     * Menampilkan form untuk menambah fasilitas baru ke ruangan.
     */
    public function create(Ruangan $ruangan)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        // Ambil hanya barang yang BELUM ada di ruangan ini untuk dropdown
        $barangTersedia = Barang::whereDoesntHave('ruangans', function ($query) use ($ruangan) {
            $query->where('ruangan_id', $ruangan->id);
        })->orderBy('nama_barang')->get();

        return view('fasilitas.create', compact('ruangan', 'barangTersedia'));
    }

    /**
     * Menyimpan fasilitas baru ke dalam tabel pivot.
     */
    public function store(Request $request, Ruangan $ruangan)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate([
            'kode_barang' => ['required', 'exists:barangs,kode_barang', Rule::unique('barang_ruangan')->where('ruangan_id', $ruangan->id)],
            'jumlah' => 'required|integer|min:1',
        ], [ 
            'kode_barang.unique' => 'Barang ini sudah ada di dalam ruangan.' 
        ]);

        $ruangan->barangs()->attach($request->kode_barang, ['jumlah' => $request->jumlah]);
        return redirect()->route('fasilitas.index', $ruangan->id)->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengubah jumlah fasilitas.
     */
    public function edit(Ruangan $ruangan, Barang $barang)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        // Mengambil data barang spesifik dari dalam ruangan (termasuk data pivot 'jumlah')
        $fasilitas = $ruangan->barangs()->where('barangs.kode_barang', $barang->kode_barang)->firstOrFail();
        return view('fasilitas.edit', compact('ruangan', 'fasilitas'));
    }

    /**
     * Memperbarui jumlah fasilitas di dalam tabel pivot.
     */
    public function update(Request $request, Ruangan $ruangan, Barang $barang)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate(['jumlah' => 'required|integer|min:1']);
        $ruangan->barangs()->updateExistingPivot($barang->kode_barang, ['jumlah' => $request->jumlah]);
        return redirect()->route('fasilitas.index', $ruangan->id)->with('success', 'Jumlah fasilitas berhasil diperbarui.');
    }

    /**
     * Menghapus fasilitas dari ruangan (detach dari tabel pivot).
     */
    public function destroy(Ruangan $ruangan, Barang $barang)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $ruangan->barangs()->detach($barang->kode_barang);
        return redirect()->route('fasilitas.index', $ruangan->id)->with('success', 'Fasilitas berhasil dihapus dari ruangan.');
    }
}