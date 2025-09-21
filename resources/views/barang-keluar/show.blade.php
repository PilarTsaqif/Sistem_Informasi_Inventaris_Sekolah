@extends('layouts.app')
@section('title', 'Detail Barang Keluar')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-start">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Detail Transaksi</h2>
            <p class="text-sm text-gray-500 font-mono">{{ $barangKeluar->uid_barangkeluar }}</p>
        </div>
        @can('is-toolman')<a href="{{ route('barang-keluar.edit', $barangKeluar->id) }}" class="flex items-center text-sm px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md" title="Edit"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>Edit</a>@endcan
    </div>
    <div class="mt-6 border-t pt-6"><dl class="space-y-4">
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Tgl Keluar</dt><dd class="col-span-2">{{ $barangKeluar->tgl_keluar->format('d F Y') }}</dd></div>
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Nama Barang</dt><dd class="col-span-2 font-semibold">{{ $barangKeluar->barangMasuk->barang->nama_barang ?? 'N/A' }}</dd></div>
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Kategori</dt><dd class="col-span-2">{{ $barangKeluar->barangMasuk->barang->kategoriBarang->nama_kategori ?? 'N/A' }}</dd></div>
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Kondisi Barang</dt><dd class="col-span-2">{{ $barangKeluar->barangMasuk->kondisi }}</dd></div>
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Jumlah Keluar</dt><dd class="col-span-2">{{ $barangKeluar->jumlah_keluar }} {{ $barangKeluar->barangMasuk->satuan->nama_satuan ?? '' }}</dd></div>
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Dicatat oleh</dt><dd class="col-span-2">{{ $barangKeluar->user->name ?? 'N/A' }}</dd></div>
        <div class="pt-4 border-t mt-4">
            <p class="text-base font-medium text-gray-800 mb-4">Data Customer</p>
            <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Nama</dt><dd class="col-span-2">{{ $barangKeluar->customer }}</dd></div>
            <div class="grid grid-cols-3 gap-4 mt-4"><dt class="font-medium text-gray-500">No. Telepon</dt><dd class="col-span-2">{{ $barangKeluar->no_telp }}</dd></div>
            <div class="grid grid-cols-3 gap-4 mt-4"><dt class="font-medium text-gray-500">Alamat</dt><dd class="col-span-2 whitespace-pre-line">{{ $barangKeluar->alamat }}</dd></div>
        </div>
    </dl></div>
    <div class="mt-8 text-left"><a href="{{ route('barang-keluar.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">&larr; Kembali ke Riwayat</a></div>
</div>
@endsection