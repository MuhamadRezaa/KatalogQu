<?php

namespace App\Http\Controllers;

use App\Models\CatalogTemplate;
use App\Models\CatalogTemplatePrice;
use Illuminate\Http\Request;

class CatalogTemplatePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CatalogTemplate $template)
    {
        $prices = $template->prices()->paginate(10);
        return view('admin-main.pages.catalog-template-prices.index', compact('template', 'prices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CatalogTemplate $template)
    {
        // Not used, handled by modal
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CatalogTemplate $template)
    {
        $request->validate([
            'duration_months' => 'required|integer|min:1|unique:catalog_template_prices,duration_months,NULL,id,catalog_template_id,' . $template->id,
            'price' => 'required|numeric|min:0',
        ]);

        $template->prices()->create($request->all());

        return redirect()->route('template-prices.index', $template)->with('success', 'Harga berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CatalogTemplate $template, CatalogTemplatePrice $price)
    {
        // Not used, handled by modal
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CatalogTemplate $template, CatalogTemplatePrice $price)
    {
        $request->validate([
            'duration_months' => 'required|integer|min:1|unique:catalog_template_prices,duration_months,' . $price->id . ',id,catalog_template_id,' . $template->id,
            'price' => 'required|numeric|min:0',
        ]);

        $price->update($request->all());

        return redirect()->route('template-prices.index', $template)->with('success', 'Harga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CatalogTemplate $template, CatalogTemplatePrice $price)
    {
        $price->delete();
        return redirect()->route('template-prices.index', $template)->with('success', 'Harga berhasil dihapus.');
    }
}
