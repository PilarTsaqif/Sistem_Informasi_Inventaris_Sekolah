<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Menghitung total jenis barang
        $totalBarang = Barang::count();

        // 2. Menghitung jumlah stok menipis
        $stokMenipis = Barang::select('barangs.*')
            ->withSum('barangMasuks as total_masuk', 'jumlah_masuk')
            ->withSum('barangKeluars as total_keluar', 'jumlah_keluar')
            ->get()
            ->filter(function ($barang) {
                $stok_akhir = ($barang->total_masuk ?? 0) - ($barang->total_keluar ?? 0);
                return $stok_akhir > 0 && $stok_akhir <= $barang->stok_minimal;
            })
            ->count();

        // 3. Menghitung jumlah peminjaman yang masih aktif (belum dikembalikan)
        $peminjamanAktif = Peminjaman::whereDoesntHave('pengembalian')->count();
        
        // 4. Mengambil 5 transaksi barang masuk terbaru
        $barangMasukTerbaru = BarangMasuk::with('barang')->latest()->take(5)->get();
        
        // 5. Mengambil 5 transaksi barang keluar terbaru
        $barangKeluarTerbaru = BarangKeluar::with('barangMasuk.barang')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalBarang',
            'stokMenipis',
            'peminjamanAktif',
            'barangMasukTerbaru',
            'barangKeluarTerbaru'
        ));
    }
}