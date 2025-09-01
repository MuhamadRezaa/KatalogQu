<?php

namespace App\Http\Controllers\Tenant;

use App\Models\User;
use App\Models\UserStore;
use App\Models\StoreProduct;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $tenant = tenant();
        $userStore = UserStore::where('tenant_id', $tenant->id)->first();

        if (!$userStore) {
            abort(404, 'Store not found for this tenant');
        }

        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'store_description' => 'nullable|string|max:1000',
            'store_phone' => 'nullable|string|max:20',
            'store_email' => 'nullable|email|max:255',
            'store_address' => 'nullable|string|max:500',
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'store_settings' => 'nullable|array'
        ]);

        // Handle logo upload
        if ($request->hasFile('store_logo')) {
            // Delete old logo if exists
            if ($userStore->store_logo && Storage::disk('public')->exists($userStore->store_logo)) {
                Storage::disk('public')->delete($userStore->store_logo);
            }

            $validated['store_logo'] = $request->file('store_logo')->store('store-logos', 'public');
        }

        $userStore->update($validated);

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
