<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TolakAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika ada orang yang sedang login...
        if (auth()->check()) {
            $role = auth()->user()->role;
            
            // Dan ternyata dia adalah Admin (0) atau Super Admin (1)...
            if ($role == 0 || $role == 1) {
                // Langsung tendang dia kembali ke Admin Panel!
                return redirect()->route('backend.beranda')->with('success', 'Anda sedang login sebagai Admin. Mengalihkan ke Ruang Kendali...');
            }
        }

        // Jika dia adalah tamu (belum login) atau Pelanggan (2), silakan masuk ke Beranda
        return $next($request);
    }
}