<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Method show bisa diakses semua role yang login
        $this->middleware('role:TOOLMAN,GURU')->except(['index', 'show']);
    }

    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.barang')->latest()->get();
        return view('transaksi.pengembalian.index', compact('pengembalians'));
    }

    public function create()
    {
        // Hanya tampilkan data peminjaman yang belum dikembalikan
        $peminjamans = Peminjaman::whereDoesntHave('pengembalian')->with('barang')->get();
        return view('transaksi.pengembalian.create', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_peminjaman' => 'required|exists:peminjamans,id|unique:pengembalians,id_peminjaman',
            'tanggal_pengembalian' => 'required|date',
            'kondisi' => 'required|in:Baik,Rusak',
        ], [
            'id_peminjaman.unique' => 'Data peminjaman ini sudah dikembalikan.'
        ]);

        $peminjaman = Peminjaman::find($request->id_peminjaman);

        DB::transaction(function () use ($request, $peminjaman) {
            $today = now()->format('Ymd');
            $count = Pengembalian::whereDate('created_at', today())->count() + 1;
            $kode = 'PG-' . $today . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);

            Pengembalian::create([
                'kode_pengembalian' => $kode,
                'id_peminjaman' => $peminjaman->id,
                'nama_peminjam' => $peminjaman->nama_peminjam,
                'tanggal_pengembalian' => $request->tanggal_pengembalian,
                'kode_barang' => $peminjaman->kode_barang,
                'kondisi' => $request->kondisi,
            ]);
        });

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil ditambahkan.');
    }

    /**
     * [TAMBAHKAN METHOD INI]
     * Menampilkan detail data pengembalian.
     */
    public function show(Pengembalian $pengembalian)
    {
        return view('transaksi.pengembalian.show', compact('pengembalian'));
    }
}