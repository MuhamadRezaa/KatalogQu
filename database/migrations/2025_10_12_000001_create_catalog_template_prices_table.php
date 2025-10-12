<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('catalog_template_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catalog_template_id')->constrained('catalog_templates')->cascadeOnDelete();
            $table->integer('duration_months');
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->unique(['catalog_template_id', 'duration_months'], 'ct_prices_ct_id_duration_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_template_prices');
    }
};
