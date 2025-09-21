@extends('layouts.app')

@section('title', 'Riwayat Stok: ' . $barang->nama_barang)

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Riwayat Stok: {{ $barang->nama_barang }}</h2>
            <p class="mt-1 text-sm text-gray-500">Detail riwayat per batch untuk barang dengan kode: <span class="font-mono">{{ $barang->kode_barang }}</span></p>
        </div>
        <a href="{{ route('stok-barang.index') }}" class="no-print mt-3 sm:mt-0 inline-flex items-center px-4 py-2 bg-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Kembali ke Laporan</a>
    </div>
    
    {{-- BARCODE --}}
    <div class="mb-6 pb-6 border-b border-gray-200">
        <label class="block text-sm font-medium text-gray-700 mb-2">Barcode Barang</label>
        @if($barang->kode_barang)
            <div class="flex flex-col items-start">
                {!! DNS1D::getBarcodeHTML($barang->kode_barang, 'C128', 2, 66) !!}
            </div>
        @endif
    </div>

    {{-- KONTROL PENCARIAN DAN EKSPOR --}}
    <div class="no-print flex flex-col sm:flex-row justify-between items-center mb-4 space-y-2 sm:space-y-0">
        <div class="relative w-full sm:max-w-xs">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" id="searchInput" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Cari riwayat...">
        </div>
        <div class="flex items-center space-x-2">
            <button id="printButton" class="flex items-center text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-3 rounded-lg">Print</button>
            <button id="excelButton" class="flex items-center text-sm bg-green-100 hover:bg-green-200 text-green-700 font-medium py-2 px-3 rounded-lg">Excel</button>
            <button id="pdfButton" class="flex items-center text-sm bg-red-100 hover:bg-red-200 text-red-700 font-medium py-2 px-3 rounded-lg">PDF</button>
            <button id="wordButton" class="flex items-center text-sm bg-blue-100 hover:bg-blue-200 text-blue-700 font-medium py-2 px-3 rounded-lg">Word</button>
        </div>
    </div>

    {{-- TABEL RIWAYAT PER BATCH --}}
    <div class="overflow-x-auto border border-gray-200 rounded-lg">
        <table id="dataTable" class="min-w-full bg-white divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase">Tgl Masuk</th>
                    <th scope="col" class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase">Pemasok</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase">Jumlah Masuk</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase">Jumlah Keluar</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase">Sisa Stok Batch</th>
                </tr>
            </thead>
            <tbody id="tableBody" class="divide-y divide-gray-200">
                @forelse ($detailStok as $batch)
                    <tr>
                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500" data-tgl="{{ $batch->tgl_masuk }}">
                            {{ \Carbon\Carbon::parse($batch->tgl_masuk)->isoFormat('DD MMMM YYYY') }}
                        </td>
                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">{{ $batch->pemasok->nama_pemasok ?? 'N/A' }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-center text-sm text-green-700 font-medium">+ {{ $batch->jumlah_masuk }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-center text-sm text-red-700 font-medium">- {{ $batch->barang_keluar_sum_jumlah_keluar ?? 0 }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-center text-sm text-blue-700 font-semibold">{{ $batch->jumlah_masuk - ($batch->barang_keluar_sum_jumlah_keluar ?? 0) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-10 text-gray-500">Tidak ada riwayat transaksi untuk barang ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection