<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Pemasok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:TOOLMAN')->except(['index', 'show']);
    }

    public function index()
    {
        $barangMasuks = BarangMasuk::with('barang', 'satuan', 'pemasok', 'user')->latest()->get();
        return view('transaksi.barang-masuk.index', compact('barangMasuks'));
    }

    public function create()
    {
        $barangs = Barang::all();
        $satuans = Satuan::all();
        $pemasoks = Pemasok::all();
        return view('transaksi.barang-masuk.create', compact('barangs', 'satuans', 'pemasoks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_masuk' => 'required|date',
            'kode_barang' => 'required|exists:barangs,kode_barang',
            'jumlah_masuk' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak',
            'pemasok_id' => 'nullable|exists:pemasoks,id',
            'stok_minimal' => 'required|integer|min:0',
        ]);

        $barang = Barang::find($request->kode_barang);

        BarangMasuk::create(array_merge($request->all(), [
            'id_user' => Auth::id(),
            'id_satuan' => $barang->id_satuanbarang, // Ambil satuan dari master barang
        ]));

        return redirect()->route('barang-masuk.index')->with('success', 'Data barang masuk berhasil ditambahkan.');
    }

    public function show(BarangMasuk $barangMasuk)
    {
        return view('transaksi.barang-masuk.show', compact('barangMasuk'));
    }

    public function edit(BarangMasuk $barangMasuk)
    {
        $barangs = Barang::all();
        $pemasoks = Pemasok::all();
        return view('transaksi.barang-masuk.edit', compact('barangMasuk', 'barangs', 'pemasoks'));
    }

    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        $request->validate([
            'tgl_masuk' => 'required|date',
            'kode_barang' => 'required|exists:barangs,kode_barang',
            'jumlah_masuk' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak',
            'pemasok_id' => 'nullable|exists:pemasoks,id',
            'stok_minimal' => 'required|integer|min:0',
        ]);
        
        $barang = Barang::find($request->kode_barang);
        
        $barangMasuk->update(array_merge($request->all(), [
            'id_user' => Auth::id(),
            'id_satuan' => $barang->id_satuanbarang,
        ]));

        return redirect()->route('barang-masuk.index')->with('success', 'Data barang masuk berhasil diperbarui.');
    }

    public function destroy(BarangMasuk $barangMasuk)
    {
        if ($barangMasuk->barangKeluar()->exists()) {
            return redirect()->route('barang-masuk.index')->with('error', 'Data tidak bisa dihapus karena terkait transaksi barang keluar.');
        }

        $barangMasuk->delete();
        return redirect()->route('barang-masuk.index')->with('success', 'Data barang masuk berhasil dihapus.');
    }
}