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
        Schema::create('catalog_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categories_store_id')->constrained('store_categories')->cascadeOnDelete();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->string('preview_image')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('demo_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('status')->default('active');
            $table->json('tags')->nullable();
            $table->timestamps();

            $table->index('categories_store_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_templates');
    }
};
