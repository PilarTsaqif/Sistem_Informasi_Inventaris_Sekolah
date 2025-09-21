<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris - Bengkel Teknik Mesin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }
        .hero-bg {
            background: linear-gradient(rgba(3, 37, 108, 0.8), rgba(3, 37, 108, 0.9)), url('/image/hero-bg.jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .inventory-card {
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .inventory-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .feature-icon {
            transition: all 0.3s ease;
        }
        .inventory-card:hover .feature-icon {
            transform: scale(1.1);
            color: #1768AC;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
        }
        .stats-card {
            transition: all 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .website-btn {
            background: linear-gradient(135deg, #16a34a, #22c55e);
        }
        .website-btn:hover {
            background: linear-gradient(135deg, #15803d, #16a34a);
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#03256C',
                        secondary: '#2541B2',
                        accent: '#1768AC',
                        light: '#06BEE1',
                        dark: '#1A1A2E',
                        success: '#16a34a',
                        warning: '#eab308',
                        danger: '#dc2626'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">

    <header x-data="{ atTop: true, mobileMenuOpen: false }" 
            @scroll.window="atTop = (window.pageYOffset > 50) ? false : true" 
            :class="{'bg-white shadow-md text-gray-800': !atTop, 'bg-transparent text-white': atTop}"
            class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <img src="/image/logo.png" alt="Logo SMKN 8 Kota Serang" class="h-12 mr-3">
                <div class="font-bold text-xl tracking-wide">
                    Sistem Inventaris <span class="text-sm block font-normal">Bengkel Teknik Mesin</span>
                </div>
            </div>
            
            <div class="hidden md:flex items-center space-x-8 text-sm font-semibold">
                <a href="#beranda" class="hover:text-blue-500 transition-colors">Beranda</a>
                <a href="#fitur" class="hover:text-blue-500 transition-colors">Fitur</a>
                <a href="#inventaris" class="hover:text-blue-500 transition-colors">Data Inventaris</a>
                <a href="#statistik" class="hover:text-blue-500 transition-colors">Statistik</a>
                <a href="#bantuan" class="hover:text-blue-500 transition-colors">Bantuan</a>
                <a href="https://smkn8serang.sch.id/" target="_blank" class="px-3 py-1 website-btn text-white rounded-full flex items-center">
                    <i class="fas fa-globe mr-2"></i> Website Sekolah
                </a>
            </div>
            
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-5 py-2 bg-white text-blue-600 font-semibold rounded-full hover:bg-gray-100 transition-colors duration-300">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 bg-white text-blue-600 font-semibold rounded-full hover:bg-gray-100 transition-colors duration-300">Masuk</a>
                    <a href="{{ route('register') }}" class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition-colors duration-300">Daftar</a>
                @endauth
                
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>
        
        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-cloak class="md:hidden bg-white text-gray-800 shadow-lg">
            <div class="container mx-auto px-6 py-4 flex flex-col space-y-4">
                <a href="#beranda" class="hover:text-blue-500 transition-colors py-2 border-b border-gray-100">Beranda</a>
                <a href="#fitur" class="hover:text-blue-500 transition-colors py-2 border-b border-gray-100">Fitur</a>
                <a href="#inventaris" class="hover:text-blue-500 transition-colors py-2 border-b border-gray-100">Data Inventaris</a>
                <a href="#statistik" class="hover:text-blue-500 transition-colors py-2 border-b border-gray-100">Statistik</a>
                <a href="#bantuan" class="hover:text-blue-500 transition-colors py-2 border-b border-gray-100">Bantuan</a>
                
                <!-- Menu Website Sekolah -->
                <div class="pt-4 border-t border-gray-200 mt-2">
                    <a href="https://smkn8serang.sch.id/" target="_blank" class="website-btn text-white py-2 px-4 rounded-full flex items-center justify-center">
                        <i class="fas fa-globe mr-2"></i> Website Sekolah
                    </a>
                </div>
                
                <!-- Menu Akun -->
                <div class="pt-4 border-t border-gray-200 mt-2 flex flex-col space-y-2">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-gray-100 text-gray-800 py-2 px-4 rounded-full text-center font-semibold">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-gray-100 text-gray-800 py-2 px-4 rounded-full text-center font-semibold">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white py-2 px-4 rounded-full text-center font-semibold">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section id="beranda" class="hero-bg min-h-screen flex items-center justify-center text-center text-white pt-20">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl mx-auto animate-fade-in">
                    <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                        Sistem Informasi Inventaris <span class="text-light">Bengkel Teknik Mesin</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-blue-100 mb-10">
                        Kelola data barang, alat, dan bahan praktikum dengan mudah dan efisien.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-8 py-3 bg-light text-primary font-bold rounded-full hover:bg-white transform hover:scale-105 transition-all duration-300">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-8 py-3 bg-light text-primary font-bold rounded-full hover:bg-white transform hover:scale-105 transition-all duration-300">
                                Masuk ke Sistem
                            </a>
                            <a href="{{ route('register') }}" class="px-8 py-3 border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-primary transform hover:scale-105 transition-all duration-300">
                                Daftar Akun
                            </a>
                        @endauth
                    </div>
                    
                    <div class="mt-10">
                        <a href="https://smkn8serang.sch.id/" target="_blank" class="inline-flex items-center text-white bg-green-600 bg-opacity-80 hover:bg-opacity-100 px-5 py-2 rounded-full transition-all">
                            <i class="fas fa-external-link-alt mr-2"></i> Kunjungi Website Sekolah
                        </a>
                    </div>
                </div>
            </div>
            <a href="#fitur" class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
                <i class="fas fa-chevron-down text-3xl text-white"></i>
            </a>
        </section>

        <!-- Fitur Section -->
        <section id="fitur" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Fitur Sistem Inventaris</h2>
                    <div class="w-20 h-1 bg-primary mx-auto mt-4"></div>
                    <p class="mt-4 text-gray-600">Kelola inventaris Bengkel dengan fitur-fitur canggih dan mudah digunakan.</p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="inventory-card bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <div class="feature-icon text-4xl text-primary mb-4">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Manajemen Barang</h3>
                        <p class="text-gray-600">Kelola data barang, alat, dan bahan praktikum dengan sistem katalog terorganisir.</p>
                    </div>
                    
                    <div class="inventory-card bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <div class="feature-icon text-4xl text-primary mb-4">
                            <i class="fas fa-barcode"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Kode QR</h3>
                        <p class="text-gray-600">Generate kode QR untuk setiap item inventaris untuk memudahkan tracking dan peminjaman.</p>
                    </div>
                    
                    <div class="inventory-card bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <div class="feature-icon text-4xl text-primary mb-4">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Peminjaman</h3>
                        <p class="text-gray-600">Kelola proses peminjaman dan pengembalian alat dengan sistem yang terintegrasi.</p>
                    </div>
                    
                    <div class="inventory-card bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <div class="feature-icon text-4xl text-primary mb-4">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Laporan</h3>
                        <p class="text-gray-600">Buat laporan inventaris, peminjaman, dan maintenance dengan mudah.</p>
                    </div>
                    
                    <div class="inventory-card bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <div class="feature-icon text-4xl text-primary mb-4">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Maintenance</h3>
                        <p class="text-gray-600">Jadwalkan dan lacak kegiatan perawatan alat dan mesin bengkel.</p>
                    </div>
                    
                    <div class="inventory-card bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <div class="feature-icon text-4xl text-primary mb-4">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Pencarian</h3>
                        <p class="text-gray-600">Temukan barang dengan cepat menggunakan fitur pencarian yang canggih.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistik Section -->
        <section id="statistik" class="py-20 bg-primary text-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold">Statistik Inventaris</h2>
                    <div class="w-20 h-1 bg-light mx-auto mt-4"></div>
                    <p class="mt-4 text-blue-100">Data terkini inventaris bengkel teknik mesin.</p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="stats-card bg-secondary bg-opacity-50 rounded-lg p-6 text-center">
                        <div class="text-4xl font-bold text-light mb-3" x-data="{ count: 0, target: 285 }" x-init="() => { let interval = setInterval(() => { if (count < target) { count+=5 } else { clearInterval(interval) } }, 20) }" x-text="Math.round(count)">0</div>
                        <h3 class="text-lg font-semibold mb-2">Total Barang</h3>
                        <p class="text-blue-100 text-sm">Alat dan bahan bengkel</p>
                    </div>
                    
                    <div class="stats-card bg-secondary bg-opacity-50 rounded-lg p-6 text-center">
                        <div class="text-4xl font-bold text-light mb-3" x-data="{ count: 0, target: 42 }" x-init="() => { let interval = setInterval(() => { if (count < target) { count++ } else { clearInterval(interval) } }, 50) }" x-text="count">0</div>
                        <h3 class="text-lg font-semibold mb-2">Dipinjam</h3>
                        <p class="text-blue-100 text-sm">Barang sedang dipinjam</p>
                    </div>
                    
                    <div class="stats-card bg-secondary bg-opacity-50 rounded-lg p-6 text-center">
                        <div class="text-4xl font-bold text-light mb-3" x-data="{ count: 0, target: 18 }" x-init="() => { let interval = setInterval(() => { if (count < target) { count++ } else { clearInterval(interval) } }, 70) }" x-text="count">0</div>
                        <h3 class="text-lg font-semibold mb-2">Maintenance</h3>
                        <p class="text-blue-100 text-sm">Barang dalam perawatan</p>
                    </div>
                    
                    <div class="stats-card bg-secondary bg-opacity-50 rounded-lg p-6 text-center">
                        <div class="text-4xl font-bold text-light mb-3" x-data="{ count: 0, target: 225 }" x-init="() => { let interval = setInterval(() => { if (count < target) { count+=5 } else { clearInterval(interval) } }, 20) }" x-text="Math.round(count)">0</div>
                        <h3 class="text-lg font-semibold mb-2">Tersedia</h3>
                        <p class="text-blue-100 text-sm">Barang siap digunakan</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Inventaris Section -->
        <section id="inventaris" class="py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Kategori Inventaris</h2>
                    <div class="w-20 h-1 bg-primary mx-auto mt-4"></div>
                    <p class="mt-4 text-gray-600">Jenis-jenis alat dan bahan yang dikelola dalam sistem.</p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="inventory-card bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="h-48 overflow-hidden">
                            <img src="/image/mesin.png" alt="Mesin dan Peralatan" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Mesin dan Peralatan</h3>
                            <p class="text-gray-600 mb-4">Mesin bubut, frais, CNC, dan peralatan workshop lainnya.</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">125 items</span>
                                <a href="#" class="text-primary font-semibold text-sm flex items-center">
                                    Lihat detail
                                    <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="inventory-card bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="h-48 overflow-hidden">
                            <img src="/image/alat-ukur.jpeg" alt="Alat Ukur" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Alat Ukur</h3>
                            <p class="text-gray-600 mb-4">Mikrometer, jangka sorong, height gauge, dan alat ukur presisi.</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">78 items</span>
                                <a href="#" class="text-primary font-semibold text-sm flex items-center">
                                    Lihat detail
                                    <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="inventory-card bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="h-48 overflow-hidden">
                            <img src="/image/perkakas.jpg" alt="Perkakas Tangan" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Perkakas Tangan</h3>
                            <p class="text-gray-600 mb-4">Kunci, obeng, tang, palu, dan berbagai perkakas manual.</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">215 items</span>
                                <a href="#" class="text-primary font-semibold text-sm flex items-center">
                                    Lihat detail
                                    <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-12">
                    <a href="https://smkn8serang.sch.id/" target="_blank" class="inline-flex items-center text-primary font-semibold hover:text-secondary">
                        <i class="fas fa-external-link-alt mr-2"></i> Lihat informasi lengkap di Website Sekolah
                    </a>
                </div>
            </div>
        </section>

        <!-- Bantuan Section -->
        <section id="bantuan" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Butuh Bantuan?</h2>
                    <div class="w-20 h-1 bg-primary mx-auto mt-4"></div>
                    <p class="mt-4 text-gray-600">Kami siap membantu Anda menggunakan sistem inventaris.</p>
                </div>
                
                <div class="grid md:grid-cols-2 gap-12">
                    <div>
                        <h3 class="text-2xl font-bold text-primary mb-6">Panduan Penggunaan</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="bg-primary rounded-full p-3 mr-4 mt-1">
                                    <i class="fas fa-book text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2">Dokumentasi Sistem</h4>
                                    <p class="text-gray-600">Pelajari cara menggunakan semua fitur sistem inventaris dengan panduan lengkap.</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-primary rounded-full p-3 mr-4 mt-1">
                                    <i class="fas fa-video text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2">Video Tutorial</h4>
                                    <p class="text-gray-600">Tonton video tutorial untuk mempelajari fitur-fitur sistem secara visual.</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-primary rounded-full p-3 mr-4 mt-1">
                                    <i class="fas fa-question-circle text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2">FAQ</h4>
                                    <p class="text-gray-600">Temukan jawaban atas pertanyaan yang sering diajukan tentang sistem.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-2xl font-bold text-primary mb-6">Hubungi Kami</h3>
                        
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <p class="text-gray-600 mb-6">Jika Anda mengalami kendala atau memiliki pertanyaan, jangan ragu untuk menghubungi kami.</p>
                            
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <div class="bg-primary rounded-full p-3 mr-4">
                                        <i class="fas fa-user-cog text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">Admin Bengkel</h4>
                                        <p class="text-gray-600">Bpk. Ahmad Sudirman</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <div class="bg-primary rounded-full p-3 mr-4">
                                        <i class="fas fa-envelope text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">Email</h4>
                                        <p class="text-gray-600">inventaris@smkn8kotaserang.sch.id</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <div class="bg-primary rounded-full p-3 mr-4">
                                        <i class="fas fa-phone-alt text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">Telepon</h4>
                                        <p class="text-gray-600">(0254) 401736 ext. 123</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <div class="bg-primary rounded-full p-3 mr-4">
                                        <i class="fas fa-clock text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">Jam Layanan</h4>
                                        <p class="text-gray-600">Senin - Jumat: 08.00 - 16.00 WIB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer class="bg-dark text-white pt-12 pb-6">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <img src="/image/logo.png" alt="Logo SMKN 8 Kota Serang" class="h-12 mb-4">
                    <h3 class="font-bold text-xl tracking-wide mb-4">Sistem Inventaris</h3>
                    <p class="text-gray-400 text-sm">Bengkel Teknik Mesin SMKN 8 Kota Serang</p>
                </div>
                
                <div>
                    <h4 class="font-semibold text-lg mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="text-gray-400 hover:text-light transition-colors text-sm">Beranda</a></li>
                        <li><a href="#fitur" class="text-gray-400 hover:text-light transition-colors text-sm">Fitur</a></li>
                        <li><a href="#inventaris" class="text-gray-400 hover:text-light transition-colors text-sm">Data Inventaris</a></li>
                        <li><a href="#statistik" class="text-gray-400 hover:text-light transition-colors text-sm">Statistik</a></li>
                        <li><a href="#bantuan" class="text-gray-400 hover:text-light transition-colors text-sm">Bantuan</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold text-lg mb-4">Kategori Inventaris</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-light transition-colors text-sm">Mesin dan Peralatan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-light transition-colors text-sm">Alat Ukur</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-light transition-colors text-sm">Perkakas Tangan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-light transition-colors text-sm">Bahan Praktek</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-light transition-colors text-sm">Konsumsi</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold text-lg mb-4">Kontak & Tautan</h4>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-light mr-3 mt-1"></i>
                            <span class="text-gray-400 text-sm">Lab. Teknik Mesin, SMKN 8 Kota Serang</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt text-light mr-3 mt-1"></i>
                            <span class="text-gray-400 text-sm">(0254) 401736 ext. 123</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-light mr-3 mt-1"></i>
                            <span class="text-gray-400 text-sm">inventaris@smkn8kotaserang.sch.id</span>
                        </li>
                        <li class="pt-2">
                            <a href="https://smkn8serang.sch.id/" target="_blank" class="inline-flex items-center website-btn text-white py-2 px-4 rounded-full text-sm">
                                <i class="fas fa-globe mr-2"></i> Website Sekolah
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-10 pt-6 text-center">
                <p class="text-xs text-gray-500">&copy; {{ date('Y') }} SMKN 8 Kota Serang. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>