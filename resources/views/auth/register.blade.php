<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun Baru - Inventaris SMKN 8 Kota Serang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            {{-- HEADER --}}
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Buat Akun Baru
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Atau
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                        login jika sudah punya akun
                    </a>
                </p>
            </div>

            {{-- KARTU FORM --}}
            <div class="bg-white rounded-lg shadow-lg p-8">
                <form class="space-y-6" action="{{ route('register') }}" method="POST">
                    @csrf

                    {{-- INPUT NAMA LENGKAP --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <div class="mt-1">
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name"
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- INPUT EMAIL --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email"
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    {{-- INPUT ROLE --}}
                    <div>
                        <label for="role_id" class="block text-sm font-medium text-gray-700">Daftar Sebagai</label>
                        <div class="mt-1">
                            <select name="role_id" id="role_id" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">-- Pilih Peran Anda --</option>
                                {{-- Variabel $roles harus di-pass dari AuthController --}}
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                            @error('role_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- INPUT PASSWORD --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" required autocomplete="new-password"
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- INPUT KONFIRMASI PASSWORD --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <div class="mt-1">
                            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                    </div>

                    {{-- TOMBOL SUBMIT --}}
                    <div>
                        <button type="submit"
                                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>