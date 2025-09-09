<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Import Str facade

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->get(); // Mengambil semua menu, bukan paginate
        return view('admin-main.pages.menus.index', compact('menus')); // Menggunakan 'menus' (plural) dan path view yang benar
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:menus,code', // Validasi untuk 'code'
        ]);

        Menu::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return response()->json($menu);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'code' => 'sometimes|required|string|max:255|unique:menus,code,' . $menu->id, // Validasi 'code' unik kecuali untuk ID ini
        ]);

        $data = [];

        if ($request->has('name') && $request->name) {
            $data['name'] = $request->name;
        }

        if ($request->has('code') && $request->code) {
            $data['code'] = $request->code;
        }

        $menu->update($data);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
