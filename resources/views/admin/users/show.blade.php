@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
            <p class="mt-1 text-sm text-gray-500">Detail lengkap untuk pengguna.</p>
        </div>
        <div class="mt-3 sm:mt-0 flex space-x-2">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-300">Kembali</a>
            <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 rounded-md font-semibold text-xs text-white uppercase hover:bg-yellow-600">Edit</a>
        </div>
    </div>
    
    {{-- DETAIL DATA --}}
    <div class="border-t border-gray-200">
        <dl class="divide-y divide-gray-200">
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->name }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Alamat Email</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->email }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Role / Hak Akses</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                        {{ $user->role->role_name }}
                    </span>
                </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">Tanggal Bergabung</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->created_at->isoFormat('DD MMMM YYYY, HH:mm') }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection