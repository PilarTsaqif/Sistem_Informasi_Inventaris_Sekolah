@extends('layouts.app')

@section('title', 'Detail Barang Masuk')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Detail Transaksi Barang Masuk</h2>
            <p class="mt-1 text-sm text-gray-500">Transaksi pada {{ $barangMasuk->created_at->isoFormat('DD MMMM YYYY, HH:mm') }}</p>
        </div>
        <a href="{{ route('barang-masuk.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Kembali</a>
    </div>
    
    {{-- DETAIL DATA --}}
    <div class="border-t border-gray-200">
        <dl class="divide-y divide-gray-200">
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Tanggal Masuk</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($barangMasuk->tgl_masuk)->isoFormat('DD MMMM YYYY') }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Nama Barang</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $barangMasuk->barang->nama_barang }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Kode Barang</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-mono">{{ $barangMasuk->kode_barang }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Jumlah Masuk</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $barangMasuk->jumlah_masuk }} {{ $barangMasuk->satuan->nama_satuan }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Pemasok</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $barangMasuk->pemasok->nama_pemasok ?? 'N/A' }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Kondisi</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $barangMasuk->kondisi == 'Baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $barangMasuk->kondisi }}
                    </span>
                </dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Stok Peringatan</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $barangMasuk->stok_minimal }} {{ $barangMasuk->satuan->nama_satuan }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Info Maintenance</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $barangMasuk->info_maintenance ?? 'Tidak ada' }}</dd>
            </div>
             <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Diinput Oleh</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $barangMasuk->user->name ?? 'User Dihapus' }}</dd>
            </div>
             <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Barcode Barang</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    @if($barangMasuk->kode_barang)
                    <div class="flex flex-col items-start">
                        {!! DNS1D::getBarcodeHTML($barangMasuk->kode_barang, 'C128', 2, 66) !!}
                    </div>
                    @endif
                </dd>
            </div>
        </dl>
    </div>
</div>
@endsection