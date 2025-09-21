@extends('layouts.app')

@section('title', 'Detail Stok Barang')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Kartu Ringkasan Stok -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">{{ $barang->nama_barang }}</h2>
        <p class="text-sm text-gray-500 font-mono">{{ $barang->kode_barang }}</p>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
            <div class="p-4 bg-green-50 rounded-lg">
                <p class="text-sm font-medium text-green-600">Total Masuk</p>
                <p class="text-3xl font-bold text-green-700">{{ $riwayat_masuk->sum('jumlah_masuk') }}</p>
            </div>
            <div class="p-4 bg-red-50 rounded-lg">
                <p class="text-sm font-medium text-red-600">Total Keluar</p>
                <p class="text-3xl font-bold text-red-700">{{ $riwayat_keluar->sum('jumlah_keluar') }}</p>
            </div>
            <div class="p-4 bg-blue-50 rounded-lg">
                <p class="text-sm font-medium text-blue-600">Stok Akhir</p>
                <p class="text-3xl font-bold text-blue-700">{{ $stok_saat_ini }} <span class="text-lg font-normal">{{ $barang->satuan->nama_satuan ?? ''}}</span></p>
            </div>
        </div>
    </div>

    <!-- Riwayat Transaksi -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Riwayat Transaksi</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Riwayat Masuk --}}
            <div>
                <h4 class="font-semibold mb-2">Barang Masuk</h4>
                <div class="border rounded-lg overflow-hidden max-h-96 overflow-y-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50 text-xs uppercase"><tr><th class="p-2 text-left">Tanggal</th><th class="p-2 text-right">Jumlah</th><th class="p-2 text-left">Pemasok</th></tr></thead>
                        <tbody class="divide-y text-sm">
                            @forelse($riwayat_masuk as $item)
                            <tr>
                                <td class="p-2">{{ $item->tgl_masuk->format('d/m/y') }}</td>
                                <td class="p-2 text-right font-medium text-green-600">+{{ $item->jumlah_masuk }}</td>
                                <td class="p-2 text-gray-500">{{ $item->pemasok->nama_pemasok ?? 'N/A' }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="p-4 text-center text-gray-500">Tidak ada riwayat.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Riwayat Keluar --}}
            <div>
                <h4 class="font-semibold mb-2">Barang Keluar</h4>
                 <div class="border rounded-lg overflow-hidden max-h-96 overflow-y-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50 text-xs uppercase"><tr><th class="p-2 text-left">Tanggal</th><th class="p-2 text-right">Jumlah</th><th class="p-2 text-left">Customer</th></tr></thead>
                        <tbody class="divide-y text-sm">
                             @forelse($riwayat_keluar as $item)
                            <tr>
                                <td class="p-2">{{ $item->tgl_keluar->format('d/m/y') }}</td>
                                <td class="p-2 text-right font-medium text-red-600">-{{ $item->jumlah_keluar }}</td>
                                <td class="p-2 text-gray-500">{{ $item->customer }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="p-4 text-center text-gray-500">Tidak ada riwayat.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
     <div class="mt-8 text-left">
        <a href="{{ route('stok-barang.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">&larr; Kembali ke Laporan</a>
    </div>
</div>
@endsection