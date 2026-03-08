<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN apakah dia seorang admin
        if (auth()->check() && auth()->user()->isAdmin()) {
            // Jika ya, silakan masuk
            return $next($request);
        }

        // Jika bukan admin (misal: siswa), lemparkan kembali ke dashboard
        // dan berikan pesan error
        return redirect()->route('dashboard')->with('error', 'Akses Ditolak! Halaman ini khusus Administrator.');
    }
}