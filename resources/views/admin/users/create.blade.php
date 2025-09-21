@extends('layouts.app')

@section('title', 'Tambah User Baru')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Tambah User</h2>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 gap-6">
            {{-- Nama --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-600">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email <span class="text-red-600">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Role --}}
            <div>
                <label for="role_id" class="block text-sm font-medium text-gray-700">Role / Hak Akses <span class="text-red-600">*</span></label>
                <select name="role_id" id="role_id" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                    @endforeach
                </select>
                @error('role_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password <span class="text-red-600">*</span></label>
                <input type="password" name="password" id="password" required 
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password <span class="text-red-600">*</span></label>
                <input type="password" name="password_confirmation" id="password_confirmation" required 
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Batal</a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection