@extends('layouts.app')

@section('title', 'Detail Pengembalian')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Detail Pengembalian Barang</h2>
            <p class="mt-1 text-sm text-gray-500">Kode Transaksi: <span class="font-mono">{{ $pengembalian->kode_pengembalian }}</span></p>
        </div>
        <div class="mt-3 sm:mt-0 flex space-x-2">
            <a href="{{ route('pengembalian.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Kembali</a>
            <a href="{{ route('peminjaman.show', $pengembalian->id_peminjaman) }}" class="inline-flex items-center px-4 py-2 bg-blue-100 rounded-md font-semibold text-xs text-blue-700 uppercase hover:bg-blue-200">Lihat Peminjaman</a>
        </div>
    </div>
    
    {{-- DETAIL DATA --}}
    <div class="border-t border-gray-200">
        <dl class="divide-y divide-gray-200">
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Tanggal Pengembalian</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->isoFormat('DD MMMM YYYY') }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Nama Peminjam</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $pengembalian->nama_peminjam }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Nama Barang</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $pengembalian->peminjaman->barang->nama_barang }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Kode Barang</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-mono">{{ $pengembalian->kode_barang }}</dd>
            </div>
             <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Jumlah yang Dikembalikan</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $pengembalian->peminjaman->jumlah }} {{ $pengembalian->peminjaman->satuan->nama_satuan }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Kondisi Saat Kembali</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $pengembalian->kondisi == 'Baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $pengembalian->kondisi }}
                    </span>
                </dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Barcode Barang</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    @if($pengembalian->kode_barang)
                    <div class="flex flex-col items-start">
                        {!! DNS1D::getBarcodeHTML($pengembalian->kode_barang, 'C128', 2, 66) !!}
                    </div>
                    @endif
                </dd>
            </div>
        </dl>
    </div>
</div>
@endsection