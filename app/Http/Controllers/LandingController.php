<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * [BARU] Method untuk menampilkan halaman selamat datang (welcome page).
     * Route '/' sekarang akan memanggil method ini.
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * [DIHAPUS/DIKOMENTARI] Method lama ini tidak lagi digunakan
     * oleh route utama ('/'). Anda bisa menghapusnya jika mau.
     * Halaman 'landing_page.blade.php' yang dipanggil di sini sudah digantikan
     * oleh halaman 'welcome.blade.php' yang lebih lengkap.
     */
    // public function index()
    // {
    //     return view('landing_page');
    // }
}