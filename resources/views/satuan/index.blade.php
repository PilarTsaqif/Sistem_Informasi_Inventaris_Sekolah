@extends('layouts.app')
@section('title', 'Manajemen Satuan Barang')
@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Manajemen Satuan Barang</h2>
            <p class="mt-1 text-sm text-gray-500">Daftar semua satuan unit yang tersedia.</p>
        </div>
        @can('is-toolman')
            <a href="{{ route('satuan.create') }}" class="flex items-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md mt-4 sm:mt-0">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Satuan
            </a>
        @endcan
    </div>

    @if(session('success'))<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert"><p>{{ session('success') }}</p></div>@endif
    @if(session('error'))<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert"><p>{{ session('error') }}</p></div>@endif

    {{-- KONTROL PENCARIAN DAN EKSPOR DITAMBAHKAN --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 space-y-2 sm:space-y-0">
        <div class="relative w-full sm:max-w-xs">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
            </div>
            <input type="text" id="searchInput" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Cari satuan...">
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
                    <th scope="col" class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">ID</th>
                    <th scope="col" class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Nama Satuan</th>
                    <th scope="col" class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Digunakan di (Barang)</th>
                    <th scope="col" class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            {{-- ID DITAMBAHKAN --}}
            <tbody id="tableBody" class="divide-y divide-gray-200">
                @forelse ($satuans as $item)
                    <tr>
                        <td class="py-4 px-4 text-sm text-gray-500 whitespace-nowrap">{{ $item->id }}</td>
                        {{-- PERBAIKAN: Menghapus font-medium --}}
                        <td class="py-4 px-4 text-sm text-gray-800 whitespace-nowrap">{{ $item->nama_satuan }}</td>
                        <td class="py-4 px-4 text-center text-sm text-gray-800 whitespace-nowrap">{{ $item->barangs_count }} kali</td>
                        <td class="py-4 px-4 whitespace-nowrap">
                            <div class="flex items-center space-x-2">
                                @can('is-toolman')
                                    <a href="{{ route('satuan.edit', $item->id) }}" class="p-2 bg-blue-100 hover:bg-blue-200 rounded-full" title="Edit">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form action="{{ route('satuan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus satuan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-100 hover:bg-red-200 rounded-full" title="Hapus">
                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-10 text-gray-500">Belum ada data satuan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $satuans->links() }}
    </div>
</div>
@endsection