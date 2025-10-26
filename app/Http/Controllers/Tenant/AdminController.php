<?php

namespace App\Http\Controllers\Tenant;

use App\Models\User;
use App\Models\Tenant;
use App\Models\UserStore;
use App\Models\StoreProduct;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu; // Add this import
use Illuminate\Support\Facades\Storage;
use App\Models\StoreCategory; // Add this import
use Illuminate\Support\Facades\Log; // Gemini Added
use Illuminate\Support\Facades\Cache;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminController extends Controller
{
    /**
     * Store admin dashboard - tenant-specific
     */
    public function dashboard(Tenant $tenant)
    {
        tenancy()->initialize($tenant);
        // Get user store data for this tenant
        $userStore = UserStore::where('tenant_id', $tenant->id)->first();

        if ($userStore !== null && $userStore->user_id !== Auth::id()) {
            abort(403, 'UNAUTHORIZED ACTION.');
        }

        if (!$userStore) {
            abort(404, 'Store not found for this tenant');
        }

        // --- Start of new logic for dynamic menus ---
        $menus = []; // Initialize as empty array

        // Get the store category ID for the current user's store
        $currentStoreCategoryId = $userStore->catalogTemplate->categories_store_id;

        // Fetch the StoreCategory model with its associated menus
        $storeCategory = StoreCategory::find($currentStoreCategoryId);

        if ($storeCategory) {
            // Pluck the 'code' from the associated menus and convert to an array
            $menus = $storeCategory->menus->pluck('code')->toArray();
        }
        // --- End of new logic for dynamic menus ---


        // Get store statistics
        $stats = [
            'total_products' => StoreProduct::where('user_store_id', $userStore->id)->count(),
            'active_products' => StoreProduct::where('user_store_id', $userStore->id)
                ->where('is_active', true)->count(),
            'total_categories' => ProductCategory::count(),
            'total_orders' => 0, // Placeholder for orders when implemented
        ];

        // Get recent products
        $recentProducts = StoreProduct::where('user_store_id', $userStore->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('tenant.admin.pages.dashboard', compact('userStore', 'stats', 'recentProducts', 'menus')); // Pass 'menus' to the view
    }

    /**
     * Store settings
     */
    public function settings(Tenant $tenant)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', $tenant->id)->first();

        if (!$userStore) {
            abort(404, 'Store not found for this tenant');
        }

        return view('tenant.admin.pages.settings.index', compact('userStore'));
    }

    /**
     * Update store settings
     */
    public function updateSettings(Request $request, Tenant $tenant)
    {
        Log::info('UpdateSettings: Starting settings update process.');
        tenancy()->initialize($tenant);
        //$tenant = tenant();
        $userStore = UserStore::where('tenant_id', $tenant->id)->first();

        if (!$userStore) {
            Log::error('UpdateSettings: UserStore not found for tenant ' . $tenant->id);
            abort(404, 'Store not found for this tenant');
        }

        Log::info('UpdateSettings: Validating request data.', $request->all());
        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'store_description' => 'nullable|string|max:1000',
            'store_phone' => 'nullable|string|max:20',
            'store_email' => 'nullable|email|max:255',
            'store_address' => 'nullable|string|max:500',
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'store_settings' => 'nullable|array'
        ]);

        try {
            // Handle logo upload
            if ($request->hasFile('store_logo')) {
                Log::info('UpdateSettings: store_logo file is present. Applying Intervention Image compression.');

                // Use the tenant-aware 'public' disk to store the logo
                $disk = Storage::disk('public');

                // Delete old logo if exists
                if ($userStore->store_logo && $disk->exists($userStore->store_logo)) {
                    Log::info('UpdateSettings: Deleting old logo: ' . $userStore->store_logo);
                    $disk->delete($userStore->store_logo);
                }

                $manager   = new ImageManager(new Driver());
                $uploaded  = $request->file('store_logo');
                $storeName = \Illuminate\Support\Str::slug($validated['store_name']);

                // Baca gambar
                $img = $manager->read($uploaded->getRealPath());

                // Commented out: Resize logo: max 512x512, maintain aspect ratio, prevent upscaling
                /*
                $img->resize(512, 512, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                */

                // Encode to a lightweight WEBP
                $encodedWebp = $img->toWebp(80); // Quality 80

                // Nama & path simpan (pakai .webp karena sudah di-encode WEBP)
                $filename = $storeName . '-logo-' . time() . '.webp';
                $path     = 'store-logos/' . $filename;

                // Simpan HASIL OLAHAN ke disk 'public'
                $disk->put($path, (string) $encodedWebp);

                // Simpan path untuk DB
                $validated['store_logo'] = $path;
                Log::info('UpdateSettings: New compressed logo stored at path: ' . $path);
            } else {
                Log::info('UpdateSettings: No store_logo file in request.');
            }

            Log::info('UpdateSettings: Updating UserStore with validated data.', $validated);
            $userStore->update($validated);
            Log::info('UpdateSettings: UserStore updated successfully.');

            // Clear the cache for this store so changes appear immediately on the subdomain
            Cache::forget("store_{$userStore->subdomain}");
        } catch (\Exception $e) {
            Log::error('UpdateSettings: An error occurred during the update process.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'An unexpected error occurred. Please check the logs.');
        }

        return redirect()->route('tenant.admin.settings', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Pengaturan Toko berhasil diperbarui!');
    }

}
