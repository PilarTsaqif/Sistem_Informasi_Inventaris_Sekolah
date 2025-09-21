<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JurusanController extends Controller
{
    public function index()
    {
        if (!Gate::allows('is-toolman')) abort(403);
        
        // Menggunakan withCount untuk menghitung jumlah ruangan per jurusan secara efisien
        $jurusans = Jurusan::withCount('ruangans')->latest('id')->paginate(10);
        return view('jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        if (!Gate::allows('is-toolman')) abort(403);
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate(['nama_jurusan' => 'required|string|max:100|unique:jurusans,nama_jurusan'], 
                         ['nama_jurusan.unique' => 'Nama jurusan ini sudah ada.']);

        Jurusan::create($request->all());

        return redirect()->route('jurusan.index')->with('success', 'Jurusan baru berhasil ditambahkan.');
    }

    public function edit(Jurusan $jurusan)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate(['nama_jurusan' => 'required|string|max:100|unique:jurusans,nama_jurusan,' . $jurusan->id], 
                         ['nama_jurusan.unique' => 'Nama jurusan ini sudah ada.']);

        $jurusan->update($request->all());

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Jurusan $jurusan)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        
        // Pencegahan hapus jika jurusan masih digunakan oleh data ruangan
        if ($jurusan->ruangans()->exists()) {
            return redirect()->route('jurusan.index')->with('error', 'Jurusan tidak dapat dihapus karena masih digunakan oleh data ruangan.');
        }

        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}