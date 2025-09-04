<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\UserStore; // Import UserStore model
use App\Models\StoreAdmin; // Import StoreAdmin model
use Stancl\Tenancy\Facades\Tenancy; // Import Tenancy facade

class CheckTenantAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ensure tenancy is initialized (should be by this point for tenant routes)
        if (!Tenancy::initialized()) {
            // If not initialized, it's likely a central domain request trying to access tenant admin
            // or an issue with tenancy setup. Redirect to central login or 404.
            return redirect()->route('login'); // Or abort(404)
        }

        // 1. Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to central login if not logged in
        }

        $user = Auth::user();
        $tenant = tenant(); // Get the current tenant instance

        // 2. Find the UserStore associated with this tenant
        $userStore = UserStore::where('tenant_id', $tenant->id)->first();

        // 3. Check if the authenticated user is an admin for this UserStore
        $storeAdmin = StoreAdmin::where('user_id', $user->id)
            ->where('store_id', $userStore->id)
            ->where('role', 'owner') // Check only for owner role
            ->first();

        if (!$storeAdmin) {
            // User is not an admin for this store
            Auth::logout(); // Log out the user
            return redirect()->route('profile.show')->withErrors(['auth' => 'You do not have administrative access to this store.']);
        }

        // If all checks pass, allow the request to proceed
        return $next($request);
    }
}
