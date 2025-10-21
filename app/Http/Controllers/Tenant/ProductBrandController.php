<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Tenant;
use App\Models\UserStore;
use App\Models\StoreBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['user_store_id'] = $userStore->id;
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $uploaded = $request->file('image');
            $filename = $validated['slug'] . '.png';
            $path = 'brands/' . $filename;

            // Check if the uploaded file is already a PNG
            if ($uploaded->getClientMimeType() === 'image/png') {
                // If it's already PNG, store it directly without re-encoding
                $uploaded->storeAs('brands', $filename, 'public');
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

        StoreBrand::create($validated);

        return redirect()->route('tenant.admin.brands.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Merek berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant, StoreBrand $brand)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($brand->user_store_id !== $userStore->id) {
            return response()->json(['success' => false, 'message' => 'Tidak Sah'], 403);
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
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($brand->image && Storage::disk('public')->exists($brand->image)) {
                Storage::disk('public')->delete($brand->image);
            }

            $uploaded = $request->file('image');
            $filename = $validated['slug'] . '.png';
            $path = 'brands/' . $filename;

            // Check if the uploaded file is already a PNG
            if ($uploaded->getClientMimeType() === 'image/png') {
                // If it's already PNG, store it directly without re-encoding
                $uploaded->storeAs('brands', $filename, 'public');
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

        $brand->update($validated);

        return redirect()->route('tenant.admin.brands.index', ['tenant' => $userStore->tenant_id])->with('success', 'Merek berhasil diperbarui!');
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
            ->with('success', 'Merek berhasil dihapus!');
    }
}
