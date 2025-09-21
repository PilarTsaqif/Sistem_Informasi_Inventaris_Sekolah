<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    // ... properti lainnya

    public function boot(): void
    {
        $this->registerPolicies();

        // Gate untuk mengecek apakah user adalah Toolman (admin)
        Gate::define('is-toolman', function (User $user) {
            return $user->role->role_name === 'TOOLMAN';
        });

        // Gate untuk mengecek apakah user memiliki akses view
        Gate::define('can-view', function (User $user) {
            $allowedRoles = ['TOOLMAN', 'KAPRODI', 'GURU', 'SISWA'];
            return in_array($user->role->role_name, $allowedRoles);
        });
    }
}