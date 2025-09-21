@extends('layouts.app')
@section('title', 'Detail Pengembalian')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-start">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Detail Pengembalian</h2>
            <p class="text-sm text-gray-500 font-mono">{{ $pengembalian->kode_pengembalian }}</p>
        </div>
    </div>
    <div class="mt-6 border-t pt-6">
        <dl class="space-y-4">
            <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Tanggal Kembali</dt><dd class="col-span-2">{{ $pengembalian->tanggal_pengembalian->format('d F Y') }}</dd></div>
            <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Kondisi Kembali</dt><dd class="col-span-2">{{ $pengembalian->kondisi }}</dd></div>
            <div class="pt-4 border-t mt-4">
                <p class="text-base font-medium text-gray-800 mb-4">Detail Peminjaman Terkait</p>
                <div class="grid grid-cols-3 gap-4"><dt class="font-medium text-gray-500">Kode Pinjam</dt><dd class="col-span-2 font-mono text-sm">{{ $pengembalian->peminjaman->kode_peminjaman ?? 'N/A' }}</dd></div>
                <div class="grid grid-cols-3 gap-4 mt-4"><dt class="font-medium text-gray-500">Nama Peminjam</dt><dd class="col-span-2 font-semibold">{{ $pengembalian->nama_peminjam }}</dd></div>
                <div class="grid grid-cols-3 gap-4 mt-4"><dt class="font-medium text-gray-500">Nama Barang</dt><dd class="col-span-2">{{ $pengembalian->peminjaman->barang->nama_barang ?? 'N/A' }}</dd></div>
                <div class="grid grid-cols-3 gap-4 mt-4"><dt class="font-medium text-gray-500">Jumlah</dt><dd class="col-span-2">{{ $pengembalian->peminjaman->jumlah ?? 'N/A' }} {{ $pengembalian->peminjaman->satuan->nama_satuan ?? '' }}</dd></div>
            </div>
        </dl>
    </div>
    <div class="mt-8 text-left"><a href="{{ route('pengembalian.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">&larr; Kembali ke Daftar</a></div>
</div>
@endsection