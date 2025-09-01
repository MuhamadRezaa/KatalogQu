<?php

namespace App\Http\Controllers\Tenant;

use App\Models\UserStore;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $categories = ProductCategory::where('user_store_id', $userStore->id)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('tenant.admin.pages.categories.index', compact('userStore', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,NULL,id,user_store_id,' . $userStore->id,
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['user_store_id'] = $userStore->id;
        $validated['is_active'] = $request->has('is_active');

        Log::info('Category store request validated.');
        Log::info('Request has file (image): ' . ($request->hasFile('image') ? 'yes' : 'no'));

        if ($request->hasFile('image')) {
            Log::info('File details:', [
                'original_name' => $request->file('image')->getClientOriginalName(),
                'size' => $request->file('image')->getSize(),
                'mime_type' => $request->file('image')->getMimeType(),
                'is_valid' => $request->file('image')->isValid(),
            ]);
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        if (isset($validated['image'])) {
            Log::info('Image path to be saved:', ['path' => $validated['image']]);
        } else {
            Log::info('No image path to be saved.');
        }

        Log::info('Data being passed to create():', $validated);

        ProductCategory::create($validated);

        return redirect()->route('tenant.admin.categories.index')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $category)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($category->user_store_id !== $userStore->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        return response()->json(['success' => true, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $category)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($category->user_store_id !== $userStore->id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,' . $category->id . ',id,user_store_id,' . $userStore->id,
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        return redirect()->route('tenant.admin.categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $category)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($category->user_store_id !== $userStore->id) {
            abort(403);
        }

        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('tenant.admin.categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
