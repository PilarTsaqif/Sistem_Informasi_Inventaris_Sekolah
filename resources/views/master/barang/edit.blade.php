@extends('layouts.app')

@section('title', 'Edit Data Barang')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Edit Data Barang</h2>

    <form action="{{ route('master.barang.update', $barang) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-6">
            {{-- Kode Barang (Read Only) --}}
            <div>
                <label for="kode_barang" class="block text-sm font-medium text-gray-700">Kode Barang</label>
                <input type="text" value="{{ $barang->kode_barang }}" readonly
                       class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>

            {{-- Nama Barang --}}
            <div>
                <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang <span class="text-red-600">*</span></label>
                <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('nama_barang') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Kategori Barang --}}
            <div>
                <label for="kategori_barang_id" class="block text-sm font-medium text-gray-700">Kategori Barang</label>
                <select name="kategori_barang_id" id="kategori_barang_id"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_barang_id', $barang->kategori_barang_id) == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Satuan Barang --}}
            <div>
                <label for="id_satuanbarang" class="block text-sm font-medium text-gray-700">Satuan <span class="text-red-600">*</span></label>
                <select name="id_satuanbarang" id="id_satuanbarang" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Pilih Satuan</option>
                    @foreach($satuans as $satuan)
                        <option value="{{ $satuan->id }}" {{ old('id_satuanbarang', $barang->id_satuanbarang) == $satuan->id ? 'selected' : '' }}>{{ $satuan->nama_satuan }}</option>
                    @endforeach
                </select>
                @error('id_satuanbarang') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('master.barang.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Batal</a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection