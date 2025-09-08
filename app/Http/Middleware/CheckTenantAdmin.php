<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StoreAdmin; // Pastikan model StoreAdmin di-import

class CheckTenantAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Dapatkan pengguna yang sedang login dan tenant yang aktif
        $user = Auth::user();
        $tenant = tenant();

        // Jika karena suatu hal tidak ada user atau tenant, tolak akses.
        if (!$user || !$tenant) {
            abort(403, 'ACCESS DENIED');
        }

        // Cek apakah ada data di tabel 'store_admins' yang cocok
        // dengan user_id dari pengguna yang login DAN tenant_id dari toko yang aktif.
        $isAdmin = StoreAdmin::where('user_id', $user->id)
            ->where('tenant_id', $tenant->id)
            ->exists();

        // Jika tidak ditemukan sebagai admin, tolak akses.
        if (!$isAdmin) {
            abort(403, 'You do not have permission to access this page.');
        }

        // Jika ditemukan, izinkan permintaan untuk melanjutkan.
        return $next($request);
    }
}
