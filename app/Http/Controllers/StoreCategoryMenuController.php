<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\StoreCategory;
use Illuminate\Http\Request;

class StoreCategoryMenuController extends Controller
{
    public function index()
    {
        // Fetch all store categories with their associated menus
        $storeCategories = StoreCategory::with('menus')->get();

        // Fetch all available menus to populate the checkboxes in the modal
        $allMenus = Menu::orderBy('name')->get();

        return view('admin-main.pages.store-category-menus.index', compact('storeCategories', 'allMenus'));
    }

    public function update(Request $request, StoreCategory $store_category_menu)
    {
        $request->validate([
            'menus' => 'nullable|array',
            'menus.*' => 'exists:menus,id', // Ensure all provided menu IDs exist
        ]);

        // Sync the menus for the given store category
        // The sync method accepts an array of IDs to place on the intermediate table.
        // Any IDs not in the array will be removed from the intermediate table.
        // Any IDs in the array that are not already in the intermediate table will be added.
        $store_category_menu->menus()->sync($request->input('menus', []));

        return redirect()->route('store-category-menus.index')->with('success', 'Relasi menu kategori toko berhasil diperbarui.');
    }
}
