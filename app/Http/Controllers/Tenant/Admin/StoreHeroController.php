<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Models\Tenant;
use App\Models\StoreHero;
use App\Models\UserStore;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class StoreHeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tenant $tenant)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        $heroes = StoreHero::where('user_store_id', $userStore->id)->get();
        return view('tenant.admin.pages.store-hero.index', compact('heroes', 'userStore'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Tenant $tenant, Request $request)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'button_text' => 'nullable|string|max:255', // Added
            'is_active' => 'boolean',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $disk      = Storage::disk('public');
            $dir       = 'store_heroes'; // folder tujuan
            $ext       = $request->file('image')->getClientOriginalExtension();
            $baseSlug  = Str::slug($userStore->store_name);           // dasar nama file
            $candidate = "{$baseSlug}.{$ext}";                        // coba tanpa suffix dulu
            $path      = "{$dir}/{$candidate}";
            $i = 1;

            // Jika sudah ada, tambahkan -1, -2, dst.
            while ($disk->exists($path)) {
                $candidate = "{$baseSlug}-{$i}.{$ext}";
                $path = "{$dir}/{$candidate}";
                $i++;
            }

            // Simpan dengan nama final
            $imagePath = $request->file('image')->storeAs($dir, $candidate, 'public');
        }

        StoreHero::create([
            'user_store_id' => $userStore->id,
            'image_url' => $imagePath,
            'title' => $validatedData['title'],
            'subtitle' => $validatedData['subtitle'],
            'link' => $validatedData['link'],
            'button_text' => $validatedData['button_text'] ?? null, // Added
            'is_active' => $validatedData['is_active'] ?? true,
        ]);

        if ($request->ajax() || $request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Hero created successfully.']);
        }
        return redirect()->route('tenant.admin.store-heroes.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Hero created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant, StoreHero $storeHero)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($storeHero->user_store_id !== $userStore->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        return response()->json(['success' => true, 'hero' => $storeHero]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Tenant $tenant, Request $request, StoreHero $storeHero)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($storeHero->user_store_id !== $userStore->id) {
            abort(403);
        }

        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'button_text' => 'nullable|string|max:255', // Added
            'is_active' => 'boolean',
        ]);

        $imagePath = $storeHero->image_url;

        if ($request->hasFile('image')) {
            $disk = Storage::disk('public');

            // Hapus file lama jika ada
            if ($imagePath && $disk->exists($imagePath)) {
                $disk->delete($imagePath);
            }

            $dir      = 'store_heroes';
            $ext      = $request->file('image')->getClientOriginalExtension();
            $baseSlug = Str::slug($userStore->store_name);

            // Coba tanpa suffix dulu
            $candidate = "{$baseSlug}.{$ext}";
            $path      = "{$dir}/{$candidate}";
            $i = 1;

            // Jika sudah ada, tambahkan -1, -2, dst.
            while ($disk->exists($path)) {
                $candidate = "{$baseSlug}-{$i}.{$ext}";
                $path      = "{$dir}/{$candidate}";
                $i++;
            }

            // Simpan dengan nama final
            $imagePath = $request->file('image')->storeAs($dir, $candidate, 'public');
        }

        $storeHero->update([
            'image_url' => $imagePath,
            'title' => $validatedData['title'],
            'subtitle' => $validatedData['subtitle'],
            'link' => $validatedData['link'],
            'button_text' => $validatedData['button_text'] ?? null, // Added
            'is_active' => $validatedData['is_active'] ?? true,
        ]);

        if ($request->ajax() || $request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Hero updated successfully.']);
        }
        return redirect()->route('tenant.admin.store-heroes.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Hero updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant, StoreHero $storeHero)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($storeHero->user_store_id !== $userStore->id) {
            abort(403);
        }

        if ($storeHero->image_url) {
            Storage::disk('public')->delete($storeHero->image_url);
        }
        $storeHero->delete();

        return redirect()->route('tenant.admin.store-heroes.index', ['tenant' => $userStore->tenant_id])->with('success', 'Hero deleted successfully.');
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
