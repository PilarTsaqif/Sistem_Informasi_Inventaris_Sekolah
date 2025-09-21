@extends('layouts.app')

@section('title', 'Input Barang Keluar')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Input Barang Keluar</h2>

    <form action="{{ route('barang-keluar.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Tanggal Keluar --}}
            <div>
                <label for="tgl_keluar" class="block text-sm font-medium text-gray-700">Tanggal Keluar <span class="text-red-600">*</span></label>
                <input type="date" name="tgl_keluar" id="tgl_keluar" value="{{ old('tgl_keluar', date('Y-m-d')) }}" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                @error('tgl_keluar') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Batch Barang Masuk --}}
            <div>
                <label for="id_barangmasuk" class="block text-sm font-medium text-gray-700">Ambil Stok Dari Batch <span class="text-red-600">*</span></label>
                <select name="id_barangmasuk" id="id_barangmasuk" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih Batch Barang</option>
                    @foreach($barangMasuks as $batch)
                        <option value="{{ $batch->id }}" {{ old('id_barangmasuk') == $batch->id ? 'selected' : '' }}>
                            {{ $batch->barang->nama_barang }} (Sisa: {{ $batch->sisa_stok }})
                        </option>
                    @endforeach
                </select>
                @error('id_barangmasuk') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Jumlah Keluar --}}
            <div>
                <label for="jumlah_keluar" class="block text-sm font-medium text-gray-700">Jumlah Keluar <span class="text-red-600">*</span></label>
                <input type="number" name="jumlah_keluar" id="jumlah_keluar" value="{{ old('jumlah_keluar') }}" min="1" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                @error('jumlah_keluar') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            
            {{-- Customer --}}
            <div>
                <label for="customer" class="block text-sm font-medium text-gray-700">Customer / Penerima <span class="text-red-600">*</span></label>
                <input type="text" name="customer" id="customer" value="{{ old('customer') }}" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                @error('customer') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            
            {{-- No. Telepon --}}
            <div class="md:col-span-2">
                <label for="no_telp" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp') }}"
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Alamat --}}
            <div class="md:col-span-2">
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3"
                      class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">{{ old('alamat') }}</textarea>
            </div>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('barang-keluar.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Batal</a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection