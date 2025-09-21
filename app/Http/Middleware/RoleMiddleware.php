<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika user tidak login atau tidak punya model Role
        if (!Auth::check() || !Auth::user()->role) {
            // Arahkan ke halaman login
            return redirect('login');
        }

        // Ambil nama role dari user yang sedang login
        $userRole = Auth::user()->role->role_name;

        // Cek apakah role user ada di dalam daftar role yang diizinkan ($roles)
        if (in_array($userRole, $roles)) {
            // Jika diizinkan, lanjutkan request
            return $next($request);
        }
        
        // Jika tidak diizinkan, tampilkan halaman error 403 (Forbidden)
        abort(403, 'ANDA TIDAK MEMILIKI HAK AKSES.');
    }
}