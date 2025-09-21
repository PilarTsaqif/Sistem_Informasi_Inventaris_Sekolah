@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div>
    {{-- Header Sambutan --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p class="mt-1 text-sm text-gray-500">Berikut adalah ringkasan aktivitas sistem inventaris saat ini.</p>
    </div>

    {{-- Kartu Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        {{-- Total Jenis Barang --}}
        <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Jenis Barang</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalBarang }}</p>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
            </div>
        </div>

        {{-- Peminjaman Aktif --}}
        <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Peminjaman Aktif</p>
                <p class="text-3xl font-bold text-gray-800">{{ $peminjamanAktif }}</p>
            </div>
            <div class="bg-yellow-100 rounded-full p-3">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
            </div>
        </div>

        {{-- Stok Menipis --}}
        <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Barang Stok Menipis</p>
                <p class="text-3xl font-bold text-red-600">{{ $stokMenipis }}</p>
            </div>
            <div class="bg-red-100 rounded-full p-3">
                 <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
        </div>

        {{-- Total Pengguna --}}
        <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalUser }}</p>
            </div>
            <div class="bg-green-100 rounded-full p-3">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>

    </div>

    {{-- Anda bisa menambahkan konten lain di sini, seperti shortcut atau tabel aktivitas terakhir --}}

</div>
@endsection