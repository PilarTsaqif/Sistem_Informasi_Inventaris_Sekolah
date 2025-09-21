@extends('layouts.app')
@section('title', 'Catat Pengembalian')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
    {{-- HEADER FORM --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Formulir Pengembalian Barang</h2>
        <a href="{{ route('pengembalian.index') }}" class="text-sm text-gray-600 hover:text-blue-500">
            &larr; Kembali ke Daftar Pengembalian
        </a>
    </div>

    {{-- MENAMPILKAN ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p class="font-bold">Terjadi Kesalahan:</p>
            <ul class="list-disc list-inside mt-2 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORMULIR UTAMA DENGAN ALPINE.JS --}}
    <form action="{{ route('pengembalian.store') }}" method="POST" class="space-y-6" 
          x-data="{
              peminjamans: {{ json_encode($peminjamans) }}, 
              selectedPeminjamanId: '{{ old('id_peminjaman') }}', 
              selectedPeminjaman: {}
          }" 
          x-init="
              selectedPeminjaman = peminjamans.find(p => p.id == selectedPeminjamanId) || {}
          ">
        @csrf
        
        {{-- PILIH DATA PEMINJAMAN --}}
        <div>
            <label for="id_peminjaman" class="block text-sm font-medium text-gray-700 mb-1">Pilih Data Peminjaman</label>
            <select name="id_peminjaman" id="id_peminjaman" x-model="selectedPeminjamanId" 
                    @change="selectedPeminjaman = peminjamans.find(p => p.id == selectedPeminjamanId) || {}" 
                    required 
                    class="block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <option value="" disabled>-- Pilih Kode Pinjam / Peminjam --</option>
                @foreach($peminjamans as $item)
                    <option value="{{ $item->id }}">{{ $item->kode_peminjaman }} - {{ $item->nama_peminjam }} ({{ $item->barang->nama_barang }})</option>
                @endforeach
            </select>
        </div>

        {{-- DETAIL PEMINJAMAN (MUNCUL SETELAH DIPILIH) --}}
        <template x-if="selectedPeminjamanId && selectedPeminjaman.id">
            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 text-sm space-y-1">
                <h4 class="font-semibold text-gray-800 mb-2">Detail Peminjaman Terpilih:</h4>
                <p><strong>Kode Barang:</strong> <span x-text="selectedPeminjaman.barang ? selectedPeminjaman.barang.kode_barang : 'N/A'"></span></p>
                <p><strong>Nama Peminjam:</strong> <span x-text="selectedPeminjaman.nama_peminjam"></span></p>
                <p><strong>Jumlah Dipinjam:</strong> <span x-text="selectedPeminjaman.jumlah + ' ' + (selectedPeminjaman.satuan ? selectedPeminjaman.satuan.nama_satuan : '')"></span></p>
            </div>
        </template>
        
        {{-- TANGGAL PENGEMBALIAN --}}
        <div>
            <label for="tanggal_pengembalian" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengembalian</label>
            <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" value="{{ old('tanggal_pengembalian', date('Y-m-d')) }}" required 
                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>

        {{-- KONDISI BARANG --}}
        <div>
            <label for="kondisi" class="block text-sm font-medium text-gray-700 mb-1">Kondisi Barang Saat Dikembalikan</label>
            <select name="kondisi" id="kondisi" required 
                    class="block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                <option value="Rusak" {{ old('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
            </select>
        </div>
        
        {{-- TOMBOL SUBMIT --}}
        <div class="flex justify-end pt-4 border-t">
            <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Simpan Pengembalian
            </button>
        </div>
    </form>
</div>
@endsection
