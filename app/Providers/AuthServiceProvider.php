<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if ($this->app->runningInConsole()) {
            return;
        }

        // --- DEFINISI SEMUA HAK AKSES ---

        // Untuk role Toolman secara umum
        Gate::define('is-toolman', function (User $user) {
            return strtoupper(optional($user->role)->role_name) === 'TOOLMAN';
        });

        // Untuk mengelola data master (Barang, Kategori, dll.)
        Gate::define('manage-masters', function (User $user) {
            return strtoupper(optional($user->role)->role_name) === 'TOOLMAN';
        });
        
        // Untuk mengelola inventaris (Barang Masuk, Barang Keluar)
        Gate::define('manage-inventory', function (User $user) {
            return strtoupper(optional($user->role)->role_name) === 'TOOLMAN';
        });

        // Untuk mengelola transaksi (Peminjaman, Pengembalian)
        Gate::define('manage-transactions', function (User $user) {
            $roleName = strtoupper(optional($user->role)->role_name);
            return in_array($roleName, ['TOOLMAN', 'GURU']);
        });

        // Untuk melihat laporan
        Gate::define('view-reports', function (User $user) {
            $roleName = strtoupper(optional($user->role)->role_name);
            return in_array($roleName, ['TOOLMAN', 'KAPRODI', 'GURU', 'SISWA']);
        });

        // Untuk mengelola user dan role
        Gate::define('manage-users', function (User $user) {
            return strtoupper(optional($user->role)->role_name) === 'TOOLMAN';
        });
    }
}