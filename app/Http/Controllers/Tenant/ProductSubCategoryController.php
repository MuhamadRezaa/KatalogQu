<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Tenant;
use App\Models\UserStore;
use Illuminate\Http\Request;
use App\Models\ProductSubCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tenant $tenant)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $subCategories = ProductSubCategory::where('user_store_id', $userStore->id)
            ->orderBy('name')
            ->get(); // Pastikan data diambil

        // Pastikan variabel 'subCategories' dikirim ke view
        return view('tenant.admin.pages.sub-categories.index', compact('userStore', 'subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Tenant $tenant, Request $request)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_sub_categories,name,NULL,id,user_store_id,' . $userStore->id,
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $uploaded = $request->file('image');

        if ($uploaded) { // Check if file was uploaded
            $filename = $validated['slug'] . '.webp';
            $path = 'sub-categories/' . $filename;

            // Process with Intervention Image for WebP conversion
            $manager = new ImageManager(new Driver());
            $img = $manager->read($uploaded);

            // Commented out: Resize to max 410x512 (4:5 aspect ratio), maintain aspect ratio, prevent upsizing
            /*
                $img->resize(410, 512, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                */

            // Encode to WEBP
            $encodedWebp = $img->toWebp(80); // Quality 80

            // Store the processed image
            Storage::disk('public')->put($path, (string) $encodedWebp);

            $validated['image'] = $path;
        } else {
            $validated['image'] = null; // Ensure image path is null if no file uploaded
        }

        $validated['user_store_id'] = $userStore->id; // Add this line

        try {
            ProductSubCategory::create($validated);
            Log::info('SubCategory created successfully: ' . $validated['name']);
            return redirect()->route('tenant.admin.sub-categories.index', ['tenant' => $userStore->tenant_id])
                ->with('success', 'Sub Kategori berhasil dibuat!');
        } catch (\Exception $e) {
            Log::error('Failed to create SubCategory: ' . $e->getMessage());
            // If image was uploaded and saved, attempt to delete it to prevent orphaned files
            if (isset($path) && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            return redirect()->back()->withInput()->with('error', 'Gagal membuat Sub Kategori: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant, ProductSubCategory $subCategory)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($subCategory->user_store_id !== $userStore->id) {
            return response()->json(['success' => false, 'message' => 'Tidak Sah'], 403);
        }
        return response()->json(['success' => true, 'subCategory' => $subCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Tenant $tenant, Request $request, ProductSubCategory $subCategory)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($subCategory->user_store_id !== $userStore->id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_sub_categories,name,' . $subCategory->id . ',id,user_store_id,' . $userStore->id,
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $uploaded = $request->file('image');
            // No need for if ($uploaded) here, as hasFile('image') already ensures it's not null
            // Delete old image if exists
            if ($subCategory->image && Storage::disk('public')->exists($subCategory->image)) {
                Storage::disk('public')->delete($subCategory->image);
            }

            $filename = $validated['slug'] . '.webp';
            $path = 'sub-categories/' . $filename;

            // Process with Intervention Image for WebP conversion
            $manager = new ImageManager(new Driver());
            $img = $manager->read($uploaded);

            // Commented out: Resize to max 410x512 (4:5 aspect ratio), maintain aspect ratio, prevent upsizing
            /*
            $img->resize(410, 512, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            */

            // Encode to WEBP
            $encodedWebp = $img->toWebp(80); // Quality 80

            // Store the processed image
            Storage::disk('public')->put($path, (string) $encodedWebp);

            $validated['image'] = $path;
        } else {
            // If no new image is uploaded, retain the existing image path
            $validated['image'] = $subCategory->image;
        }

        $subCategory->update($validated);

        return redirect()->route('tenant.admin.sub-categories.index', ['tenant' => $userStore->tenant_id])->with('success', 'Sub Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant, ProductSubCategory $subCategory)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($subCategory->user_store_id !== $userStore->id) {
            abort(403);
        }

        if ($subCategory->image && Storage::disk('public')->exists($subCategory->image)) {
            Storage::disk('public')->delete($subCategory->image);
        }

        $subCategory->delete();

        return redirect()->route('tenant.admin.sub-categories.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Sub Kategori berhasil dihapus!');
    }
}
