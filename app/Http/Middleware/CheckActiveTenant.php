<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserStore;

class CheckActiveTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!tenant()) {
            // If there is no tenant, let the request continue.
            // Other middleware or the application itself will handle it.
            return $next($request);
        }

        $userStore = UserStore::where('tenant_id', tenant('id'))->first();

        if (!$userStore || !$userStore->is_active) {
            // If the store is not found or is inactive, show the inactive view.
            return response(view('tenant.inactive'), 503);
        }

        return $next($request);
    }
}
