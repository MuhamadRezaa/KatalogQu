<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Tenant;
use App\Models\UserStore;
use Illuminate\Http\Request;
use App\Models\ProductSubCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
            ->get();

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['user_store_id'] = $userStore->id;
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            Log::info('File details:', [
                'original_name' => $request->file('image')->getClientOriginalName(),
                'size' => $request->file('image')->getSize(),
                'mime_type' => $request->file('image')->getMimeType(),
                'is_valid' => $request->file('image')->isValid(),
            ]);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = $validated['slug'] . '.' . $extension;

            $validated['image'] = $request->file('image')->storeAs(
                'sub-categories', // folder
                $fileName,    // nama file
                'public'      // disk
            );
        }

        ProductSubCategory::create($validated);

        return redirect()->route('tenant.admin.sub-categories.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Sub Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant, ProductSubCategory $subCategory)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($subCategory->user_store_id !== $userStore->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($subCategory->image && Storage::disk('public')->exists($subCategory->image)) {
                Storage::disk('public')->delete($subCategory->image);
            }

            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = $validated['slug'] . '.' . $extension;

            $validated['image'] = $request->file('image')->storeAs(
                'sub-categories',
                $fileName,
                'public'
            );
        }

        $subCategory->update($validated);

        return redirect()->route('tenant.admin.sub-categories.index', ['tenant' => $userStore->tenant_id])->with('success', 'Sub Category updated successfully!');
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
            ->with('success', 'Sub Category deleted successfully!');
    }
}
