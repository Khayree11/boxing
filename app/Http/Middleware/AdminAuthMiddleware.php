<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah session admin_logged_in ada dan bernilai true
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}