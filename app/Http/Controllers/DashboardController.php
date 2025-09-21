<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalBarang = Barang::count();
        $totalUser = User::count();
        $peminjamanAktif = Peminjaman::whereDoesntHave('pengembalian')->count();
        $stokMenipis = Barang::all()->filter(function ($barang) {
            $totalMasuk = $barang->barangMasuk()->sum('jumlah_masuk');
            $totalKeluar = \App\Models\BarangKeluar::whereHas('barangMasuk', fn($q) => $q->where('kode_barang', $barang->kode_barang))->sum('jumlah_keluar');
            $stokAkhir = $totalMasuk - $totalKeluar;
            $stokMinimal = $barang->barangMasuk()->latest()->first()->stok_minimal ?? 0;
            return $stokAkhir > 0 && $stokAkhir <= $stokMinimal;
        })->count();

        // [PERBAIKAN] Kirim variabel secara individual menggunakan compact()
        return view('dashboard', compact(
            'totalBarang', 
            'totalUser', 
            'peminjamanAktif',
            'stokMenipis'
        ));
    }
}