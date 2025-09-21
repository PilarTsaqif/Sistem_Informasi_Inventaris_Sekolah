<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with(['peminjaman.barang'])->latest()->paginate(10);
        return view('pengembalian.index', compact('pengembalians'));
    }

    public function create()
    {
        if (!Gate::any(['is-toolman', 'is-guru'])) abort(403);

        // Mengambil hanya data peminjaman yang BELUM memiliki data pengembalian
        $peminjamans = Peminjaman::whereDoesntHave('pengembalian')->with('barang')->get();
        return view('pengembalian.create', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        if (!Gate::any(['is-toolman', 'is-guru'])) abort(403);

        $request->validate([
            'id_peminjaman' => 'required|exists:peminjamans,id|unique:pengembalians,id_peminjaman',
            'tanggal_pengembalian' => 'required|date',
            'kondisi' => 'required|in:Baik,Rusak',
        ], [
            'id_peminjaman.unique' => 'Data peminjaman ini sudah memiliki catatan pengembalian.'
        ]);

        // Ambil data dari peminjaman terkait
        $peminjaman = Peminjaman::find($request->id_peminjaman);

        // Generate kode pengembalian unik
        $tanggal = date('Ymd');
        $urutan = Pengembalian::whereDate('created_at', today())->count() + 1;
        $kode = "PG-{$tanggal}-" . str_pad($urutan, 4, '0', STR_PAD_LEFT);
        
        Pengembalian::create([
            'kode_pengembalian' => $kode,
            'id_peminjaman' => $peminjaman->id,
            'nama_peminjam' => $peminjaman->nama_peminjam,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'kode_barang' => $peminjaman->kode_barang,
            'kondisi' => $request->kondisi,
        ]);

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil dicatat.');
    }

    public function show(Pengembalian $pengembalian)
    {
        $pengembalian->load(['peminjaman.barang', 'peminjaman.satuan']);
        return view('pengembalian.show', compact('pengembalian'));
    }
}