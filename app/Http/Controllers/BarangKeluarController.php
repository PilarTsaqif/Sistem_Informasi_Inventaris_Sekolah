<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    // Fungsi untuk menghitung sisa stok dari sebuah batch barang masuk
    private function getSisaStok($id_barangmasuk)
    {
        $barangMasuk = BarangMasuk::find($id_barangmasuk);
        if (!$barangMasuk) return 0;

        $totalMasuk = $barangMasuk->jumlah_masuk;
        $totalKeluar = BarangKeluar::where('id_barangmasuk', $id_barangmasuk)->sum('jumlah_keluar');
        return $totalMasuk - $totalKeluar;
    }

    public function index()
    {
        $barangKeluars = BarangKeluar::with(['barangMasuk.barang.kategoriBarang', 'user'])->latest()->paginate(10);
        return view('barang-keluar.index', compact('barangKeluars'));
    }

    public function create()
    {
        if (!Gate::allows('is-toolman')) abort(403);

        // Query untuk mengambil semua batch barang masuk yang masih memiliki sisa stok
        $barangMasukTersedia = BarangMasuk::with('barang')
            ->whereHas('barang')
            ->select('barangmasuks.*', DB::raw('barangmasuks.jumlah_masuk - IFNULL((SELECT SUM(jumlah_keluar) FROM barangkeluars WHERE id_barangmasuk = barangmasuks.id), 0) as sisa_stok'))
            ->groupBy('barangmasuks.id')
            ->having('sisa_stok', '>', 0)
            ->get();
            
        return view('barang-keluar.create', compact('barangMasukTersedia'));
    }

    public function store(Request $request)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate([
            'tgl_keluar' => 'required|date',
            'id_barangmasuk' => 'required|exists:barangmasuks,id',
            'jumlah_keluar' => 'required|integer|min:1',
            'customer' => 'required|string|max:50',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string|max:100',
        ]);
        
        $sisaStok = $this->getSisaStok($request->id_barangmasuk);
        if ($request->jumlah_keluar > $sisaStok) {
            return back()->withErrors(['jumlah_keluar' => "Stok tidak mencukupi. Sisa stok untuk batch ini adalah {$sisaStok}."])->withInput();
        }

        $tanggal = date('Ymd');
        $urutan = BarangKeluar::whereDate('created_at', today())->count() + 1;
        $uid = "BK-{$tanggal}-" . str_pad($urutan, 4, '0', STR_PAD_LEFT);

        BarangKeluar::create(array_merge($request->all(), [
            'uid_barangkeluar' => $uid,
            'id_user' => Auth::id()
        ]));

        return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil dicatat.');
    }

    public function show(BarangKeluar $barangKeluar)
    {
        $barangKeluar->load(['barangMasuk.barang.kategoriBarang', 'barangMasuk.satuan', 'user']);
        return view('barang-keluar.show', compact('barangKeluar'));
    }

    public function edit(BarangKeluar $barangKeluar)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        
        $barangMasukTersedia = BarangMasuk::with('barang')->get();
        return view('barang-keluar.edit', compact('barangKeluar', 'barangMasukTersedia'));
    }

    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate([
            'tgl_keluar' => 'required|date',
            'id_barangmasuk' => 'required|exists:barangmasuks,id',
            'jumlah_keluar' => 'required|integer|min:1',
            'customer' => 'required|string|max:50',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string|max:100',
        ]);

        $stokSebelumnya = $barangKeluar->jumlah_keluar;
        $sisaStok = $this->getSisaStok($request->id_barangmasuk) + ($barangKeluar->id_barangmasuk == $request->id_barangmasuk ? $stokSebelumnya : 0);

        if ($request->jumlah_keluar > $sisaStok) {
            return back()->withErrors(['jumlah_keluar' => "Stok tidak mencukupi. Sisa stok tersedia adalah {$sisaStok}."])->withInput();
        }

        $barangKeluar->update($request->all());
        return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil diperbarui.');
    }

    public function destroy(BarangKeluar $barangKeluar)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        $barangKeluar->delete();
        return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil dihapus.');
    }
}