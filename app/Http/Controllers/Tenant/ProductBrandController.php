<?php

namespace App\Http\Controllers\Tenant;

use App\Models\UserStore;
use App\Models\StoreBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $brands = StoreBrand::where('user_store_id', $userStore->id)
            ->orderBy('name')
            ->get();

        return view('tenant.admin.pages.brands.index', compact('userStore', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_brands,name,NULL,id,user_store_id,' . $userStore->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['user_store_id'] = $userStore->id;
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('brands', 'public');
        }

        StoreBrand::create($validated);

        return redirect()->route('tenant.admin.brands.index')
            ->with('success', 'Brand created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StoreBrand $brand)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($brand->user_store_id !== $userStore->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        return response()->json(['success' => true, 'brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoreBrand $brand)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($brand->user_store_id !== $userStore->id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_brands,name,' . $brand->id . ',id,user_store_id,' . $userStore->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($brand->image && Storage::disk('public')->exists($brand->image)) {
                Storage::disk('public')->delete($brand->image);
            }
            $validated['image'] = $request->file('image')->store('brands', 'public');
        }

        $brand->update($validated);

        return redirect()->route('tenant.admin.brands.index')->with('success', 'Brand updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreBrand $brand)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($brand->user_store_id !== $userStore->id) {
            abort(403);
        }

        if ($brand->image && Storage::disk('public')->exists($brand->image)) {
            Storage::disk('public')->delete($brand->image);
        }

        $brand->delete();

        return redirect()->route('tenant.admin.brands.index')
            ->with('success', 'Brand deleted successfully!');
    }
}
