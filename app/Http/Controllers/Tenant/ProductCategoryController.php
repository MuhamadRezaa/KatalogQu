<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Tenant;
use App\Models\UserStore;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tenant $tenant)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $categories = ProductCategory::where('user_store_id', $userStore->id)
            ->orderBy('name')
            ->get();

        return view('tenant.admin.pages.categories.index', compact('userStore', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Tenant $tenant)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,NULL,id,user_store_id,' . $userStore->id,
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['user_store_id'] = $userStore->id;
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $uploaded = $request->file('image');
            $filename = $validated['slug'] . '.png';
            $path = 'categories/' . $filename;

            // Check if the uploaded file is already a PNG
            if ($uploaded->getClientMimeType() === 'image/png') {
                // If it's already PNG, store it directly without re-encoding
                $uploaded->storeAs('categories', $filename, 'public');
            } else {
                // For other formats (JPEG, WEBP), process with Intervention Image
                $manager = new ImageManager(new Driver());
                $img = $manager->read($uploaded->getRealPath());

                // Resize to max 410x512 (4:5 aspect ratio), maintain aspect ratio, prevent upsizing
                $img->resize(410, 512, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // Encode to PNG
                $encodedPng = $img->toPng();

                // Store the processed image
                Storage::disk('public')->put($path, (string) $encodedPng);
            }
            $validated['image'] = $path;
        }

        return redirect()->route('tenant.admin.categories.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant, ProductCategory $category)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($category->user_store_id !== $userStore->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        return response()->json(['success' => true, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Tenant $tenant, Request $request, ProductCategory $category)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($category->user_store_id !== $userStore->id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,' . $category->id . ',id,user_store_id,' . $userStore->id,
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $uploaded = $request->file('image');
            $filename = $validated['slug'] . '.png';
            $path = 'categories/' . $filename;

            // Check if the uploaded file is already a PNG
            if ($uploaded->getClientMimeType() === 'image/png') {
                // If it's already PNG, store it directly without re-encoding
                $uploaded->storeAs('categories', $filename, 'public');
            } else {
                // For other formats (JPEG, WEBP), process with Intervention Image
                $manager = new ImageManager(new Driver());
                $img = $manager->read($uploaded->getRealPath());

                // Resize to max 410x512 (4:5 aspect ratio), maintain aspect ratio, prevent upsizing
                $img->resize(410, 512, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // Encode to PNG
                $encodedPng = $img->toPng();

                // Store the processed image
                Storage::disk('public')->put($path, (string) $encodedPng);
            }
            $validated['image'] = $path;
        }

        $category->update($validated);

        return redirect()->route('tenant.admin.categories.index', ['tenant' => $userStore->tenant_id])->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant, ProductCategory $category)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($category->user_store_id !== $userStore->id) {
            abort(403);
        }

        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('tenant.admin.categories.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Category deleted successfully!');
    }
}
