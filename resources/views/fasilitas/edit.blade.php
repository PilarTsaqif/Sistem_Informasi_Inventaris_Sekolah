@extends('layouts.app')
@section('title', 'Edit Jumlah Fasilitas')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Edit Jumlah Fasilitas</h2>
    <p class="text-sm text-gray-500 mb-6">Barang: <span class="font-semibold">{{ $fasilitas->nama_barang }}</span> di Ruangan: <span class="font-semibold">{{ $ruangan->nama_ruangan }}</span></p>
    <form action="{{ route('fasilitas.update', [$ruangan->id, $fasilitas->kode_barang]) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div><label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label><input type="number" name="jumlah" value="{{ old('jumlah', $fasilitas->pivot->jumlah) }}" min="1" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
        <div class="flex justify-end space-x-4 pt-4 border-t mt-6"><a href="{{ route('fasilitas.index', $ruangan->id) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">Batal</a><button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 font-medium">Update Jumlah</button></div>
    </form>
</div>
@endsection