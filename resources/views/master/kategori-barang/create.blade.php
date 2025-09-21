@extends('layouts.app')

@section('title', 'Tambah Kategori Baru')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-lg mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Tambah Kategori</h2>
    <form action="{{ route('master.kategori-barang.store') }}" method="POST">
        @csrf
        <div>
            <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori <span class="text-red-600">*</span></label>
            <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}" required 
                   class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            @error('nama_kategori') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>
        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('master.kategori-barang.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Batal</a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection