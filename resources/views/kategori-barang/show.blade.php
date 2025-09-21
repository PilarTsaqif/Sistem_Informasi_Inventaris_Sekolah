@extends('layouts.app')
@section('title', 'Detail Kategori')
@section('content')
<div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-start">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $kategoriBarang->nama_kategori }}</h2>
            <p class="text-sm text-gray-500">Detail untuk ID #{{ $kategoriBarang->id }}</p>
        </div>
        @can('is-toolman')
            <a href="{{ route('kategori-barang.edit', $kategoriBarang->id) }}" class="flex items-center text-sm px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md" title="Edit">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                Edit
            </a>
        @endcan
    </div>
    <div class="mt-6 border-t pt-6"><dl>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <dt class="text-sm font-medium text-gray-500">Nama Kategori</dt>
            <dd class="mt-1 text-sm font-bold text-gray-900 sm:mt-0 sm:col-span-2">{{ $kategoriBarang->nama_kategori }}</dd>
        </div>
    </dl></div>
    <div class="mt-8 text-left"><a href="{{ route('kategori-barang.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">&larr; Kembali ke Daftar</a></div>
</div>
@endsection