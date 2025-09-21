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
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Landing & Auth
Route::get('/', [LandingController::class, 'index'])->name('landing');
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
    // HALAMAN FASILITAS RUANGAN (AKSES CEPAT DARI SIDEBAR)
    // =================================================================
    Route::get('fasilitas/ruangan/{ruangan}', [FasilitasController::class, 'index'])->name('fasilitas.index');
    
    Route::middleware('role:TOOLMAN')->group(function() {
        Route::get('ruangan/{ruangan}/fasilitas/create', [FasilitasController::class, 'create'])->name('fasilitas.create');
        Route::post('ruangan/{ruangan}/fasilitas', [FasilitasController::class, 'store'])->name('fasilitas.store');
        Route::get('ruangan/{ruangan}/fasilitas/{barang}/edit', [FasilitasController::class, 'edit'])->name('fasilitas.edit');
        Route::put('ruangan/{ruangan}/fasilitas/{barang}', [FasilitasController::class, 'update'])->name('fasilitas.update');
        Route::delete('ruangan/{ruangan}/fasilitas/{barang}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');
    });

    // =================================================================
    // DATA MASTER
    // =================================================================
    Route::middleware('role:TOOLMAN')->group(function() {
        Route::resource('barang', BarangController::class)->except(['index', 'show']);
        Route::resource('kategori-barang', KategoriBarangController::class)->except(['index', 'show']);
        Route::resource('satuan', SatuanController::class)->except(['index', 'show']);
        Route::resource('jurusan', JurusanController::class)->except(['show']);
        Route::resource('ruangan', RuanganController::class);
    });
    Route::middleware('role:TOOLMAN,KAPRODI,GURU,SISWA')->group(function() {
        Route::get('barang', [BarangController::class, 'index'])->name('barang.index');
        Route::get('barang/{barang}', [BarangController::class, 'show'])->name('barang.show');
        Route::get('kategori-barang', [KategoriBarangController::class, 'index'])->name('kategori-barang.index');
        Route::get('kategori-barang/{kategoriBarang}', [KategoriBarangController::class, 'show'])->name('kategori-barang.show');
        Route::get('satuan', [SatuanController::class, 'index'])->name('satuan.index');
        Route::get('satuan/{satuan}', [SatuanController::class, 'show'])->name('satuan.show');
        Route::get('jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
    });

    // =================================================================
    // MANAJEMEN INVENTARIS
    // =================================================================
    Route::middleware('role:TOOLMAN')->group(function() {
        Route::resource('barang-masuk', BarangMasukController::class)->except(['index', 'show']);
        Route::resource('barang-keluar', BarangKeluarController::class)->except(['index', 'show']);
    });
    Route::middleware('role:TOOLMAN,KAPRODI,GURU,SISWA')->group(function() {
        Route::get('barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
        Route::get('barang-masuk/{barangMasuk}', [BarangMasukController::class, 'show'])->name('barang-masuk.show');
        Route::get('barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar.index');
        Route::get('barang-keluar/{barangKeluar}', [BarangKeluarController::class, 'show'])->name('barang-keluar.show');
    });
    
    // Laporan Stok Barang
    Route::middleware('role:TOOLMAN,KAPRODI,GURU')->group(function() {
        Route::get('stok-barang', [StokBarangController::class, 'index'])->name('stok-barang.index');
        Route::get('stok-barang/{barang}', [StokBarangController::class, 'show'])->name('stok-barang.show');
    });
    
    // =================================================================
    // TRANSAKSI
    // =================================================================
    Route::middleware('role:TOOLMAN,GURU')->group(function() {
        Route::resource('peminjaman', PeminjamanController::class)->except(['index', 'show']);
        Route::resource('pengembalian', PengembalianController::class)->except(['index', 'show']);
    });
    Route::middleware('role:TOOLMAN,KAPRODI,GURU,SISWA')->group(function() {
        Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('peminjaman/{peminjaman}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
        Route::get('pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
        Route::get('pengembalian/{pengembalian}', [PengembalianController::class, 'show'])->name('pengembalian.show');
    });

    // =================================================================
    // ADMINISTRASI
    // =================================================================
    Route::middleware('role:TOOLMAN')->group(function() {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
    });
});

