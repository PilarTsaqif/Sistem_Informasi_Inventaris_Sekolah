@extends('layouts.app')

@section('title', 'Detail Barang: ' . $barang->nama_barang)

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $barang->nama_barang }}</h2>
            <p class="mt-1 text-sm text-gray-500">Detail lengkap untuk barang dengan kode: {{ $barang->kode_barang }}</p>
        </div>
        <div class="mt-3 sm:mt-0 flex space-x-2">
            <a href="{{ route('master.barang.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Kembali</a>
            @can('manage-masters')
            <a href="{{ route('master.barang.edit', $barang) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 rounded-md font-semibold text-xs text-white uppercase hover:bg-yellow-600">Edit</a>
            @endcan
        </div>
    </div>
    
    {{-- DETAIL DATA --}}
    <div class="border-t border-gray-200">
        <dl class="divide-y divide-gray-200">
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Kode Barang</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-mono">{{ $barang->kode_barang }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Nama Barang</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $barang->nama_barang }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $barang->kategori->nama_kategori ?? 'Tidak ada kategori' }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Satuan</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $barang->satuan->nama_satuan ?? 'Tidak ada satuan' }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Barcode</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    @if($barang->kode_barang)
                        <div class="flex flex-col items-start">
                            {!! DNS1D::getBarcodeHTML($barang->kode_barang, 'C128', 2, 66) !!}
                        </div>
                    @endif
                </dd>
            </div>
        </dl>
    </div>
</div>
@endsection