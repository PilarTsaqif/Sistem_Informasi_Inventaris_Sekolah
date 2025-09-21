@extends('layouts.app')
@section('title', 'Detail Peminjaman')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-start">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Detail Peminjaman</h2>
            <p class="text-sm text-gray-500 font-mono">{{ $peminjaman->kode_peminjaman }}</p>
        </div>
        @canany(['is-toolman', 'is-guru']) @if (!$peminjaman->pengembalian)
            <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="flex items-center text-sm px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md" title="Edit"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>Edit</a>
        @endif @endcanany
    </div>
    <div class="mt-6 border-t pt-6"><dl class="space-y-4">
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Nama Peminjam</dt><dd class="col-span-2 font-semibold">{{ $peminjaman->nama_peminjam }}</dd></div>
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Tgl Pinjam</dt><dd class="col-span-2">{{ $peminjaman->tanggal_peminjaman->format('d F Y') }}</dd></div>
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Lama Pinjam</dt><dd class="col-span-2">{{ $peminjaman->lama_peminjaman }}</dd></div>
        <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Status</dt><dd class="col-span-2">@if ($peminjaman->pengembalian)<span class="px-2 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">Sudah Kembali</span>@else<span class="px-2 inline-flex text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Dipinjam</span>@endif</dd></div>
        <div class="pt-4 border-t mt-4">
            <p class="text-base font-medium text-gray-800 mb-4">Detail Barang</p>
            <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Kode Barang</dt><dd class="col-span-2 font-mono text-sm">{{ $peminjaman->barang->kode_barang ?? 'N/A' }}</dd></div>
            <div class="grid grid-cols-3 gap-4 mt-4"><dt class="font-medium text-gray-500">Nama Barang</dt><dd class="col-span-2 font-semibold">{{ $peminjaman->barang->nama_barang ?? 'N/A' }}</dd></div>
            <div class="grid grid-cols-3 gap-4 mt-4"><dt class="font-medium text-gray-500">Kategori</dt><dd class="col-span-2">{{ $peminjaman->barang->kategoriBarang->nama_kategori ?? 'N/A' }}</dd></div>
            <div class="grid grid-cols-3 gap-4 mt-4"><dt class="font-medium text-gray-500">Jumlah</dt><dd class="col-span-2">{{ $peminjaman->jumlah }} {{ $peminjaman->satuan->nama_satuan ?? '' }}</dd></div>
            <div class="grid grid-cols-3 gap-4 mt-4"><dt class="font-medium text-gray-500">Kondisi Awal</dt><dd class="col-span-2">{{ $peminjaman->kondisi }}</dd></div>
        </div>
    </dl></div>
    <div class="mt-8 text-left"><a href="{{ route('peminjaman.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">&larr; Kembali ke Daftar</a></div>
</div>
@endsection