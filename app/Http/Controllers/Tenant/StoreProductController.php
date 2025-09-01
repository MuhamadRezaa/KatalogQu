<?php

namespace App\Http\Controllers\Tenant;

use App\Models\UserStore;
use App\Models\StoreProduct;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\StoreBrand;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class StoreProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $products = StoreProduct::where('user_store_id', $userStore->id)
            ->with(['category', 'brand', 'subCategory', 'images'])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $categories = ProductCategory::where('user_store_id', $userStore->id)->active()->orderBy('name')->get();
        $subCategories = ProductSubCategory::where('user_store_id', $userStore->id)->active()->orderBy('name')->get();
        $brands = StoreBrand::where('user_store_id', $userStore->id)->active()->orderBy('name')->get();

        return view('tenant.admin.pages.products.index', compact('userStore', 'products', 'categories', 'subCategories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:store_products,name,NULL,id,user_store_id,' . $userStore->id,
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'product_category_id' => 'nullable|exists:product_categories,id,user_store_id,' . $userStore->id . ',is_active,1',
            'brand_id' => 'nullable|exists:product_brands,id',
            'sub_category_id' => 'nullable|exists:product_sub_categories,id',
            'specification' => 'nullable|array',
            'specification.*.key' => 'nullable|string|max:255',
            'specification.*.value' => 'nullable|string|max:1000',
            'stock' => 'nullable|integer|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'is_promo' => 'boolean',
            'is_new' => 'boolean',
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
            'estimasi_waktu' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'additional_images' => 'array|max:3',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['user_store_id'] = $userStore->id;
        $validated['is_active'] = $request->has('is_active');
        $validated['is_promo'] = $request->has('is_promo');
        $validated['is_new'] = $request->has('is_new');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_available'] = $request->has('is_available');

        // Generate SKU if not provided or empty
        if (empty($validated['sku'])) {
            $validated['sku'] = \Illuminate\Support\Str::slug($validated['name']) . '-' . \Illuminate\Support\Str::random(6);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Process structured specification
        $specifications = [];
        if (isset($validated['specification']) && is_array($validated['specification'])) {
            foreach ($validated['specification'] as $spec) {
                if (!empty($spec['key']) && !empty($spec['value'])) {
                    $specifications[$spec['key']] = $spec['value'];
                }
            }
        }
        $validated['specification'] = json_encode($specifications);

        $product = StoreProduct::create($validated);

        // Handle additional images
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $position => $imageFile) {
                if ($imageFile) {
                    $imagePath = $imageFile->store('product_gallery', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_url' => $imagePath,
                        'position' => $position + 1, // 1-based position
                        'alt' => $product->name . ' - ' . ($position + 1),
                    ]);
                }
            }
        }

        return redirect()->route('tenant.admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StoreProduct $product)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($product->user_store_id !== $userStore->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        // Eager load images
        $product->load('images');

        // Decode specification for display
        $specifications = [];
        if ($product->specification) {
            $decodedSpec = json_decode($product->specification, true);
            if (is_array($decodedSpec)) {
                foreach ($decodedSpec as $key => $value) {
                    $specifications[] = ['key' => $key, 'value' => $value];
                }
            }
        }
        $product->specification = $specifications; // Pass as array of objects for form

        return response()->json(['success' => true, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoreProduct $product)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($product->user_store_id !== $userStore->id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:store_products,name,' . $product->id . ',id,user_store_id,' . $userStore->id,
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'brand_id' => 'nullable|exists:product_brands,id',
            'sub_category_id' => 'nullable|exists:product_sub_categories,id',
            'specification' => 'nullable|array', // Changed to array
            'specification.*.key' => 'nullable|string|max:255', // Validation for key-value pairs
            'specification.*.value' => 'nullable|string|max:1000', // Validation for key-value pairs
            'stock' => 'nullable|integer|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'is_promo' => 'boolean',
            'is_new' => 'boolean',
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
            'estimasi_waktu' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'additional_images' => 'array|max:3', // Max 3 additional images
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'existing_images_ids' => 'nullable|array', // IDs of images to keep
            'existing_images_ids.*' => 'exists:product_images,id',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        $validated['is_promo'] = $request->has('is_promo');
        $validated['is_new'] = $request->has('is_new');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_available'] = $request->has('is_available');

        // Generate SKU if not provided or empty
        if (empty($validated['sku'])) {
            $validated['sku'] = \Illuminate\Support\Str::slug($validated['name']) . '-' . \Illuminate\Support\Str::random(6);
        }

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Process structured specification
        $specifications = [];
        if (isset($validated['specification']) && is_array($validated['specification'])) {
            foreach ($validated['specification'] as $spec) {
                if (!empty($spec['key']) && !empty($spec['value'])) {
                    $specifications[$spec['key']] = $spec['value'];
                }
            }
        }
        $validated['specification'] = json_encode($specifications);

        $product->update($validated);

        // Handle additional images update
        $existingImageIds = $validated['existing_images_ids'] ?? [];
        $product->images()->whereNotIn('id', $existingImageIds)->each(function ($image) {
            if (Storage::disk('public')->exists($image->image_url)) {
                Storage::disk('public')->delete($image->image_url);
            }
            $image->delete();
        });

        if ($request->hasFile('additional_images')) {
            $currentImageCount = $product->images()->count();
            $allowedNewImages = 3 - $currentImageCount; // Max 3 total additional images

            foreach ($request->file('additional_images') as $position => $imageFile) {
                if ($imageFile && $allowedNewImages > 0) {
                    $imagePath = $imageFile->store('product_gallery', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_url' => $imagePath,
                        'position' => $product->images()->max('position') + 1, // Next available position
                        'alt' => $product->name . ' - ' . ($product->images()->max('position') + 1),
                    ]);
                    $allowedNewImages--;
                }
            }
        }

        return redirect()->route('tenant.admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreProduct $product)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($product->user_store_id !== $userStore->id) {
            abort(403);
        }

        // Delete main image
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Delete additional images
        $product->images->each(function ($image) {
            if (Storage::disk('public')->exists($image->image_url)) {
                Storage::disk('public')->delete($image->image_url);
            }
            $image->delete();
        });

        $product->delete();

        return redirect()->route('tenant.admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
