<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreHero;
use App\Models\UserStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class StoreHeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userStore = $this->getCurrentStore();
        $heroes = StoreHero::where('user_store_id', $userStore->id)->orderBy('order')->get();
        return view('tenant.admin.pages.store-hero.index', compact('heroes', 'userStore'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userStore = $this->getCurrentStore();

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'button_text' => 'nullable|string|max:255', // Added
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('store_heroes', 'public');
        }

        StoreHero::create([
            'user_store_id' => $userStore->id,
            'image_url' => $imagePath,
            'title' => $validatedData['title'],
            'subtitle' => $validatedData['subtitle'],
            'link' => $validatedData['link'],
            'button_text' => $validatedData['button_text'] ?? null, // Added
            'order' => $validatedData['order'] ?? 0,
            'is_active' => $validatedData['is_active'] ?? true,
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Hero created successfully.']);
        }

        return redirect()->route('tenant.admin.store-heroes.index')->with('success', 'Hero created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StoreHero $storeHero)
    {
        $this->authorizeStoreHero($storeHero);
        return response()->json(['success' => true, 'hero' => $storeHero]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoreHero $storeHero)
    {
        $this->authorizeStoreHero($storeHero);

        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'button_text' => 'nullable|string|max:255', // Added
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $imagePath = $storeHero->image_url;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('store_heroes', 'public');
        }

        $storeHero->update([
            'image_url' => $imagePath,
            'title' => $validatedData['title'],
            'subtitle' => $validatedData['subtitle'],
            'link' => $validatedData['link'],
            'button_text' => $validatedData['button_text'] ?? null, // Added
            'order' => $validatedData['order'] ?? 0,
            'is_active' => $validatedData['is_active'] ?? true,
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Hero updated successfully.']);
        }

        return redirect()->route('tenant.admin.store-heroes.index')->with('success', 'Hero updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreHero $storeHero)
    {
        $this->authorizeStoreHero($storeHero);

        if ($storeHero->image_url) {
            Storage::disk('public')->delete($storeHero->image_url);
        }
        $storeHero->delete();

        return redirect()->route('tenant.admin.store-heroes.index')->with('success', 'Hero deleted successfully.');
    }

    /**
     * Get the current store information.
     */
    private function getCurrentStore()
    {
        $subdomain = request()->getHost();
        $subdomain = explode('.', $subdomain)[0];

        return Cache::remember("store_{$subdomain}", 3600, function () use ($subdomain) {
            return UserStore::where('subdomain', $subdomain)
                ->where('tenant_created', true)
                ->firstOrFail();
        });
    }

    /**
     * Authorize that the storeHero belongs to the current user's store.
     */
    private function authorizeStoreHero(StoreHero $storeHero)
    {
        $userStore = $this->getCurrentStore();
        if ($storeHero->user_store_id !== $userStore->id) {
            abort(403, 'Unauthorized action.');
        }
    }
}
