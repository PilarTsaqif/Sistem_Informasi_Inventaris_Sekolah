@extends('layouts.app')

@section('title', 'Detail Role')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $role->role_name }}</h2>
            <p class="mt-1 text-sm text-gray-500">Detail lengkap untuk hak akses.</p>
        </div>
        <div class="mt-3 sm:mt-0 flex space-x-2">
            <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Kembali</a>
            <a href="{{ route('admin.roles.edit', $role) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 rounded-md font-semibold text-xs text-white uppercase hover:bg-yellow-600">Edit</a>
        </div>
    </div>
    
    {{-- DETAIL DATA --}}
    <div class="border-t border-gray-200">
        <dl class="divide-y divide-gray-200">
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Nama Role</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $role->role_name }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Jumlah Pengguna</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $role->users()->count() }} Pengguna</dd>
            </div>
        </dl>
    </div>

    {{-- Daftar Pengguna --}}
    <div class="mt-6">
        <h3 class="text-lg font-medium text-gray-900">Pengguna dengan Role Ini</h3>
        <ul class="mt-2 divide-y divide-gray-200 border-t border-b border-gray-200">
            @forelse($role->users as $user)
            <li class="py-3 flex justify-between items-center">
                <span class="text-sm text-gray-700">{{ $user->name }}</span>
                <span class="text-sm text-gray-500">{{ $user->email }}</span>
            </li>
            @empty
            <li class="py-3 text-sm text-gray-500">Tidak ada pengguna dengan role ini.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection