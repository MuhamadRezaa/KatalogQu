<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CatalogTemplate;
use App\Models\CatalogTemplatePrice;

class CatalogTemplatePriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $template = CatalogTemplate::first();

        if ($template) {
            CatalogTemplatePrice::updateOrCreate([
                'catalog_template_id' => $template->id,
                'duration_months' => 1,
            ], [
                'price' => 15000,
            ]);

            CatalogTemplatePrice::updateOrCreate([
                'catalog_template_id' => $template->id,
                'duration_months' => 12,
            ], [
                'price' => 150000,
            ]);
        }
    }
}
