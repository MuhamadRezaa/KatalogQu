<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Tenant;
use App\Models\UserStore;
use App\Models\StoreBrand;
use App\Models\ProductUnit;
use App\Models\ProductImage;
use App\Models\StoreProduct;
use Illuminate\Http\Request;
use App\Models\StoreCategory;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class StoreProductController extends Controller
{
    private function processAndStoreProductImage($imageFile, $slug, $folder, $position = null)
    {
        $manager = new ImageManager(new Driver());
        $filename = $slug;
        if ($position) {
            $filename .= '-' . $position;
        }
        $filename .= '-' . \Illuminate\Support\Str::random(6) . '.webp'; // Add random string to ensure uniqueness
        $path = $folder . '/' . $filename;

        // Check if the uploaded file is already a WEBP
        if ($imageFile->getClientMimeType() === 'image/webp') {
            // If it's already WEBP, store it directly
            $imageFile->storeAs($folder, $filename, 'public');
        } else {
            // For other formats (JPEG, PNG), process with Intervention Image
            $img = $manager->read($imageFile->getRealPath());

            // Commented out: Resize to max 1350x1080 (5:4 aspect ratio), maintain aspect ratio, prevent upsizing
            /*
            $img->resize(1080, 1350, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            */

            // Encode to WEBP
            $encodedWebp = $img->toWebp(80); // Quality 80

                    try {

                        Storage::disk('public')->put($path, (string) $encodedWebp);

                        Log::info('Image successfully stored at: ' . $path);

                    } catch (\Exception $e) {

                        Log::error('Failed to store processed image at ' . $path . ': ' . $e->getMessage());

                        throw $e; // Re-throw the exception to propagate the error

                    }

            
        }
        return $path;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Tenant $tenant)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $products = StoreProduct::where('user_store_id', $userStore->id)
            ->with(['category', 'brand', 'subCategory', 'images'])
            ->orderBy('name')
            ->get();

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


        $categories = ProductCategory::where('user_store_id', $userStore->id)->active()->orderBy('name')->get();
        $subCategories = ProductSubCategory::where('user_store_id', $userStore->id)->active()->orderBy('name')->get();
        $brands = StoreBrand::where('user_store_id', $userStore->id)->active()->orderBy('name')->get();
        $productUnits = ProductUnit::where('user_store_id', $userStore->id)->orderBy('unit_name')->get();

        return view('tenant.admin.pages.products.index', compact('userStore', 'products', 'categories', 'subCategories', 'brands', 'productUnits', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Tenant $tenant, Request $request)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        if ($userStore->products()->count() >= 200) {
            return redirect()->route('tenant.admin.products.index', ['tenant' => $userStore->tenant_id])
                ->with('error', 'Anda telah mencapai jumlah produk maksimum (200).');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:store_products,name,NULL,id,user_store_id,' . $userStore->id,
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:5120', // Removed jpg, as output is webp
            'product_category_id' => 'nullable|exists:product_categories,id,user_store_id,' . $userStore->id . ',is_active,1',
            'brand_id' => 'nullable|exists:product_brands,id',
            'sub_category_id' => 'nullable|exists:product_sub_categories,id',
            'product_unit_id' => 'nullable|exists:product_units,id',
            'specification' => 'nullable|array',
            'specification.*.key' => 'nullable|string|max:255',
            'specification.*.value' => 'nullable|string|max:1000',
            'old_price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'is_new' => 'boolean',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'is_promo' => 'boolean', // Add this line
            'estimasi_waktu' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:255',
            'additional_images' => 'array|max:3',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,webp|max:5120',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['user_store_id'] = $userStore->id;
        $validated['is_active'] = $request->has('is_active');
        $validated['is_new'] = $request->has('is_new');
        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_promo'] = $request->has('is_promo');

        // Generate SKU if not provided or empty
        if (empty($validated['sku'])) {
            $validated['sku'] = \Illuminate\Support\Str::slug($validated['name']) . '-' . \Illuminate\Support\Str::random(6);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $this->processAndStoreProductImage($request->file('image'), $validated['slug'], 'products');
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
        $validated['specification'] = $specifications;

        try {
            $product = StoreProduct::create($validated);
            Log::info('Product created successfully: ' . $product->id);
        } catch (\Exception $e) {
            Log::error('Failed to create product: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal membuat produk: ' . $e->getMessage());
        }

        // Handle additional images
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $position => $imageFile) {
                if ($imageFile) {
                    try {
                        $imagePath = $this->processAndStoreProductImage(
                            $imageFile,
                            $product->slug,
                            'product_gallery',
                            $position + 1
                        );
                        ProductImage::create([
                            'product_id' => $product->id,
                            'image_url' => $imagePath,
                            'position' => $position + 1, // 1-based position
                            'alt' => $product->name . ' - ' . ($position + 1),
                        ]);
                        Log::info('Additional image created successfully for product ' . $product->id . ': ' . $imagePath);
                    } catch (\Exception $e) {
                        Log::error('Failed to create additional image for product ' . $product->id . ': ' . $e->getMessage());
                        // Continue to process other images or handle as needed
                    }
                }
            }
        }

        return redirect()->route('tenant.admin.products.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Produk berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant, $product)
    {
        tenancy()->initialize($tenant);
        $product = StoreProduct::findOrFail($product);

        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($product->user_store_id !== $userStore->id) {
            return response()->json(['success' => false, 'message' => 'Tidak Sah'], 403);
        }
        // Eager load images
        $product->load('images');

        // Decode specification for display
        $specifications = [];
        // Because of the 'array' cast on the model, $product->specification is already an array.
        if (is_array($product->specification)) {
            foreach ($product->specification as $key => $value) {
                $specifications[] = ['key' => $key, 'value' => $value];
            }
        }
        $product->specification = $specifications; // Pass as array of objects for form

        return response()->json(['success' => true, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Tenant $tenant, Request $request, StoreProduct $product)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($product->user_store_id !== $userStore->id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:store_products,name,' . $product->id . ',id,user_store_id,' . $userStore->id,
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:5120', // Removed jpg, as output is webp
            'product_category_id' => 'nullable|exists:product_categories,id',
            'brand_id' => 'nullable|exists:product_brands,id',
            'sub_category_id' => 'nullable|exists:product_sub_categories,id',
            'product_unit_id' => 'nullable|exists:product_units,id',
            'specification' => 'nullable|array', // Changed to array
            'specification.*.key' => 'nullable|string|max:255', // Validation for key-value pairs
            'specification.*.value' => 'nullable|string|max:1000', // Validation for key-value pairs
            'old_price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'is_new' => 'boolean',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'is_promo' => 'boolean', // Add this line
            'estimasi_waktu' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:255',
            'additional_images' => 'array|max:3', // Max 3 additional images
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,webp|max:5120',
            'existing_images_ids' => 'nullable|array', // IDs of images to keep
            'existing_images_ids.*' => 'exists:product_images,id',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        $validated['is_new'] = $request->has('is_new');
        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_promo'] = $request->has('is_promo');

        // Generate SKU if not provided or empty
        if (empty($validated['sku'])) {
            $validated['sku'] = \Illuminate\Support\Str::slug($validated['name']) . '-' . \Illuminate\Support\Str::random(6);
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $this->processAndStoreProductImage($request->file('image'), $validated['slug'], 'products');
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
        $validated['specification'] = $specifications;

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
                    $imagePath = $this->processAndStoreProductImage(
                        $imageFile,
                        $product->slug,
                        'product_gallery',
                        $product->images()->max('position') + 1
                    );
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

        return redirect()->route('tenant.admin.products.index', ['tenant' => $userStore->tenant_id])->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant, StoreProduct $product)
    {
        tenancy()->initialize($tenant);
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

        return redirect()->route('tenant.admin.products.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Produk berhasil dihapus!');
    }
}
