<?php

namespace App\Http\Controllers\Tenant;

use App\Models\ProductUnit;
use App\Models\UserStore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $productUnits = ProductUnit::where('user_store_id', $userStore->id)
            ->latest()
            ->get();

        return view('tenant.admin.pages.product-units.index', compact('userStore', 'productUnits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $validated = $request->validate([
            'unit_name' => 'required|string|max:255|unique:product_units,unit_name,NULL,id,user_store_id,' . $userStore->id,
            'unit_code' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['user_store_id'] = $userStore->id;

        ProductUnit::create($validated);

        return redirect()->route('tenant.admin.product-units.index')
            ->with('success', 'Product Unit created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductUnit $productUnit)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($productUnit->user_store_id !== $userStore->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        return response()->json(['success' => true, 'productUnit' => $productUnit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductUnit $productUnit)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($productUnit->user_store_id !== $userStore->id) {
            abort(403);
        }

        $validated = $request->validate([
            'unit_name' => 'required|string|max:255|unique:product_units,unit_name,' . $productUnit->id . ',id,user_store_id,' . $userStore->id,
            'unit_code' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $productUnit->update($validated);

        return redirect()->route('tenant.admin.product-units.index')->with('success', 'Product Unit updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductUnit $productUnit)
    {
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($productUnit->user_store_id !== $userStore->id) {
            abort(403);
        }

        $productUnit->delete();

        return redirect()->route('tenant.admin.product-units.index')
            ->with('success', 'Product Unit deleted successfully!');
    }
}
