@extends('layouts.app')

@section('title', 'Detail Ruangan: ' . $ruangan->nama_ruangan)

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $ruangan->nama_ruangan }}</h2>
            <p class="mt-1 text-sm text-gray-500">Detail untuk ruangan dengan kode: <span class="font-mono">{{ $ruangan->kode_ruangan }}</span></p>
        </div>
        <div class="mt-3 sm:mt-0 flex space-x-2">
            <a href="{{ route('master.ruangan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Kembali</a>
            @can('manage-masters')
            <a href="{{ route('master.ruangan.edit', $ruangan) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 rounded-md font-semibold text-xs text-white uppercase hover:bg-yellow-600">Edit Ruangan</a>
            @endcan
        </div>
    </div>
    
    {{-- DETAIL DATA RUANGAN --}}
    <div class="border-t border-gray-200">
        <dl class="divide-y divide-gray-200">
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Nama Ruangan</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $ruangan->nama_ruangan }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Jurusan</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $ruangan->jurusan->nama_jurusan ?? 'Umum' }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Kode RPS</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $ruangan->kode_rps ?? 'Tidak ada' }}</dd>
            </div>
        </dl>
    </div>

    {{-- DAFTAR FASILITAS DALAM RUANGAN --}}
    <div class="mt-8">
        <div class="flex justify-between items-center mb-4">
             <h3 class="text-lg font-semibold text-gray-800">Daftar Fasilitas di Dalam Ruangan</h3>
             <a href="{{ route('fasilitas.index', $ruangan) }}" class="text-sm text-blue-600 hover:text-blue-800 font-semibold">Lihat & Kelola Fasilitas &rarr;</a>
        </div>
       
        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase">Kode Barang</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold text-gray-500 uppercase">Nama Barang</th>
                        <th class="py-3 px-4 text-center text-xs font-semibold text-gray-500 uppercase">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($ruangan->barangs as $barang)
                    <tr>
                        <td class="py-3 px-4 whitespace-nowrap text-sm font-mono text-gray-500">{{ $barang->kode_barang }}</td>
                        <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-800">{{ $barang->nama_barang }}</td>
                        <td class="py-3 px-4 whitespace-nowrap text-center text-sm text-gray-800 font-medium">{{ $barang->pivot->jumlah }} {{ $barang->satuan->nama_satuan }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-6 text-gray-500">Belum ada fasilitas di ruangan ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection