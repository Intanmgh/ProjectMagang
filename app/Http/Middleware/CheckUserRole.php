<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika pengguna belum login, arahkan ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Periksa apakah peran pengguna ada di daftar peran yang diizinkan (parameter $roles)
        if (! in_array($user->role, $roles)) {
            // Jika tidak memiliki role yang diizinkan, tampilkan error 403 (Akses Dilarang)
            abort(403, 'Akses Dilarang. Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request); // Lanjutkan ke request jika role diizinkan
    }
}