<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:TOOLMAN,GURU')->except(['index', 'show']);
    }

    public function index()
    {
        $peminjamans = Peminjaman::with('barang', 'satuan')
            ->whereDoesntHave('pengembalian')
            ->latest()
            ->get();
            
        return view('transaksi.peminjaman.index', compact('peminjamans'));
    }

    /**
     * [DIPERBARUI] Mengambil data barang beserta stok akhirnya.
     */
    public function create()
    {
        // Logika untuk menghitung stok akhir, sama seperti di Laporan Stok
        $barangs = Barang::with('satuan')
            ->withCount(['barangMasuk as total_masuk' => fn($q) => $q->select(DB::raw('sum(jumlah_masuk)'))])
            ->withCount(['barangMasuk as total_keluar' => fn($q) => 
                $q->select(DB::raw('sum(barangkeluars.jumlah_keluar)'))
                  ->join('barangkeluars', 'barangmasuks.id', '=', 'barangkeluars.id_barangmasuk')
            ])
            ->get()
            ->map(function ($item) {
                $item->stok_akhir = ($item->total_masuk ?? 0) - ($item->total_keluar ?? 0);
                return $item;
            })
            ->filter(function ($item) {
                // Hanya tampilkan barang yang stoknya lebih dari 0
                return $item->stok_akhir > 0;
            });
            
        return view('transaksi.peminjaman.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|exists:barangs,kode_barang',
            'nama_peminjam' => 'required|string|max:100',
            'tanggal_peminjaman' => 'required|date',
            'lama_peminjaman' => 'required|string|max:50',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak',
        ]);
        
        // Validasi tambahan untuk memastikan jumlah pinjam tidak melebihi stok
        $barang = Barang::find($request->kode_barang);
        $totalMasuk = $barang->barangMasuk()->sum('jumlah_masuk');
        $totalKeluar = \App\Models\BarangKeluar::whereHas('barangMasuk', fn($q) => $q->where('kode_barang', $barang->kode_barang))->sum('jumlah_keluar');
        $stokAkhir = $totalMasuk - $totalKeluar;

        if ($request->jumlah > $stokAkhir) {
            return back()->withInput()->with('error', 'Jumlah peminjaman melebihi stok yang tersedia. Stok saat ini: ' . $stokAkhir);
        }
        
        DB::transaction(function () use ($request, $barang) {
            $today = now()->format('Ymd');
            $count = Peminjaman::whereDate('created_at', today())->count() + 1;
            $kode = 'PJ-' . $today . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);

            Peminjaman::create(array_merge($request->all(), [
                'kode_peminjaman' => $kode,
                'id_satuan_pjm' => $barang->id_satuanbarang
            ]));
        });

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil ditambahkan.');
    }

    public function show(Peminjaman $peminjaman)
    {
        return view('transaksi.peminjaman.show', compact('peminjaman'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        if ($peminjaman->pengembalian) {
            return redirect()->route('peminjaman.index')->with('error', 'Data yang sudah dikembalikan tidak dapat diedit.');
        }
        $barangs = Barang::all();
        return view('transaksi.peminjaman.edit', compact('peminjaman', 'barangs'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'kode_barang' => 'required|exists:barangs,kode_barang',
            'nama_peminjam' => 'required|string|max:100',
            'tanggal_peminjaman' => 'required|date',
            'lama_peminjaman' => 'required|string|max:50',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak',
        ]);
        
        $barang = Barang::find($request->kode_barang);
        $peminjaman->update(array_merge($request->all(), [
            'id_satuan_pjm' => $barang->id_satuanbarang
        ]));

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        if ($peminjaman->pengembalian) {
            return redirect()->route('peminjaman.index')->with('error', 'Data tidak bisa dihapus karena sudah ada proses pengembalian.');
        }
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dibatalkan.');
    }
}