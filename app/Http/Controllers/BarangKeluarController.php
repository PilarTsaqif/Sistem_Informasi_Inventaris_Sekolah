<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:TOOLMAN')->except(['index', 'show']);
    }

    public function index()
    {
        $barangKeluars = BarangKeluar::with('barangMasuk.barang', 'user')->latest()->get();
        return view('transaksi.barang-keluar.index', compact('barangKeluars'));
    }

    public function create()
    {
        $barangMasuks = BarangMasuk::with('barang')
            ->get()
            ->filter(fn($item) => $item->sisa_stok > 0);
            
        return view('transaksi.barang-keluar.create', compact('barangMasuks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_keluar' => 'required|date',
            'id_barangmasuk' => 'required|exists:barangmasuks,id',
            'jumlah_keluar' => 'required|integer|min:1',
            'customer' => 'required|string|max:50',
        ]);
        
        $barangMasuk = BarangMasuk::find($request->id_barangmasuk);
        
        if ($request->jumlah_keluar > $barangMasuk->sisa_stok) {
            return back()->withInput()->with('error', 'Jumlah keluar melebihi sisa stok: ' . $barangMasuk->sisa_stok);
        }

        DB::transaction(function () use ($request) {
            $today = now()->format('Ymd');
            $count = BarangKeluar::whereDate('created_at', today())->count() + 1;
            $uid = 'BK-' . $today . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);

            BarangKeluar::create(array_merge($request->all(), [
                'uid_barangkeluar' => $uid,
                'id_user' => Auth::id(),
            ]));
        });

        return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil ditambahkan.');
    }

    public function show(BarangKeluar $barangKeluar)
    {
        return view('transaksi.barang-keluar.show', compact('barangKeluar'));
    }

    public function destroy(BarangKeluar $barangKeluar)
    {
        $barangKeluar->delete();
        return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil dihapus.');
    }
}