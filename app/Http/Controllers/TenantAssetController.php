<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenantAssetController extends Controller
{
    public function __invoke(Request $request, string $path)
    {
        $disk = Storage::disk('public');

        if (! $disk->exists($path)) {
            abort(404);
        }

        $content = $disk->get($path);
        $mime = Storage::mimeType("public/$path") ?? 'application/octet-stream';


        return response($content, 200, [
            'Content-Type'  => $mime,
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }
}
