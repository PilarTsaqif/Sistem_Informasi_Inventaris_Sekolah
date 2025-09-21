<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:TOOLMAN')->except(['index', 'show']);
    }

    public function index()
    {
        $pemasoks = Pemasok::all();
        return view('master.pemasok.index', compact('pemasoks'));
    }

    public function create()
    {
        return view('master.pemasok.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_pemasok' => 'required|string|unique:pemasoks,nama_pemasok|max:150']);
        Pemasok::create($request->all());
        return redirect()->route('master.pemasok.index')->with('success', 'Pemasok berhasil ditambahkan.');
    }

    /**
     * [TAMBAHKAN METHOD INI]
     * Menampilkan detail data pemasok.
     */
    public function show(Pemasok $pemasok)
    {
        return view('master.pemasok.show', compact('pemasok'));
    }

    public function edit(Pemasok $pemasok)
    {
        return view('master.pemasok.edit', compact('pemasok'));
    }

    public function update(Request $request, Pemasok $pemasok)
    {
        $request->validate(['nama_pemasok' => 'required|string|max:150|unique:pemasoks,nama_pemasok,' . $pemasok->id]);
        $pemasok->update($request->all());
        return redirect()->route('master.pemasok.index')->with('success', 'Pemasok berhasil diperbarui.');
    }

    public function destroy(Pemasok $pemasok)
    {
        // Tambahkan validasi jika pemasok terikat dengan data barang masuk
        if ($pemasok->barangMasuk()->exists()) {
            return redirect()->route('master.pemasok.index')->with('error', 'Pemasok tidak bisa dihapus karena sudah digunakan di data barang masuk.');
        }
        $pemasok->delete();
        return redirect()->route('master.pemasok.index')->with('success', 'Pemasok berhasil dihapus.');
    }
}