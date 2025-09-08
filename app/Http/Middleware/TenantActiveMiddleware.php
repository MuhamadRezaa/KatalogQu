<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = tenant();

        // Asumsi: di tabel 'tenants' Anda ada kolom 'status'.
        // Jika statusnya bukan 'active', tampilkan halaman maintenance.
        // Anda bisa sesuaikan logika ini dengan struktur database Anda,
        // misalnya dengan memeriksa relasi ke tabel 'template_purchases' atau 'payments'.
        if ($tenant && $tenant->status !== 'active') {

            // Menggunakan view maintenance yang sudah ada
            // Anda bisa membuat view khusus untuk "toko belum aktif" jika perlu
            return response()->view('tenant.template.default.maintenance', [], 503);
        }

        return $next($request);
    }
}
