<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * Handle an incoming request.
     * $roles akan berisi angka role yang diizinkan (misal: 0, 1)
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Pastikan dia sudah login
        if (!auth()->check()) {
            return redirect('login');
        }

        // 2. Ambil role user yang sedang login
        $userRole = auth()->user()->role;

        // 3. Cek apakah role user tersebut ada di dalam daftar yang diizinkan
        foreach ($roles as $role) {
            if ($userRole == $role) {
                return $next($request); // Izinkan masuk
            }
        }

        // 4. Jika rolenya tidak cocok, tendang ke beranda dengan pesan peringatan
        return redirect()->route('beranda')->with('error', 'Akses Ditolak! Anda tidak memiliki izin untuk membuka halaman tersebut.');
    }
}