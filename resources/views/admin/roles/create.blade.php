@extends('layouts.app')

@section('title', 'Tambah Role Baru')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-lg mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Tambah Role</h2>
    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        <div>
            <label for="role_name" class="block text-sm font-medium text-gray-700">Nama Role <span class="text-red-600">*</span></label>
            <input type="text" name="role_name" id="role_name" value="{{ old('role_name') }}" required 
                   class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            @error('role_name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>
        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Batal</a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection