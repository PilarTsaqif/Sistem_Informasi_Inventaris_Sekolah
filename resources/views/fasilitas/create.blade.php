@extends('layouts.app')

@section('title', 'Tambah Fasilitas ke Ruangan')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-lg mx-auto">
    <h2 class="text-2xl font-bold text-gray-800">Tambah Fasilitas</h2>
    <p class="text-sm text-gray-500 mb-6">ke Ruangan: <span class="font-semibold">{{ $ruangan->nama_ruangan }}</span></p>

    <form action="{{ route('fasilitas.store', $ruangan) }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 gap-6">
            {{-- Barang --}}
            <div>
                <label for="kode_barang" class="block text-sm font-medium text-gray-700">Pilih Barang <span class="text-red-600">*</span></label>
                <select name="kode_barang" id="kode_barang" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih barang yang akan ditambahkan</option>
                    @foreach($barangTersedia as $barang)
                        <option value="{{ $barang->kode_barang }}" {{ old('kode_barang') == $barang->kode_barang ? 'selected' : '' }}>
                            {{ $barang->nama_barang }} ({{ $barang->kode_barang }})
                        </option>
                    @endforeach
                </select>
                @error('kode_barang') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Jumlah --}}
            <div>
                <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah <span class="text-red-600">*</span></label>
                <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', 1) }}" min="1" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                @error('jumlah') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('fasilitas.index', $ruangan) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Batal</a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection