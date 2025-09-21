@extends('layouts.app')
@section('title', 'Tambah Ruangan Baru')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
    {{-- HEADER FORM --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Formulir Ruangan Baru</h2>
        <a href="{{ route('ruangan.index') }}" class="text-sm text-gray-600 hover:text-blue-500">
            &larr; Kembali ke Daftar Ruangan
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
    <form action="{{ route('ruangan.store') }}" method="POST" class="space-y-6">
        @csrf
        
        {{-- KODE RUANGAN --}}
        <div>
            <label for="kode_ruangan" class="block text-sm font-medium text-gray-700 mb-1">Kode Ruangan</label>
            <input type="text" name="kode_ruangan" id="kode_ruangan" value="{{ old('kode_ruangan') }}" required
                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                   placeholder="Contoh: R-001, LAB-KOM, BENGKEL-TM">
        </div>

        {{-- NAMA RUANGAN --}}
        <div>
            <label for="nama_ruangan" class="block text-sm font-medium text-gray-700 mb-1">Nama Ruangan</label>
            <input type="text" name="nama_ruangan" id="nama_ruangan" value="{{ old('nama_ruangan') }}" required
                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                   placeholder="Contoh: Ruang Praktik Siswa A">
        </div>

        {{-- JURUSAN --}}
        <div>
            <label for="id_jurusan" class="block text-sm font-medium text-gray-700 mb-1">Jurusan <span class="text-gray-400 font-normal">(Opsional)</span></label>
            <select name="id_jurusan" id="id_jurusan"
                    class="block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <option value="">-- Pilih Jurusan (Jika Ada) --</option>
                @foreach($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}" {{ old('id_jurusan') == $jurusan->id ? 'selected' : '' }}>
                        {{ $jurusan->nama_jurusan }}
                    </option>
                @endforeach
            </select>
        </div>
        
        {{-- TOMBOL SUBMIT --}}
        <div class="flex justify-end pt-4 border-t">
            <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Simpan Ruangan
            </button>
        </div>
    </form>
</div>
@endsection