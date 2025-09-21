<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\RuanganBarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PemasokController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// [DIPERBAIKI] Mengarahkan halaman utama ke method 'welcome' untuk menampilkan halaman profil sekolah.
Route::get('/', [LandingController::class, 'welcome'])->name('welcome');

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

// Grup rute utama untuk user yang sudah login
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // =================================================================
    // DATA MASTER
    // =================================================================
    Route::prefix('master')->name('master.')->group(function () {
        Route::resource('barang', BarangController::class);
        Route::resource('kategori-barang', KategoriBarangController::class);
        Route::resource('satuan', SatuanController::class);
        Route::resource('jurusan', JurusanController::class);
        Route::resource('ruangan', RuanganController::class);
        Route::resource('pemasok', PemasokController::class);
    });
    
    // =================================================================
    // FASILITAS RUANGAN (BARANG DI DALAM RUANGAN)
    // =================================================================
    Route::resource('ruangan.barang', RuanganBarangController::class)
        ->scoped()
        ->except(['show'])
        ->names('fasilitas');

    // =================================================================
    // MANAJEMEN INVENTARIS
    // =================================================================
    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('barang-keluar', BarangKeluarController::class)->except(['edit', 'update']);
    Route::get('stok-barang', [StokBarangController::class, 'index'])->name('stok-barang.index');
    Route::get('stok-barang/{barang}', [StokBarangController::class, 'show'])->name('stok-barang.show');
    
    // =================================================================
    // TRANSAKSI PEMINJAMAN
    // =================================================================
    Route::resource('peminjaman', PeminjamanController::class);
    Route::resource('pengembalian', PengembalianController::class);

    // =================================================================
    // ADMINISTRASI (HANYA UNTUK TOOLMAN)
    // =================================================================
    Route::prefix('admin')->name('admin.')->middleware('can:is-toolman')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
    });
});