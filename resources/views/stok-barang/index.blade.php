@extends('layouts.app')
@section('title', 'Laporan Stok Barang')
@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Laporan Stok Barang</h2>
            <p class="mt-1 text-sm text-gray-500">Laporan stok terkini berdasarkan data barang masuk dan keluar.</p>
        </div>
    </div>

    {{-- KONTROL PENCARIAN DAN EKSPOR DITAMBAHKAN --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 space-y-2 sm:space-y-0">
        <div class="relative w-full sm:max-w-xs">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
            </div>
            <input type="text" id="searchInput" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Cari barang...">
        </div>
        <div class="flex items-center space-x-2">
            <button id="printButton" class="flex items-center text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-3 rounded-lg"><span>Print</span></button>
            <button id="excelButton" class="flex items-center text-sm bg-green-100 hover:bg-green-200 text-green-700 font-medium py-2 px-3 rounded-lg"><span>Excel</span></button>
            <button id="wordButton" class="flex items-center text-sm bg-blue-100 hover:bg-blue-200 text-blue-700 font-medium py-2 px-3 rounded-lg"><span>Word</span></button>
            <button id="pdfButton" class="flex items-center text-sm bg-red-100 hover:bg-red-200 text-red-700 font-medium py-2 px-3 rounded-lg"><span>PDF</span></button>
        </div>
    </div>

    {{-- CONTAINER TABEL AGAR RESPONSIVE --}}
    <div class="overflow-x-auto border border-gray-200 rounded-lg">
        {{-- ID DITAMBAHKAN --}}
        <table id="dataTable" class="min-w-full bg-white divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Kode Barang</th>
                    <th scope="col" class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Nama Barang</th>
                    <th scope="col" class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Kategori</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Total Masuk</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Total Keluar</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Stok Akhir</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Kondisi Stok</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Barcode Barang</th> <!-- Kolom Barcode -->
                    <th scope="col" class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            {{-- ID DITAMBAHKAN --}}
            <tbody id="tableBody" class="divide-y divide-gray-200">
                @forelse ($stokBarangs as $item)
                    @php
                        $stok_akhir = ($item->total_masuk ?? 0) - ($item->total_keluar ?? 0);
                        $batas_menipis = $item->stok_minimal ?? 5;
                        
                        if ($stok_akhir <= 0) {
                            $kondisi = 'Habis'; $warna = 'bg-gray-200 text-gray-800';
                        } elseif ($stok_akhir <= $batas_menipis) {
                            $kondisi = 'Menipis'; $warna = 'bg-red-100 text-red-800';
                        } else {
                            $kondisi = 'Aman'; $warna = 'bg-green-100 text-green-800';
                        }
                    @endphp
                    <tr>
                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">{{ $item->kode_barang }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-800">{{ $item->nama_barang }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">{{ $item->kategoriBarang->nama_kategori ?? 'N/A' }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-center text-sm text-gray-800">{{ $item->total_masuk ?? 0 }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-center text-sm text-gray-800">{{ $item->total_keluar ?? 0 }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-center text-sm font-semibold text-blue-700">
                            {{ $stok_akhir }}
                            <span class="text-sm font-normal text-gray-500">{{ $item->satuan->nama_satuan ?? '' }}</span>
                        </td>
                        <td class="py-4 px-4 whitespace-nowrap text-center">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $warna }}">
                                {{ $kondisi }}
                            </span>
                        </td>
                        <!-- Kolom Barcode Barang -->
                        <td class="py-4 px-4 text-center">
                            <div class="flex flex-col items-center">
                                {!! DNS1D::getBarcodeHTML($item->kode_barang, 'C128') !!}
                                <div class="text-xs font-semibold mt-2">{{ $item->kode_barang }}</div>
                            </div>
                        </td>

                        <td class="py-4 px-4 whitespace-nowrap text-sm">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('stok-barang.show', $item->kode_barang) }}" class="p-2 bg-gray-100 hover:bg-gray-200 rounded-full" title="Lihat Riwayat Transaksi">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="text-center py-10 text-gray-500">Belum ada data untuk ditampilkan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $stokBarangs->links() }}
    </div>
</div>
@endsection
