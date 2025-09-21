@extends('layouts.app')

@section('title', 'Edit Data Peminjaman')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Edit Peminjaman Barang</h2>

    <form action="{{ route('peminjaman.update', $peminjaman) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <p class="text-sm text-gray-600">Kode Peminjaman: <span class="font-medium text-gray-900 font-mono">{{ $peminjaman->kode_peminjaman }}</span></p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Peminjam --}}
            <div>
                <label for="nama_peminjam" class="block text-sm font-medium text-gray-700">Nama Peminjam <span class="text-red-600">*</span></label>
                <input type="text" name="nama_peminjam" id="nama_peminjam" value="{{ old('nama_peminjam', $peminjaman->nama_peminjam) }}" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Barang yang Dipinjam --}}
            <div>
                <label for="kode_barang" class="block text-sm font-medium text-gray-700">Barang <span class="text-red-600">*</span></label>
                <select name="kode_barang" id="kode_barang" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih Barang</option>
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->kode_barang }}" {{ old('kode_barang', $peminjaman->kode_barang) == $barang->kode_barang ? 'selected' : '' }}>
                            {{ $barang->nama_barang }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            {{-- Tanggal Peminjaman --}}
            <div>
                <label for="tanggal_peminjaman" class="block text-sm font-medium text-gray-700">Tanggal Peminjaman <span class="text-red-600">*</span></label>
                <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" value="{{ old('tanggal_peminjaman', $peminjaman->tanggal_peminjaman) }}" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Lama Peminjaman --}}
            <div>
                <label for="lama_peminjaman" class="block text-sm font-medium text-gray-700">Lama Peminjaman <span class="text-red-600">*</span></label>
                <input type="text" name="lama_peminjaman" id="lama_peminjaman" value="{{ old('lama_peminjaman', $peminjaman->lama_peminjaman) }}" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Jumlah --}}
            <div>
                <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah <span class="text-red-600">*</span></label>
                <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $peminjaman->jumlah) }}" min="1" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Kondisi Saat Dipinjam --}}
            <div>
                <label for="kondisi" class="block text-sm font-medium text-gray-700">Kondisi Awal <span class="text-red-600">*</span></label>
                <select name="kondisi" id="kondisi" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                    <option value="Baik" {{ old('kondisi', $peminjaman->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak" {{ old('kondisi', $peminjaman->kondisi) == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                </select>
            </div>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('peminjaman.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Batal</a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection