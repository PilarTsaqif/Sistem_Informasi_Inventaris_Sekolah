<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::with('jurusan')->withCount('barangs')->latest()->paginate(10);
        return view('ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        if (!Gate::allows('is-toolman')) abort(403);
        $jurusans = Jurusan::orderBy('nama_jurusan')->get();
        return view('ruangan.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        $request->validate([
            'kode_ruangan' => 'required|string|max:50|unique:ruangans,kode_ruangan',
            'nama_ruangan' => 'required|string|max:100',
            'id_jurusan' => 'nullable|exists:jurusans,id',
        ]);
        Ruangan::create($request->all());
        return redirect()->route('ruangan.index')->with('success', 'Ruangan baru berhasil ditambahkan.');
    }

    // Halaman show untuk Ruangan dialihkan ke halaman Fasilitas
    public function show(Ruangan $ruangan)
    {
        return redirect()->route('fasilitas.index', $ruangan->id);
    }

    public function edit(Ruangan $ruangan)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        $jurusans = Jurusan::orderBy('nama_jurusan')->get();
        return view('ruangan.edit', compact('ruangan', 'jurusans'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        $request->validate([
            'kode_ruangan' => 'required|string|max:50|unique:ruangans,kode_ruangan,' . $ruangan->id,
            'nama_ruangan' => 'required|string|max:100',
            'id_jurusan' => 'nullable|exists:jurusans,id',
        ]);
        $ruangan->update($request->all());
        return redirect()->route('ruangan.index')->with('success', 'Data ruangan berhasil diperbarui.');
    }

    public function destroy(Ruangan $ruangan)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        $ruangan->delete();
        return redirect()->route('ruangan.index')->with('success', 'Data ruangan berhasil dihapus.');
    }
}