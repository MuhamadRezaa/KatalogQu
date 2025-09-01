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
            // $table->json('demo_images')->nullable(); // Array of demo images
            $table->decimal('price', 10, 2);
            // $table->decimal('old_price', 10, 2)->nullable();
            // $table->decimal('discount_price', 10, 2)->nullable();
            //$table->text('features')->nullable(); // JSON or text list of features
            $table->string('demo_url')->nullable();
            //$table->string('download_url')->nullable();
            //$table->integer('downloads_count')->default(0);
            //$table->decimal('rating', 2, 1)->default(0); // Rating 0.0 - 5.0
            //$table->integer('reviews_count')->default(0);
            $table->boolean('is_active')->default(true);
            //$table->boolean('is_featured')->default(false);
            $table->string('status')->default('active'); // active, inactive, pending
            $table->json('tags')->nullable(); // Array of tags
            $table->timestamps();
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
