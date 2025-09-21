@extends('layouts.app')

@section('title', 'Detail Barang Keluar')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Detail Transaksi Barang Keluar</h2>
            <p class="mt-1 text-sm text-gray-500">UID Transaksi: <span class="font-mono">{{ $barangKeluar->uid_barangkeluar }}</span></p>
        </div>
        <a href="{{ route('barang-keluar.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Kembali</a>
    </div>
    
    {{-- DETAIL DATA --}}
    <div class="border-t border-gray-200">
        <dl class="divide-y divide-gray-200">
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Tanggal Keluar</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($barangKeluar->tgl_keluar)->isoFormat('DD MMMM YYYY') }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Nama Barang</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $barangKeluar->barangMasuk->barang->nama_barang }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Kode Barang</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-mono">{{ $barangKeluar->barangMasuk->barang->kode_barang }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Jumlah Keluar</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $barangKeluar->jumlah_keluar }} {{ $barangKeluar->barangMasuk->satuan->nama_satuan }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Customer / Penerima</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $barangKeluar->customer }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">No. Telepon</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $barangKeluar->no_telp ?? 'N/A' }}</dd>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $barangKeluar->alamat ?? 'N/A' }}</dd>
            </div>
             <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Diinput Oleh</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $barangKeluar->user->name ?? 'User Dihapus' }}</dd>
            </div>
             <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Barcode Barang</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    @if($barangKeluar->barangMasuk->barang->kode_barang)
                    <div class="flex flex-col items-start">
                        {!! DNS1D::getBarcodeHTML($barangKeluar->barangMasuk->barang->kode_barang, 'C128', 2, 66) !!}
                    </div>
                    @endif
                </dd>
            </div>
        </dl>
    </div>
</div>
@endsection