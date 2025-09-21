@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Detail Peminjaman</h2>
            <p class="mt-1 text-sm text-gray-500">Kode Transaksi: <span class="font-mono">{{ $peminjaman->kode_peminjaman }}</span></p>
        </div>
        <div class="mt-3 sm:mt-0 flex space-x-2">
            <a href="{{ route('peminjaman.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Kembali</a>
            @if(!$peminjaman->pengembalian)
                @can('manage-transactions')
                <a href="{{ route('pengembalian.create', ['peminjaman_id' => $peminjaman->id]) }}" class="inline-flex items-center px-4 py-2 bg-green-500 rounded-md font-semibold text-xs text-white uppercase hover:bg-green-600">Proses Pengembalian</a>
                @endcan
            @endif
        </div>
    </div>
    
    {{-- DETAIL DATA --}}
    <div class="border-t border-gray-200">
        <dl class="divide-y divide-gray-200">
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Status</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    @if($peminjaman->pengembalian)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">Sudah Dikembalikan</span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Sedang Dipinjam</span>
                    @endif
                </dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Nama Peminjam</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $peminjaman->nama_peminjam }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Nama Barang</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $peminjaman->barang->nama_barang }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Jumlah</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $peminjaman->jumlah }} {{ $peminjaman->satuan->nama_satuan }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Tanggal Peminjaman</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->isoFormat('DD MMMM YYYY') }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Lama Peminjaman</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $peminjaman->lama_peminjaman }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Kondisi Saat Dipinjam</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $peminjaman->kondisi }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Barcode Barang</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    @if($peminjaman->barang->kode_barang)
                    <div class="flex flex-col items-start">
                        {!! DNS1D::getBarcodeHTML($peminjaman->barang->kode_barang, 'C128', 2, 66) !!}
                    </div>
                    @endif
                </dd>
            </div>
        </dl>
    </div>
</div>
@endsection