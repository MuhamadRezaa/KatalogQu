<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\StoreCategory;

class StoreCategoryController extends Controller
{
    public function index()
    {
        $storeCategory = StoreCategory::latest()->paginate(10);
        return view('admin-main.pages.kategori-toko.index', compact('storeCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:store_categories,name',
            'description' => 'nullable|string',
        ]);

        StoreCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name),
            'is_active' => true,
        ]);

        return redirect()->route('kategori-toko.index')->with('success', 'Kategori toko berhasil ditambahkan.');
    }

    public function show($id)
    {
        $storeCategory = StoreCategory::findOrFail($id);
        return response()->json($storeCategory);
    }

    public function update(Request $request, $id)
    {
        $storeCategory = StoreCategory::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:store_categories,name,' . $storeCategory->id,
            'description' => 'nullable|string',
        ]);

        $data = [];

        // Only update fields that are provided
        if ($request->has('name') && $request->name) {
            $data['name'] = $request->name;
            $data['slug'] = Str::slug($request->name);
        }

        if ($request->has('description')) {
            $data['description'] = $request->description;
        }

        $storeCategory->update($data);

        return redirect()->route('kategori-toko.index')->with('success', 'Kategori toko berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $storeCategory = StoreCategory::findOrFail($id);
        $storeCategory->delete();
        return redirect()->route('kategori-toko.index')->with('success', 'Kategori toko berhasil dihapus.');
    }
}
