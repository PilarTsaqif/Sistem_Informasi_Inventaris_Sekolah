<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:TOOLMAN')->except(['index', 'show']);
    }
    
    public function index()
    {
        $satuans = Satuan::all();
        return view('master.satuan.index', compact('satuans'));
    }
    
    public function create()
    {
        return view('master.satuan.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_satuan' => 'required|string|unique:satuans,nama_satuan|max:50']);
        Satuan::create($request->all());
        return redirect()->route('master.satuan.index')->with('success', 'Satuan berhasil ditambahkan.');
    }

    public function show(Satuan $satuan)
    {
        return view('master.satuan.show', compact('satuan'));
    }
    
    public function edit(Satuan $satuan)
    {
        return view('master.satuan.edit', compact('satuan'));
    }

    public function update(Request $request, Satuan $satuan)
    {
        $request->validate(['nama_satuan' => 'required|string|max:50|unique:satuans,nama_satuan,' . $satuan->id]);
        $satuan->update($request->all());
        return redirect()->route('master.satuan.index')->with('success', 'Satuan berhasil diperbarui.');
    }

    public function destroy(Satuan $satuan)
    {
        // Cek apakah satuan digunakan di tabel lain
        $isUsedInBarang = DB::table('barangs')->where('id_satuanbarang', $satuan->id)->exists();
        $isUsedInBarangMasuk = DB::table('barangmasuks')->where('id_satuan', $satuan->id)->exists();
        $isUsedInPeminjaman = DB::table('peminjamans')->where('id_satuan_pjm', $satuan->id)->exists();

        if ($isUsedInBarang || $isUsedInBarangMasuk || $isUsedInPeminjaman) {
             return redirect()->route('master.satuan.index')->with('error', 'Satuan tidak bisa dihapus karena sedang digunakan.');
        }

        $satuan->delete();
        return redirect()->route('master.satuan.index')->with('success', 'Satuan berhasil dihapus.');
    }
}