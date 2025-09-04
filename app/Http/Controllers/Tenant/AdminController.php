<?php

namespace App\Http\Controllers\Tenant;

use App\Models\User;
use App\Models\UserStore;
use App\Models\StoreProduct;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Gemini Added
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Store admin dashboard - tenant-specific
     */
    public function dashboard()
    {
        // Get current tenant info
        $tenant = tenant();

        // Get user store data for this tenant
        $userStore = UserStore::where('tenant_id', $tenant->id)->first();

        if (!$userStore) {
            abort(404, 'Store not found for this tenant');
        }

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

        return view('tenant.admin.pages.dashboard', compact('userStore', 'stats', 'recentProducts'));
    }

    /**
     * Store settings
     */
    public function settings()
    {
        $tenant = tenant();
        $userStore = UserStore::where('tenant_id', $tenant->id)->first();

        if (!$userStore) {
            abort(404, 'Store not found for this tenant');
        }

        return view('tenant.admin.pages.settings.index', compact('userStore'));
    }

    /**
     * Update store settings
     */
    public function updateSettings(Request $request)
    {
        Log::info('UpdateSettings: Starting settings update process.');

        $tenant = tenant();
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
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'store_settings' => 'nullable|array'
        ]);

        try {
            // Handle logo upload
            if ($request->hasFile('store_logo')) {
                Log::info('UpdateSettings: store_logo file is present.');
                
                // Use the central_public disk to store the logo
                $disk = Storage::disk('central_public');

                // Delete old logo if exists
                if ($userStore->store_logo && $disk->exists($userStore->store_logo)) {
                    Log::info('UpdateSettings: Deleting old logo: ' . $userStore->store_logo);
                    $disk->delete($userStore->store_logo);
                }

                Log::info('UpdateSettings: Storing new logo on central_public disk...');
                // Generate a custom filename based on store_name slug
                $storeNameSlug = \Illuminate\Support\Str::slug($validated['store_name']);
                $extension = $request->file('store_logo')->getClientOriginalExtension();
                $filename = $storeNameSlug . '.' . $extension;

                $path = $request->file('store_logo')->storeAs('store-logos', $filename, 'central_public');
                $validated['store_logo'] = $path;
                Log::info('UpdateSettings: New logo stored at path: ' . $path);

            } else {
                Log::info('UpdateSettings: No store_logo file in request.');
            }

            Log::info('UpdateSettings: Updating UserStore with validated data.', $validated);
            $userStore->update($validated);
            Log::info('UpdateSettings: UserStore updated successfully.');

        } catch (\Exception $e) {
            Log::error('UpdateSettings: An error occurred during the update process.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'An unexpected error occurred. Please check the logs.');
        }

        return redirect()->route('tenant.admin.settings')
            ->with('success', 'Store settings updated successfully!');
    }

    /**
     * Products management
     */
    public function products()
    {
        $tenant = tenant();
        $userStore = UserStore::where('tenant_id', $tenant->id)->first();

        if (!$userStore) {
            abort(404, 'Store not found for this tenant');
        }

        $products = StoreProduct::where('user_store_id', $userStore->id)
            ->with(['category', 'brand'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tenant.admin.pages.products.index', compact('userStore', 'products'));
    }

    /**
     * Create product form
     */
    public function createProduct()
    {
        $tenant = tenant();
        $userStore = UserStore::where('tenant_id', $tenant->id)->first();

        if (!$userStore) {
            abort(404, 'Store not found for this tenant');
        }

        $categories = ProductCategory::where('is_active', true)
            ->get();

        return view('tenant.admin.products.create', compact('userStore', 'categories'));
    }

    /**
     * Store product
     */
    public function storeProduct(Request $request)
    {
        $tenant = tenant();
        $userStore = UserStore::where('tenant_id', $tenant->id)->first();

        if (!$userStore) {
            abort(404, 'Store not found for this tenant');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'store_category_id' => 'nullable|exists:product_categories,id',
            'stock' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'is_promo' => 'boolean',
            'is_new' => 'boolean',
            'specification' => 'nullable|array'
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        StoreProduct::create($validated);

        return redirect()->route('tenant.admin.products')
            ->with('success', 'Product created successfully!');
    }

    
}
