<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Sistem Inventaris SMKN 8 Kota Serang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="text-center p-8">
            {{-- Logo bisa ditambahkan di sini jika ada --}}
            <h1 class="text-4xl md:text-5xl font-extrabold text-blue-600">
                Sistem Informasi Inventaris
            </h1>
            <p class="mt-2 text-2xl font-semibold text-gray-700">
                SMKN 8 Kota Serang
            </p>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500">
                Selamat datang di pusat pengelolaan aset dan inventaris sekolah. Silakan login untuk memulai mengelola data barang, peminjaman, dan laporan.
            </p>
        </div>

        <div class="mt-8 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="{{ route('login') }}" class="w-full sm:w-auto text-center px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-300">
                Login
            </a>
            <a href="{{ route('register') }}" class="w-full sm:w-auto text-center px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-opacity-75 transition duration-300">
                Register
            </a>
        </div>

        <div class="mt-16 text-center text-gray-400 text-sm">
            <p>&copy; {{ date('Y') }} SMKN 8 Kota Serang. All rights reserved.</p>
        </div>
    </div>

</body>
</html>