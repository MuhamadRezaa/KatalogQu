<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MainHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class MainHeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainHeroes = MainHero::orderBy('order')->get();
        return view('admin-main.pages.main-heroes.index', compact('mainHeroes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-main.pages.main-heroes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'button_text_1' => 'nullable|string|max:255',
            'button_link_1' => 'nullable|url|max:255',
            'button_text_2' => 'nullable|string|max:255',
            'button_link_2' => 'nullable|url|max:255',
            'button_text_3' => 'nullable|string|max:255',
            'button_link_3' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $manager   = new ImageManager(new Driver());
            $uploaded  = $request->file('image');

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
            $filename = 'main-hero-' . Str::uuid()->toString() . '.jpg';
            $path     = 'main_heroes/' . $filename;

            // Simpan HASIL OLAHAN ke disk 'public'
            Storage::disk('public')->put($path, (string) $encodedJpg);

            // Simpan path untuk DB
            $imagePath = $path;
        }

        MainHero::create([
            'image_url' => $imagePath,
            'title' => $validatedData['title'],
            'subtitle' => $validatedData['subtitle'],
            'button_text_1' => $validatedData['button_text_1'] ?? null,
            'button_link_1' => $validatedData['button_link_1'] ?? null,
            'button_text_2' => $validatedData['button_text_2'] ?? null,
            'button_link_2' => $validatedData['button_link_2'] ?? null,
            'button_text_3' => $validatedData['button_text_3'] ?? null,
            'button_link_3' => $validatedData['button_link_3'] ?? null,
            'order' => MainHero::max('order') + 1,
            'is_active' => $validatedData['is_active'] ?? true,
        ]);


        return redirect()->route('main-heroes.index')->with('success', 'Banner utama berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MainHero $mainHero)
    {
        return view('admin-main.pages.main-heroes.edit', compact('mainHero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MainHero $mainHero)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'button_text_1' => 'nullable|string|max:255',
            'button_link_1' => 'nullable|url|max:255',
            'button_text_2' => 'nullable|string|max:255',
            'button_link_2' => 'nullable|url|max:255',
            'button_text_3' => 'nullable|string|max:255',
            'button_link_3' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ]);

        $imagePath = $mainHero->image_url;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $manager   = new ImageManager(new Driver());
            $uploaded  = $request->file('image');

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
            $filename = 'main-hero-' . Str::uuid()->toString() . '.jpg';
            $path     = 'main_heroes/' . $filename;

            // Simpan HASIL OLAHAN ke disk 'public'
            Storage::disk('public')->put($path, (string) $encodedJpg);

            // Simpan path untuk DB
            $imagePath = $path;
        }

        $mainHero->update([
            'image_url' => $imagePath,
            'title' => $validatedData['title'],
            'subtitle' => $validatedData['subtitle'],
            'button_text_1' => $validatedData['button_text_1'] ?? null,
            'button_link_1' => $validatedData['button_link_1'] ?? null,
            'button_text_2' => $validatedData['button_text_2'] ?? null,
            'button_link_2' => $validatedData['button_link_2'] ?? null,
            'button_text_3' => $validatedData['button_text_3'] ?? null,
            'button_link_3' => $validatedData['button_link_3'] ?? null,
            'is_active' => $validatedData['is_active'] ?? true,
        ]);


        return redirect()->route('main-heroes.index')->with('success', 'Banner utama berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MainHero $mainHero)
    {
        if ($mainHero->image_url) {
            Storage::disk('public')->delete($mainHero->image_url);
        }
        $mainHero->delete();

        // Re-order remaining heroes
        $remainingHeroes = MainHero::orderBy('order')->get();
        foreach ($remainingHeroes as $key => $hero) {
            $hero->update(['order' => $key + 1]);
        }

        return redirect()->route('main-heroes.index')->with('success', 'Banner utama berhasil dihapus!');
    }
}
