@extends('layouts.app')

@section('title', 'Edit Data Ruangan')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Edit Data Ruangan</h2>

    <form action="{{ route('master.ruangan.update', $ruangan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Kode Ruangan --}}
            <div>
                <label for="kode_ruangan" class="block text-sm font-medium text-gray-700">Kode Ruangan</label>
                <input type="text" value="{{ $ruangan->kode_ruangan }}" readonly
                       class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Nama Ruangan --}}
            <div>
                <label for="nama_ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan <span class="text-red-600">*</span></label>
                <input type="text" name="nama_ruangan" id="nama_ruangan" value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                @error('nama_ruangan') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            
            {{-- Jurusan --}}
            <div>
                <label for="id_jurusan" class="block text-sm font-medium text-gray-700">Jurusan (Opsional)</label>
                <select name="id_jurusan" id="id_jurusan"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih Jurusan</option>
                    @foreach($jurusans as $jurusan)
                        <option value="{{ $jurusan->id }}" {{ old('id_jurusan', $ruangan->id_jurusan) == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- Kode RPS --}}
            <div>
                <label for="kode_rps" class="block text-sm font-medium text-gray-700">Kode RPS (Opsional)</label>
                <input type="text" name="kode_rps" id="kode_rps" value="{{ old('kode_rps', $ruangan->kode_rps) }}"
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
            </div>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('master.ruangan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Batal</a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection