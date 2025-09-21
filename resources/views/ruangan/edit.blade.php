@extends('layouts.app')
@section('title', 'Edit Ruangan')
@section('content')
<div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Edit Ruangan</h2>
    @if ($errors->any())<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert"><ul class="list-disc list-inside text-sm">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div><label for="kode_ruangan" class="block text-sm font-medium text-gray-700">Kode Ruangan</label><input type="text" name="kode_ruangan" value="{{ old('kode_ruangan', $ruangan->kode_ruangan) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
        <div><label for="nama_ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan</label><input type="text" name="nama_ruangan" value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
        <div><label for="id_jurusan" class="block text-sm font-medium text-gray-700">Jurusan <span class="text-gray-400">(Opsional)</span></label><select name="id_jurusan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><option value="">-- Pilih Jurusan --</option>@foreach($jurusans as $jurusan)<option value="{{ $jurusan->id }}" {{ old('id_jurusan', $ruangan->id_jurusan) == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>@endforeach</select></div>
        <div class="flex justify-end space-x-4 pt-4 border-t mt-6">
            <a href="{{ route('ruangan.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 font-medium">Update Ruangan</button>
        </div>
    </form>
</div>
@endsection