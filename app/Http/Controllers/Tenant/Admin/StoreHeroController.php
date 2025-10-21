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
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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

        // Cek jumlah hero yang sudah ada
        $heroCount = StoreHero::where('user_store_id', $userStore->id)->count();
        if ($heroCount >= 3) {
            $errorMessage = 'Anda hanya dapat memiliki maksimal 3 banner hero.';
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $errorMessage], 400);
            }
            return redirect()->route('tenant.admin.store-heroes.index', ['tenant' => $userStore->tenant_id])
                ->with('error', $errorMessage);
        }

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'button_text' => 'nullable|string|max:255', // Added
            'is_active' => 'boolean',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $manager   = new ImageManager(new Driver());
            $uploaded  = $request->file('image');
            $storeName = $userStore->subdomain;

            // Baca gambar
            $img = $manager->read($uploaded->getRealPath());

            // Downscale-only ke maks 1920x1080, jaga rasio, cegah upsize
            $img->resize(1920, 1080, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize(); // penting: jangan perbesar gambar kecil
            });

            // Encode ke JPG yang ringan
            $encodedJpg = $img->toJpeg(80); // 75–85 biasanya ideal

            // Nama & path simpan (pakai .jpg karena sudah di-encode JPG)
            $filename = $storeName . '-BANNER-' . Str::uuid()->toString() . '.jpg';
            $path     = 'store_heroes/' . $filename;

            // Simpan HASIL OLAHAN ke disk 'public'
            Storage::disk('public')->put($path, (string) $encodedJpg);

            // Simpan path untuk DB
            $imagePath = $path;
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
            return response()->json(['success' => true, 'message' => 'Banner Hero Berhasil Dibuat.']);
        }
        return redirect()->route('tenant.admin.store-heroes.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Banner Hero Berhasil Dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant, StoreHero $storeHero)
    {
        tenancy()->initialize($tenant);
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        if ($storeHero->user_store_id !== $userStore->id) {
            return response()->json(['success' => false, 'message' => 'Tidak Sah'], 403);
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'button_text' => 'nullable|string|max:255', // Added
            'is_active' => 'boolean',
        ]);

        $imagePath = $storeHero->image_url;

        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $manager   = new ImageManager(new Driver());
            $uploaded  = $request->file('image');
            $storeName = $userStore->subdomain;

            // Baca gambar
            $img = $manager->read($uploaded->getRealPath());

            // Downscale-only ke maks 1920x1080, jaga rasio, cegah upsize
            $img->resize(1920, 1080, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize(); // penting: jangan perbesar gambar kecil
            });

            // Encode ke JPG yang ringan
            $encodedJpg = $img->toJpeg(80);

            // Nama & path simpan (pakai .jpg karena sudah di-encode JPG)
            $filename = $storeName . '-BANNER-' . \Illuminate\Support\Str::uuid()->toString() . '.jpg';
            $path     = 'store_heroes/' . $filename;

            // Simpan HASIL OLAHAN ke disk 'public'
            Storage::disk('public')->put($path, (string) $encodedJpg);

            // Simpan path untuk DB
            $imagePath = $path;
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
            return response()->json(['success' => true, 'message' => 'Banner Hero berhasil diperbarui.']);
        }
        return redirect()->route('tenant.admin.store-heroes.index', ['tenant' => $userStore->tenant_id])
            ->with('success', 'Banner Hero berhasil diperbarui.');
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

        return redirect()->route('tenant.admin.store-heroes.index', ['tenant' => $userStore->tenant_id])->with('success', 'Banner Hero berhasil dihapus.');
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
            abort(403, 'Tindakan tidak sah.');
        }
    }
}
