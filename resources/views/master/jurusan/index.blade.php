@extends('layouts.app')

@section('title', 'Manajemen Jurusan')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Manajemen Jurusan</h2>
            <p class="mt-1 text-sm text-gray-500">Daftar semua jurusan yang tersedia.</p>
        </div>
        @can('manage-masters')
        <a href="{{ route('master.jurusan.create') }}" class="no-print mt-3 sm:mt-0 inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">
            Tambah Jurusan
        </a>
        @endcan
    </div>

    {{-- KONTROL PENCARIAN DAN EKSPOR --}}
    <div class="no-print flex flex-col sm:flex-row justify-between items-center mb-4 space-y-2 sm:space-y-0">
        <div class="relative w-full sm:max-w-xs">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
            </div>
            <input type="text" id="searchInput" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Cari jurusan...">
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
                    <th scope="col" class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase">Nama Jurusan</th>
                    <th scope="col" class="no-print py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody" class="divide-y divide-gray-200">
                @forelse ($jurusans as $jurusan)
                    <tr>
                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-800 font-medium">{{ $jurusan->nama_jurusan }}</td>
                        <td class="no-print py-4 px-4 whitespace-nowrap text-sm">
                            <div class="flex items-center space-x-2">
                                @can('manage-masters')
                                <a href="{{ route('master.jurusan.edit', $jurusan) }}" class="p-2 bg-yellow-100 hover:bg-yellow-200 rounded-full" title="Edit">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L15.232 5.232z"></path></svg>
                                </a>
                                <form action="{{ route('master.jurusan.destroy', $jurusan) }}" method="POST" onsubmit="return confirm('Yakin hapus jurusan ini?');">
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
                    <tr><td colspan="2" class="text-center py-10 text-gray-500">Tidak ada data jurusan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection