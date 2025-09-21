@extends('layouts.app')

@section('title', 'Input Peminjaman Barang')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Peminjaman Barang</h2>

    {{-- Notifikasi Error Stok --}}
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Gagal!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Peminjam --}}
            <div>
                <label for="nama_peminjam" class="block text-sm font-medium text-gray-700">Nama Peminjam <span class="text-red-600">*</span></label>
                <input type="text" name="nama_peminjam" id="nama_peminjam" value="{{ old('nama_peminjam') }}" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                @error('nama_peminjam') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Barang yang Dipinjam --}}
            <div>
                <label for="kode_barang" class="block text-sm font-medium text-gray-700">Barang <span class="text-red-600">*</span></label>
                <select name="kode_barang" id="kode_barang" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih Barang</option>
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->kode_barang }}" {{ old('kode_barang') == $barang->kode_barang ? 'selected' : '' }}>
                            {{ $barang->nama_barang }} (Stok: {{ $barang->stok_akhir }})
                        </option>
                    @endforeach
                </select>
                @error('kode_barang') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            
            {{-- Tanggal Peminjaman --}}
            <div>
                <label for="tanggal_peminjaman" class="block text-sm font-medium text-gray-700">Tanggal Peminjaman <span class="text-red-600">*</span></label>
                <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" value="{{ old('tanggal_peminjaman', date('Y-m-d')) }}" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                @error('tanggal_peminjaman') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Lama Peminjaman --}}
            <div>
                <label for="lama_peminjaman" class="block text-sm font-medium text-gray-700">Lama Peminjaman <span class="text-red-600">*</span></label>
                <input type="text" name="lama_peminjaman" id="lama_peminjaman" value="{{ old('lama_peminjaman') }}" placeholder="Contoh: 3 Hari" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                @error('lama_peminjaman') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Jumlah --}}
            <div>
                <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah <span class="text-red-600">*</span></label>
                <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" min="1" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                @error('jumlah') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Kondisi Saat Dipinjam --}}
            <div>
                <label for="kondisi" class="block text-sm font-medium text-gray-700">Kondisi Awal <span class="text-red-600">*</span></label>
                <select name="kondisi" id="kondisi" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                    <option value="Baik" {{ old('kondisi', 'Baik') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak" {{ old('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                </select>
            </div>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('peminjaman.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Batal</a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection