<?php

namespace App\Http\Controllers;

use App\Models\CatalogTemplate;
use App\Models\StoreCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CatalogTemplateController extends Controller
{
    public function index()
    {
        $templates = CatalogTemplate::with('category')->latest()->paginate(10);
        $kategoriTokos = StoreCategory::orderBy('name')->get();
        return view('admin-main.pages.catalog-template.index', compact('templates', 'kategoriTokos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categories_store_id' => 'required|exists:store_categories,id',
            'name' => 'required|string|max:255|unique:catalog_templates,name',
            'description' => 'nullable|string',
            'preview_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        $data = [
            'categories_store_id' => $request->categories_store_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'demo_url' => '/demo/' . Str::slug($request->name),
        ];

        // Handle image upload
        if ($request->hasFile('preview_image')) {
            $file = $request->file('preview_image');
            $slug = Str::slug($request->name);
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '_previmg.' . $extension;
            $imagePath = $file->storeAs('catalog_templates/preview_image', $fileName, 'public');
            $data['preview_image'] = $imagePath;
        }

        CatalogTemplate::create($data);

        return redirect()->route('template.index')->with('success', 'Template katalog berhasil ditambahkan.');
    }

    public function show($id)
    {
        $template = CatalogTemplate::findOrFail($id);
        return response()->json($template);
    }

    public function update(Request $request, $id)
    {
        $template = CatalogTemplate::findOrFail($id);

        $request->validate([
            'categories_store_id' => 'sometimes|required|exists:store_categories,id',
            'name' => 'sometimes|required|string|max:255|unique:catalog_templates,name,' . $template->id,
            'description' => 'nullable|string',
            'preview_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        $data = [];

        // Only update fields that are provided
        if ($request->has('categories_store_id')) {
            $data['categories_store_id'] = $request->categories_store_id;
        }

        if ($request->has('name') && $request->name) {
            $data['name'] = $request->name;
            $data['slug'] = Str::slug($request->name);
            $data['demo_url'] = '/demo/' . Str::slug($request->name);
        }

        if ($request->has('description')) {
            $data['description'] = $request->description;
        }

        if ($request->has('price')) {
            $data['price'] = $request->price;
        }

        // Handle image upload
        if ($request->hasFile('preview_image')) {
            // Delete old image
            if ($template->preview_image) {
                Storage::disk('public')->delete($template->preview_image);
            }

            // Upload new image
            $file = $request->file('preview_image');
            $slug = isset($data['slug']) ? $data['slug'] : $template->slug;
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '_previmg.' . $extension;
            $imagePath = $file->storeAs('catalog_templates/preview_image', $fileName, 'public');
            $data['preview_image'] = $imagePath;
        }

        $template->update($data);

        return redirect()->route('template.index')->with('success', 'Template katalog berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $template = CatalogTemplate::findOrFail($id);

        // Delete the associated image from storage if it exists
        if ($template->preview_image) {
            Storage::disk('public')->delete($template->preview_image);
        }

        $template->delete();
        return redirect()->route('template.index')->with('success', 'Template katalog berhasil dihapus.');
    }
}
