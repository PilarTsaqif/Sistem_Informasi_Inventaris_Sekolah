<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class StokBarangController extends Controller
{
    /**
     * Menampilkan laporan stok barang.
     */
    public function index()
    {
        // Mengambil semua data barang beserta relasinya
        // dan hitung total barang masuk & keluar menggunakan withSum
        $stokBarangs = Barang::with(['satuan', 'kategoriBarang'])
            ->withSum('barangMasuks as total_masuk', 'jumlah_masuk')
            ->withSum('barangKeluars as total_keluar', 'jumlah_keluar')
            ->latest('kode_barang')
            ->paginate(15);

        return view('stok-barang.index', compact('stokBarangs'));
    }

    /**
     * Menampilkan detail riwayat stok untuk satu barang.
     */
    public function show(Barang $barang)
    {
        // Mengambil riwayat transaksi untuk barang yang dipilih
        $riwayat_masuk = $barang->barangMasuks()->with('user', 'pemasok')->latest('tgl_masuk')->get();
        $riwayat_keluar = $barang->barangKeluars()->with('user')->latest('tgl_keluar')->get();
        
        // Menghitung total
        $total_masuk = $riwayat_masuk->sum('jumlah_masuk');
        $total_keluar = $riwayat_keluar->sum('jumlah_keluar');
        $stok_saat_ini = $total_masuk - $total_keluar;

        return view('stok-barang.show', compact('barang', 'riwayat_masuk', 'riwayat_keluar', 'stok_saat_ini'));
    }
}