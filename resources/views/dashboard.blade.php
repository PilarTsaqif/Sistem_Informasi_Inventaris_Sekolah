@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div>
    <!-- Kartu Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        {{-- Total Jenis Barang --}}
        <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Jenis Barang</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalBarang }}</p>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
            </div>
        </div>
        {{-- Stok Menipis --}}
        <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Stok Menipis</p>
                <p class="text-3xl font-bold {{ $stokMenipis > 0 ? 'text-red-600' : 'text-gray-800' }}">{{ $stokMenipis }}</p>
            </div>
            <div class="bg-red-100 rounded-full p-3">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
        </div>
        {{-- Peminjaman Aktif --}}
        <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Peminjaman Aktif</p>
                <p class="text-3xl font-bold text-gray-800">{{ $peminjamanAktif }}</p>
            </div>
            <div class="bg-yellow-100 rounded-full p-3">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4"></path></svg>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Barang Masuk Terbaru --}}
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Barang Masuk Terbaru</h3>
            <div class="space-y-4">
                @forelse ($barangMasukTerbaru as $item)
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900">{{ $item->barang->nama_barang ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500">{{ $item->tgl_masuk->format('d M Y') }}</p>
                        </div>
                        <p class="text-sm font-semibold text-green-600">+{{ $item->jumlah_masuk }} {{ $item->satuan->nama_satuan ?? '' }}</p>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Tidak ada aktivitas barang masuk.</p>
                @endforelse
            </div>
        </div>
        {{-- Barang Keluar Terbaru --}}
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Barang Keluar Terbaru</h3>
            <div class="space-y-4">
                @forelse ($barangKeluarTerbaru as $item)
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900">{{ $item->barangMasuk->barang->nama_barang ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500">{{ $item->tgl_keluar->format('d M Y') }}</p>
                        </div>
                        <p class="text-sm font-semibold text-red-600">-{{ $item->jumlah_keluar }} {{ $item->barangMasuk->satuan->nama_satuan ?? '' }}</p>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Tidak ada aktivitas barang keluar.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection