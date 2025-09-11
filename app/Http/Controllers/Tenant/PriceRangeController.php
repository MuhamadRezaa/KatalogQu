<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Tenant;
use App\Models\UserStore;
use App\Models\PriceRange;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PriceRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tenant $tenant)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $priceRanges = PriceRange::where('user_store_id', $userStore->id)
            ->orderBy('min')
            ->get();

        return view('tenant.admin.pages.price-ranges.index', compact('userStore', 'priceRanges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Tenant $tenant, Request $request)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:price_ranges,name,NULL,id,user_store_id,' . $userStore->id,
            'min' => 'nullable|numeric|min:0',
            'max' => 'nullable|numeric|min:0|gt:min',
            'is_active' => 'boolean',
        ]);

        $validated['user_store_id'] = $userStore->id;
        $validated['is_active'] = $request->has('is_active');

        PriceRange::create($validated);

        return redirect()->route('tenant.admin.price-ranges.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Price range created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant, PriceRange $priceRange)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($priceRange->user_store_id !== $userStore->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        return response()->json(['success' => true, 'priceRange' => $priceRange]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Tenant $tenant, Request $request, PriceRange $priceRange)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($priceRange->user_store_id !== $userStore->id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:price_ranges,name,' . $priceRange->id . ',id,user_store_id,' . $userStore->id,
            'min' => 'nullable|numeric|min:0',
            'max' => 'nullable|numeric|min:0|gt:min',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $priceRange->update($validated);

        return redirect()->route('tenant.admin.price-ranges.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Price range updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant, PriceRange $priceRange)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        if ($priceRange->user_store_id !== $userStore->id) {
            abort(403);
        }

        $priceRange->delete();

        return redirect()->route('tenant.admin.price-ranges.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Price range deleted successfully!');
    }
}
