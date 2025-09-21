@extends('layouts.app')
@section('title', 'Tambah User Baru')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
    {{-- HEADER FORM --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Formulir User Baru</h2>
        <a href="{{ route('users.index') }}" class="text-sm text-gray-600 hover:text-blue-500">
            &larr; Kembali ke Daftar User
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
    <form action="{{ route('users.store') }}" method="POST" class="space-y-6" x-data="{ showPassword: false, showConfirmPassword: false }">
        @csrf

        {{-- NAMA LENGKAP --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                   placeholder="Masukkan nama lengkap user">
        </div>

        {{-- EMAIL --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                   placeholder="contoh@email.com">
        </div>

        {{-- ROLE --}}
        <div>
            <label for="role_id" class="block text-sm font-medium text-gray-700 mb-1">Role / Hak Akses</label>
            <select name="role_id" id="role_id" required
                    class="block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <option value="" disabled selected>-- Pilih Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                        {{ $role->role_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- PASSWORD --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <div class="relative">
                <input :type="showPassword ? 'text' : 'password'" name="password" id="password" required
                       class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                       oninput="checkPasswordStrength(this.value)">
                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-blue-500">
                    {{-- Ikon mata --}}
                    <svg x-show="!showPassword" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    {{-- Ikon mata dicoret --}}
                    <svg x-show="showPassword" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 .847 0 1.673.126 2.463.362m3.69-3.69L21 21m-4.5-4.5A3 3 0 0113.5 12a3 3 0 01-3.176-2.5" /></svg>
                </button>
            </div>
            {{-- Indikator Kekuatan Password --}}
            <div class="mt-2">
                <div class="h-2 bg-gray-200 rounded-full">
                    <div id="strength-bar" class="h-full rounded-full transition-all duration-300" style="width: 0%;"></div>
                </div>
                <p id="strength-text" class="text-xs mt-1 text-gray-500">Password minimal 8 karakter.</p>
            </div>
        </div>

        {{-- KONFIRMASI PASSWORD --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
             <div class="relative">
                <input :type="showConfirmPassword ? 'text' : 'password'" name="password_confirmation" id="password_confirmation" required
                       class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                 <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-blue-500">
                    <svg x-show="!showConfirmPassword" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    <svg x-show="showConfirmPassword" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 .847 0 1.673.126 2.463.362m3.69-3.69L21 21m-4.5-4.5A3 3 0 0113.5 12a3 3 0 01-3.176-2.5" /></svg>
                </button>
            </div>
        </div>
        
        {{-- TOMBOL SUBMIT --}}
        <div class="flex justify-end pt-4">
            <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Simpan User
            </button>
        </div>
    </form>
</div>

{{-- SCRIPT UNTUK KEKUATAN PASSWORD --}}
<script>
    function checkPasswordStrength(password) {
        let strength = 0;
        const strengthBar = document.getElementById('strength-bar');
        const strengthText = document.getElementById('strength-text');

        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/)) strength++;
        if (password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;

        let width, color, text;
        const defaultText = 'Password minimal 8 karakter.';

        switch (strength) {
            case 0: case 1: width = '20%'; color = 'bg-red-500'; text = 'Sangat Lemah'; break;
            case 2: width = '40%'; color = 'bg-orange-500'; text = 'Lemah'; break;
            case 3: width = '60%'; color = 'bg-yellow-500'; text = 'Sedang'; break;
            case 4: width = '80%'; color = 'bg-blue-500'; text = 'Kuat'; break;
            case 5: width = '100%'; color = 'bg-green-500'; text = 'Sangat Kuat'; break;
            default: width = '0%'; color = 'bg-gray-200'; text = defaultText;
        }

        if (password.length === 0) {
            width = '0%'; text = defaultText;
        }
        
        strengthBar.style.width = width;
        strengthBar.className = `h-full rounded-full transition-all duration-300 ${color}`;
        strengthText.textContent = text;
    }
</script>
@endsection