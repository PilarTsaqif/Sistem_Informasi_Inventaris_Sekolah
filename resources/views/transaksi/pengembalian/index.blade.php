@extends('layouts.app')

@section('title', 'Riwayat Pengembalian')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Riwayat Pengembalian Barang</h2>
            <p class="mt-1 text-sm text-gray-500">Daftar semua barang yang telah dikembalikan oleh peminjam.</p>
        </div>
        @can('manage-transactions')
        <a href="{{ route('pengembalian.create') }}" class="no-print mt-3 sm:mt-0 inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">
            Proses Pengembalian
        </a>
        @endcan
    </div>

    {{-- KONTROL PENCARIAN DAN EKSPOR --}}
    <div class="no-print flex flex-col sm:flex-row justify-between items-center mb-4 space-y-2 sm:space-y-0">
        <div class="relative w-full sm:max-w-xs">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
            </div>
            <input type="text" id="searchInput" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Cari data...">
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
                    <th scope="col" class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase">Tgl Kembali</th>
                    <th scope="col" class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase">Peminjam</th>
                    <th scope="col" class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase">Barang</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase">Kondisi</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase">Barcode</th>
                    <th scope="col" class="no-print py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody" class="divide-y divide-gray-200">
                @forelse ($pengembalians as $item)
                    <tr>
                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500" data-tgl="{{ $item->tanggal_pengembalian }}">
                           <div>{{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->isoFormat('DD MMM YYYY') }}</div>
                           <div class="text-xs text-gray-400 font-mono">{{ $item->kode_pengembalian }}</div>
                        </td>
                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-800 font-medium">{{ $item->nama_peminjam }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">{{ $item->peminjaman->barang->nama_barang }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-center text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->kondisi == 'Baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $item->kondisi }}
                            </span>
                        </td>
                        <td class="py-4 px-4 whitespace-nowrap text-center">
                             @if($item->peminjaman->barang->kode_barang)
                                <div class="flex flex-col items-center">
                                    {!! DNS1D::getBarcodeHTML($item->peminjaman->barang->kode_barang, 'C128', 1, 33) !!}
                                </div>
                            @endif
                        </td>
                        <td class="no-print py-4 px-4 whitespace-nowrap text-sm">
                            <a href="{{ route('peminjaman.show', $item->id_peminjaman) }}" class="p-2 bg-gray-100 hover:bg-gray-200 rounded-full" title="Lihat Detail Peminjaman">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-10 text-gray-500">Belum ada riwayat pengembalian.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection