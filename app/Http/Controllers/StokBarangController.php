<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;

class StokBarangController extends Controller
{
    /**
     * Hanya role tertentu yang bisa melihat laporan stok.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:TOOLMAN,KAPRODI,GURU');
    }

    public function index()
    {
        $stokBarangs = Barang::with('satuan', 'kategori')
            ->withCount(['barangMasuk as total_masuk' => fn($q) => $q->select(DB::raw('sum(jumlah_masuk)'))])
            ->withCount(['barangMasuk as total_keluar' => fn($q) => 
                $q->select(DB::raw('sum(barangkeluars.jumlah_keluar)'))
                  ->join('barangkeluars', 'barangmasuks.id', '=', 'barangkeluars.id_barangmasuk')
            ])
            ->get()
            ->map(function ($item) {
                $item->stok_akhir = $item->total_masuk - $item->total_keluar;
                $lastBatch = $item->barangMasuk()->latest('tgl_masuk')->first();
                $stokMinimal = $lastBatch ? $lastBatch->stok_minimal : 0;
                
                if ($item->stok_akhir <= 0) $item->status = 'Habis';
                elseif ($item->stok_akhir <= $stokMinimal) $item->status = 'Menipis';
                else $item->status = 'Aman';
                
                return $item;
            });
            
        return view('laporan.stok-barang.index', compact('stokBarangs'));
    }
    
    public function show(Barang $barang)
    {
        // Detail stok untuk satu barang, per batch masuk
        $detailStok = BarangMasuk::where('kode_barang', $barang->kode_barang)
            ->with('pemasok')
            ->withSum('barangKeluar', 'jumlah_keluar')
            ->latest('tgl_masuk')
            ->get();
            
        return view('laporan.stok-barang.show', compact('barang', 'detailStok'));
    }
}