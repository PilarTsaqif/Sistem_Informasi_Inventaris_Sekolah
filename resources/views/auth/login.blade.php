<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventaris SMKN 8 Kota Serang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .split-layout {
            display: flex;
            min-height: 100vh;
        }
        .left-panel {
            flex: 1;
            background: linear-gradient(rgba(3, 37, 108, 0.85), rgba(3, 37, 108, 0.95)), url('/image/login-bg.png');
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem;
        }
        .right-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background-color: #f9fafb;
        }
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }
        .password-toggle:hover {
            color: #03256C;
        }
        @media (max-width: 768px) {
            .split-layout {
                flex-direction: column;
            }
            .left-panel {
                order: 2;
                min-height: 40vh;
            }
            .right-panel {
                order: 1;
                min-height: 60vh;
            }
        }
    </style>
</head>
<body>

<div class="split-layout">
    <!-- Panel Kiri (Gambar & Informasi) -->
    <div class="left-panel">
        <div class="max-w-md mx-auto">
            <div class="flex items-center mb-8">
                <img src="/image/logo.png" alt="Logo SMKN 8 Kota Serang" class="h-12 mr-3">
                <div>
                    <h1 class="text-2xl font-bold">SMKN 8 Kota Serang</h1>
                    <p class="text-blue-100">Sistem Inventaris Bengkel</p>
                </div>
            </div>
            
            <h2 class="text-3xl font-bold mb-4">Kelola Inventaris dengan Mudah</h2>
            <p class="text-blue-100 mb-6">
                Akses sistem inventaris bengkel teknik mesin untuk mengelola data barang, alat, dan bahan praktikum.
            </p>
            
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="bg-blue-500 rounded-full p-2 mr-3 mt-1">
                        <i class="fas fa-check text-white"></i>
                    </div>
                    <p>Manajemen data barang dan alat praktikum</p>
                </div>
                <div class="flex items-start">
                    <div class="bg-blue-500 rounded-full p-2 mr-3 mt-1">
                        <i class="fas fa-check text-white"></i>
                    </div>
                    <p>Peminjaman dan pengembalian alat</p>
                </div>
                <div class="flex items-start">
                    <div class="bg-blue-500 rounded-full p-2 mr-3 mt-1">
                        <i class="fas fa-check text-white"></i>
                    </div>
                    <p>Laporan inventaris terintegrasi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel Kanan (Form Login) -->
    <div class="right-panel">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">
                    Masuk ke Akun Anda
                </h2>
                <p class="text-center text-gray-600 mb-8">
                    Silakan masuk dengan kredensial Anda
                </p>

                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf

                    {{-- PESAN ERROR & SUKSES --}}
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg text-sm" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @error('email')
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg text-sm" role="alert">
                            <strong class="font-bold">Gagal!</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                        </div>
                    @enderror

                    {{-- INPUT EMAIL --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required
                                   class="pl-10 appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                   placeholder="email@contoh.com">
                        </div>
                    </div>

                    {{-- INPUT PASSWORD --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                   class="pl-10 pr-10 appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                   placeholder="Masukkan password">
                            <span class="password-toggle" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                Ingat Saya
                            </label>
                        </div>
                        
                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                                Lupa Password?
                            </a>
                        </div>
                    </div>

                    {{-- TOMBOL SUBMIT --}}
                    <div>
                        <button type="submit"
                                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i class="fas fa-sign-in-alt text-blue-300 group-hover:text-blue-200"></i>
                            </span>
                            Login
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500">
                            Daftar di sini
                        </a>
                    </p>
                </div>
            </div>
            
            <div class="mt-6 text-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} SMKN 8 Kota Serang. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk toggle password visibility
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        
        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // Toggle the eye icon
            const icon = this.querySelector('i');
            if (type === 'password') {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    });
</script>

</body>
</html>