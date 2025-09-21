@extends('layouts.app')

@section('title', 'Proses Pengembalian Barang')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Pengembalian Barang</h2>

    <form action="{{ route('pengembalian.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 gap-6">
            {{-- Transaksi Peminjaman --}}
            <div>
                <label for="id_peminjaman" class="block text-sm font-medium text-gray-700">Transaksi Peminjaman <span class="text-red-600">*</span></label>
                <select name="id_peminjaman" id="id_peminjaman" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih Transaksi Peminjaman</option>
                    @foreach($peminjamans as $peminjaman)
                        <option value="{{ $peminjaman->id }}" {{ (request()->query('peminjaman_id') ?? old('id_peminjaman')) == $peminjaman->id ? 'selected' : '' }}>
                            {{ $peminjaman->kode_peminjaman }} - {{ $peminjaman->nama_peminjam }} - {{ $peminjaman->barang->nama_barang }}
                        </option>
                    @endforeach
                </select>
                @error('id_peminjaman') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Tanggal Pengembalian --}}
            <div>
                <label for="tanggal_pengembalian" class="block text-sm font-medium text-gray-700">Tanggal Pengembalian <span class="text-red-600">*</span></label>
                <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" value="{{ old('tanggal_pengembalian', date('Y-m-d')) }}" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                @error('tanggal_pengembalian') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            
            {{-- Kondisi Saat Kembali --}}
            <div>
                <label for="kondisi" class="block text-sm font-medium text-gray-700">Kondisi Saat Kembali <span class="text-red-600">*</span></label>
                <select name="kondisi" id="kondisi" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                    <option value="Baik" {{ old('kondisi', 'Baik') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak" {{ old('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                </select>
                 @error('kondisi') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('pengembalian.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Batal</a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">Simpan Pengembalian</button>
        </div>
    </form>
</div>
@endsection