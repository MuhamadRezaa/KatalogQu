<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Tenant;
use App\Models\UserStore;
use App\Models\StoreBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tenant $tenant)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $brands = StoreBrand::where('user_store_id', $userStore->id)
            ->orderBy('name')
            ->get();

        return view('tenant.admin.pages.brands.index', compact('userStore', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Tenant $tenant, Request $request)
    {
        tenancy()->initialize($tenant);
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
            Log::info('File details:', [
                'original_name' => $request->file('image')->getClientOriginalName(),
                'size' => $request->file('image')->getSize(),
                'mime_type' => $request->file('image')->getMimeType(),
                'is_valid' => $request->file('image')->isValid(),
            ]);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = $validated['slug'] . '.' . $extension;

            $validated['image'] = $request->file('image')->storeAs(
                'brands', // folder
                $fileName,    // nama file
                'public'      // disk
            );
        }

        StoreBrand::create($validated);

        return redirect()->route('tenant.admin.brands.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Brand created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant, StoreBrand $brand)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($brand->user_store_id !== $userStore->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        return response()->json(['success' => true, 'brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Tenant $tenant, Request $request, StoreBrand $brand)
    {
        tenancy()->initialize($tenant);
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

            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = $validated['slug'] . '.' . $extension;

            $validated['image'] = $request->file('image')->storeAs(
                'brands',
                $fileName,
                'public'
            );
        }

        $brand->update($validated);

        return redirect()->route('tenant.admin.brands.index', ['tenant' => $userStore->tenant_id])->with('success', 'Brand updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant, StoreBrand $brand)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($brand->user_store_id !== $userStore->id) {
            abort(403);
        }

        if ($brand->image && Storage::disk('public')->exists($brand->image)) {
            Storage::disk('public')->delete($brand->image);
        }

        $brand->delete();

        return redirect()->route('tenant.admin.brands.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Brand deleted successfully!');
    }
}
