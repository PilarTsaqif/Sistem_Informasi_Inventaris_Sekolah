{{-- Menggunakan layout utama yang sudah mencakup header & footer --}}
@extends('layouts.app')

{{-- Judul halaman untuk tab browser --}}
@section('title', 'Selamat Datang')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8">
    <div class="text-center">
        {{-- Logo atau Ikon Sekolah bisa ditambahkan di sini jika ada --}}
        {{-- <img src="/path/to/logo.png" alt="Logo SMKN 8 Serang" class="mx-auto h-24 w-auto"> --}}
        
        <h1 class="mt-4 text-4xl font-bold tracking-tight text-gray-800 sm:text-5xl">
            Sistem Informasi Manajemen Inventaris
        </h1>
        <h2 class="mt-2 text-2xl text-blue-600 font-semibold">
            SMKN 8 Kota Serang
        </h2>
        <p class="mt-6 text-lg leading-8 text-gray-600">
            Selamat datang di platform manajemen aset dan inventaris. Silakan masuk untuk melanjutkan, atau daftar jika Anda belum memiliki akun.
        </p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="{{ route('login') }}" class="rounded-md bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                Login
            </a>
            <a href="{{ route('register') }}" class="text-sm font-semibold leading-6 text-gray-900">
                Register <span aria-hidden="true">→</span>
            </a>
        </div>
    </div>
</div>
@endsection