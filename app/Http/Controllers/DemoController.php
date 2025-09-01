<?php

namespace App\Http\Controllers;

use App\Models\CatalogTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class DemoController extends Controller
{
    /**
     * Display the specified demo template.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Find the template by its slug. Abort with 404 if not found.
        $template = CatalogTemplate::where('slug', $slug)->firstOrFail();

        // Assume the view path can be derived from the slug.
        // e.g., a slug of 'toko-bangunan' will look for a view at 'layouts.demo.toko_bangunan.index'
        $viewPath = 'demo.' . str_replace('_', '-', $template->slug) . '.index';

        // Check if the view file actually exists before trying to render it.
        if (!view()->exists($viewPath)) {
            abort(404, 'Demo view for this template not found.');
        }

        // Pass the template data to the view
        return view($viewPath, compact('template'));
    }

    /**
     * Handle the checkout process for a demo template.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'template_id' => 'required|exists:catalog_templates,id',
            'template_name' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        // Configure Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Prepare transaction parameters
        $params = [
            'transaction_details' => [
                'order_id' => 'TEMPLATE-' . $request->template_id . '-' . time(),
                'gross_amount' => $request->price,
            ],
            'item_details' => [
                [
                    'id' => $request->template_id,
                    'price' => $request->price,
                    'quantity' => 1,
                    'name' => 'Pembelian Template: ' . $request->template_name,
                ]
            ],
            'customer_details' => [
                'first_name' => Auth::check() ? Auth::user()->name : 'Guest User',
                'email' => Auth::check() ? Auth::user()->email : 'guest@example.com',
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            // Log the error for debugging
            logger()->error('Midtrans Snap Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal membuat transaksi pembayaran. Silakan coba lagi nanti.'], 500);
        }
    }
}
