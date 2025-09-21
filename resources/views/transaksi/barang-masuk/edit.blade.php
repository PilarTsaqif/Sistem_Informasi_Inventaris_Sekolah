@extends('layouts.app')

@section('title', 'Edit Data Barang Masuk')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Edit Data Barang Masuk</h2>

    <form action="{{ route('barang-masuk.update', $barangMasuk) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Tanggal Masuk --}}
            <div>
                <label for="tgl_masuk" class="block text-sm font-medium text-gray-700">Tanggal Masuk <span class="text-red-600">*</span></label>
                <input type="date" name="tgl_masuk" id="tgl_masuk" value="{{ old('tgl_masuk', $barangMasuk->tgl_masuk) }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Barang --}}
            <div>
                <label for="kode_barang" class="block text-sm font-medium text-gray-700">Barang <span class="text-red-600">*</span></label>
                <select name="kode_barang" id="kode_barang" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih Barang</option>
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->kode_barang }}" {{ old('kode_barang', $barangMasuk->kode_barang) == $barang->kode_barang ? 'selected' : '' }}>
                            {{ $barang->kode_barang }} - {{ $barang->nama_barang }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Jumlah Masuk --}}
            <div>
                <label for="jumlah_masuk" class="block text-sm font-medium text-gray-700">Jumlah Masuk <span class="text-red-600">*</span></label>
                <input type="number" name="jumlah_masuk" id="jumlah_masuk" value="{{ old('jumlah_masuk', $barangMasuk->jumlah_masuk) }}" min="1" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
            </div>
            
            {{-- Pemasok --}}
            <div>
                <label for="pemasok_id" class="block text-sm font-medium text-gray-700">Pemasok</label>
                <select name="pemasok_id" id="pemasok_id" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih Pemasok</option>
                    @foreach($pemasoks as $pemasok)
                        <option value="{{ $pemasok->id }}" {{ old('pemasok_id', $barangMasuk->pemasok_id) == $pemasok->id ? 'selected' : '' }}>{{ $pemasok->nama_pemasok }}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- Stok Minimal --}}
            <div>
                <label for="stok_minimal" class="block text-sm font-medium text-gray-700">Stok Peringatan <span class="text-red-600">*</span></label>
                <input type="number" name="stok_minimal" id="stok_minimal" value="{{ old('stok_minimal', $barangMasuk->stok_minimal) }}" min="0" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
            </div>
            
            {{-- Kondisi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Kondisi Barang <span class="text-red-600">*</span></label>
                <div class="mt-2 flex space-x-4">
                    <label class="inline-flex items-center"><input type="radio" name="kondisi" value="Baik" class="form-radio" {{ old('kondisi', $barangMasuk->kondisi) == 'Baik' ? 'checked' : '' }}><span class="ml-2">Baik</span></label>
                    <label class="inline-flex items-center"><input type="radio" name="kondisi" value="Rusak" class="form-radio" {{ old('kondisi', $barangMasuk->kondisi) == 'Rusak' ? 'checked' : '' }}><span class="ml-2">Rusak</span></label>
                </div>
            </div>

            {{-- Info Maintenance --}}
            <div class="md:col-span-2">
                <label for="info_maintenance" class="block text-sm font-medium text-gray-700">Informasi Maintenance (Opsional)</label>
                <textarea name="info_maintenance" id="info_maintenance" rows="3" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">{{ old('info_maintenance', $barangMasuk->info_maintenance) }}</textarea>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('barang-masuk.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Batal</a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection