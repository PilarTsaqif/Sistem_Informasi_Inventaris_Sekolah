@extends('layouts.app')
@section('title', 'Tambah Satuan Baru')
@section('content')
<div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-6">
    {{-- HEADER FORM --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Formulir Satuan Baru</h2>
        <a href="{{ route('satuan.index') }}" class="text-sm text-gray-600 hover:text-blue-500">
            &larr; Kembali ke Daftar Satuan
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

    {{-- FORMULIR UTAMA --}}
    <form action="{{ route('satuan.store') }}" method="POST" class="space-y-6">
        @csrf
        
        {{-- NAMA SATUAN --}}
        <div>
            <label for="nama_satuan" class="block text-sm font-medium text-gray-700 mb-1">Nama Satuan</label>
            <input type="text" name="nama_satuan" id="nama_satuan" value="{{ old('nama_satuan') }}" required
                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                   placeholder="Contoh: Unit, Buah, Set, Liter">
        </div>
        
        {{-- TOMBOL SUBMIT --}}
        <div class="flex justify-end pt-4 border-t">
            <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Simpan Satuan
            </button>
        </div>
    </form>
</div>
@endsection
