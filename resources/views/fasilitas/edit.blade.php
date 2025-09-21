@extends('layouts.app')

@section('title', 'Edit Jumlah Fasilitas')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-lg mx-auto">
    <h2 class="text-2xl font-bold text-gray-800">Edit Jumlah Fasilitas</h2>
    <p class="text-sm text-gray-500 mb-6">Di Ruangan: <span class="font-semibold">{{ $ruangan->nama_ruangan }}</span></p>

    <form action="{{ route('fasilitas.update', [$ruangan, $fasilitas]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-6">
            {{-- Barang --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Barang</label>
                <p class="mt-1 text-lg font-semibold text-gray-900">{{ $fasilitas->nama_barang }}</p>
                <p class="text-xs text-gray-500 font-mono">{{ $fasilitas->kode_barang }}</p>
            </div>

            {{-- Jumlah --}}
            <div>
                <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah <span class="text-red-600">*</span></label>
                <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $fasilitas->pivot->jumlah) }}" min="1" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                @error('jumlah') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('fasilitas.index', $ruangan) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Batal</a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection