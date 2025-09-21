<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:TOOLMAN')->except(['index', 'show']);
    }

    public function index()
    {
        $jurusans = Jurusan::all();
        return view('master.jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('master.jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_jurusan' => 'required|string|unique:jurusans,nama_jurusan|max:100']);
        Jurusan::create($request->all());
        return redirect()->route('master.jurusan.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('master.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate(['nama_jurusan' => 'required|string|max:100|unique:jurusans,nama_jurusan,' . $jurusan->id]);
        $jurusan->update($request->all());
        return redirect()->route('master.jurusan.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('master.jurusan.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}