<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:TOOLMAN')->except(['index', 'show']);
    }
    
    public function index()
    {
        $ruangans = Ruangan::with('jurusan')->get();
        return view('master.ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('master.ruangan.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_ruangan' => 'required|string|unique:ruangans,kode_ruangan',
            'nama_ruangan' => 'required|string|max:50',
            'id_jurusan' => 'nullable|exists:jurusans,id',
            'kode_rps' => 'nullable|string|max:50',
        ]);

        Ruangan::create($request->all());
        return redirect()->route('master.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    /**
     * [DIPERBARUI] Method show kini menampilkan halaman detail.
     */
    public function show(Ruangan $ruangan)
    {
        // Eager load relasi jurusan dan barangs (fasilitas)
        $ruangan->load('jurusan', 'barangs.satuan');
        return view('master.ruangan.show', compact('ruangan'));
    }

    public function edit(Ruangan $ruangan)
    {
        $jurusans = Jurusan::all();
        return view('master.ruangan.edit', compact('ruangan', 'jurusans'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'nama_ruangan' => 'required|string|max:50',
            'id_jurusan' => 'nullable|exists:jurusans,id',
            'kode_rps' => 'nullable|string|max:50',
        ]);

        $ruangan->update($request->all());
        return redirect()->route('master.ruangan.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect()->route('master.ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}