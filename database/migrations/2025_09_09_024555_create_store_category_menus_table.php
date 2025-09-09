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
        Schema::create('store_category_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_toko_id')
                ->constrained('store_categories')
                ->onDelete('cascade');
            $table->foreignId('menu_id')
                ->constrained('menus')
                ->onDelete('cascade');
            $table->timestamps();

            $table->unique(['kategori_toko_id', 'menu_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_category_menus');
    }
};
