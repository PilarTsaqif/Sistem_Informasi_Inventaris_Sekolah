<?php

namespace App\Providers;

use App\Models\Ruangan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Menggunakan View Composer untuk mem-passing data ke view tertentu
        // Kode ini akan berjalan setiap kali view 'layouts.partials.sidebar' dipanggil
        View::composer('layouts.partials.sidebar', function ($view) {
            // Pengecekan ini untuk menghindari error saat menjalankan migrate
            if (Schema::hasTable('ruangans')) {
                 // Mengambil data ruangan dan menyediakannya sebagai variabel '$ruangansForSidebar'
                $view->with('ruangansForSidebar', Ruangan::orderBy('nama_ruangan')->get());
            } else {
                $view->with('ruangansForSidebar', collect());
            }
        });
    }
}