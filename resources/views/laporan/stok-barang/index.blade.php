@extends('layouts.app')

@section('title', 'Laporan Stok Barang')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Laporan Stok Barang</h2>
            <p class="mt-1 text-sm text-gray-500">Laporan stok terkini berdasarkan data barang masuk dan keluar.</p>
        </div>
    </div>

    {{-- KONTROL PENCARIAN DAN EKSPOR --}}
    <div class="no-print flex flex-col sm:flex-row justify-between items-center mb-4 space-y-2 sm:space-y-0">
        <div class="relative w-full sm:max-w-xs">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" id="searchInput" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Cari barang...">
        </div>
        <div class="flex items-center space-x-2">
            <button id="printButton" class="flex items-center text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-3 rounded-lg">Cetak</button>
        </div>
    </div>

    {{-- TABEL DATA --}}
    <div class="overflow-x-auto border border-gray-200 rounded-lg">
        <table id="dataTable" class="min-w-full bg-white divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase">Nama Barang</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase">Total Masuk</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase">Total Keluar</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase">Stok Akhir</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase">Kondisi Stok</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase">Barcode</th>
                    <th scope="col" class="no-print py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody" class="divide-y divide-gray-200">
                @forelse ($stokBarangs as $item)
                    <tr>
                        <td class="py-4 px-4 whitespace-nowrap text-sm">
                            <div class="font-medium text-gray-900">{{ $item->nama_barang }}</div>
                            <div class="text-xs text-gray-500 font-mono">{{ $item->kode_barang }}</div>
                        </td>
                        <td class="py-4 px-4 whitespace-nowrap text-center text-sm text-gray-800">{{ $item->total_masuk ?? 0 }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-center text-sm text-gray-800">{{ $item->total_keluar ?? 0 }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-center text-sm font-semibold text-blue-700">
                            {{ $item->stok_akhir }}
                            <span class="text-xs font-normal text-gray-500">{{ $item->satuan->nama_satuan ?? '' }}</span>
                        </td>
                        <td class="py-4 px-4 whitespace-nowrap text-center">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($item->status == 'Aman') bg-green-100 text-green-800
                                @elseif($item->status == 'Menipis') bg-red-100 text-red-800
                                @else bg-gray-200 text-gray-800 @endif">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="py-4 px-4 whitespace-nowrap text-center">
                            @if($item->kode_barang)
                                <div class="flex flex-col items-center">
                                    {!! DNS1D::getBarcodeHTML($item->kode_barang, 'C128', 1, 33) !!}
                                </div>
                            @endif
                        </td>
                        <td class="no-print py-4 px-4 whitespace-nowrap text-sm">
                            <a href="{{ route('stok-barang.show', $item->kode_barang) }}" class="p-2 bg-gray-100 hover:bg-gray-200 rounded-full" title="Lihat Riwayat Transaksi">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-10 text-gray-500">Belum ada data untuk ditampilkan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection