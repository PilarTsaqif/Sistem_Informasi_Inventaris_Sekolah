<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Ruangan; // Import model Ruangan
use Illuminate\Support\Facades\Schema; // Import Schema

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Gunakan View Composer untuk mengirim data ke view sidebar
        // setiap kali view tersebut dimuat.
        View::composer('layouts.partials.sidebar', function ($view) {
            // Cek apakah tabel ruangans ada untuk menghindari error saat migrasi awal
            if (Schema::hasTable('ruangans')) {
                $ruangansForSidebar = Ruangan::orderBy('nama_ruangan')->get();
                $view->with('ruangansForSidebar', $ruangansForSidebar);
            } else {
                $view->with('ruangansForSidebar', collect()); // Kirim koleksi kosong jika tabel belum ada
            }
        });
    }
}