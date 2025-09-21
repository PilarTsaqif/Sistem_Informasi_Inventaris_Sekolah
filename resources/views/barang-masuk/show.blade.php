@extends('layouts.app')
@section('title', 'Detail Barang Masuk')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-start">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Detail Catatan #{{ $barangMasuk->id }}</h2>
            <p class="text-sm text-gray-500">Dicatat pada {{ $barangMasuk->created_at->format('d M Y, H:i') }} oleh {{ $barangMasuk->user->name ?? 'N/A' }}</p>
        </div>
        @can('is-toolman')<a href="{{ route('barang-masuk.edit', $barangMasuk->id) }}" class="flex items-center text-sm px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md" title="Edit"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>Edit</a>@endcan
    </div>
    <div class="mt-6 border-t pt-6"><dl class="space-y-4">
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Tanggal Masuk</dt><dd class="col-span-2">{{ $barangMasuk->tgl_masuk->format('d F Y') }}</dd></div>
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Nama Barang</dt><dd class="col-span-2 font-semibold">{{ $barangMasuk->barang->nama_barang ?? 'N/A' }}</dd></div>
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Kategori</dt><dd class="col-span-2">{{ $barangMasuk->barang->kategoriBarang->nama_kategori ?? 'N/A' }}</dd></div>
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Jumlah</dt><dd class="col-span-2">{{ $barangMasuk->jumlah_masuk }} {{ $barangMasuk->satuan->nama_satuan ?? '' }}</dd></div>
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Kondisi</dt><dd class="col-span-2">{{ $barangMasuk->kondisi }}</dd></div>
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Pemasok</dt><dd class="col-span-2">{{ $barangMasuk->pemasok->nama_pemasok ?? 'N/A' }}</dd></div>
        @if($barangMasuk->tgl_expired)<div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Tgl Expired</dt><dd class="col-span-2 text-red-600">{{ $barangMasuk->tgl_expired->format('d F Y') }}</dd></div>@endif
    </dl></div>
    <div class="mt-8 text-left"><a href="{{ route('barang-masuk.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">&larr; Kembali ke Riwayat</a></div>
</div>
@endsection