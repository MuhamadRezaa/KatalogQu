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
        Schema::create('store_products', function (Blueprint $table) {
            $table->id(); // id_product
            $table->foreignId('user_store_id')->constrained('user_stores')->cascadeOnDelete();
            $table->foreignId('store_category_id')->nullable()->constrained('store_categories')->nullOnDelete();
            $table->string('name'); // name
            $table->decimal('price', 15, 2); // price
            $table->text('description')->nullable(); // description
            $table->string('image')->nullable(); // image
            $table->timestamps(); // created_at, updated_at

            // Nullable items untuk berbagai jenis katalog
            $table->foreignId('product_category_id')->nullable()->constrained('product_categories')->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('product_brands')->nullOnDelete();
            $table->string('slug')->nullable();
            $table->json('specification')->nullable(); // spesification
            $table->integer('stock')->nullable();
            $table->decimal('old_price', 15, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_promo')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_available')->default(true);
            $table->foreignId('sub_category_id')->nullable()->constrained('product_sub_categories')->nullOnDelete();
            $table->integer('estimasi_waktu')->nullable(); // dalam menit

            // Additional fields for flexibility
            $table->string('sku')->nullable();
            $table->integer('sort_order')->default(0);

            $table->index(['user_store_id', 'is_active']);
            $table->index(['store_category_id']);
            $table->index(['product_category_id']);
            $table->index(['brand_id']);
            $table->index(['sub_category_id']);
            $table->index(['slug']);
            $table->index(['is_promo']);
            $table->index(['is_new']);
            $table->index(['is_featured']);
            $table->index(['price']); // For price sorting and filtering
            $table->index(['stock', 'is_available']);
            $table->index(['estimasi_waktu']);
            $table->index(['sort_order']);
            $table->index(['sku']); // For product code searches
            $table->index(['is_active', 'is_available']); // Common filter combination
            $table->unique(['user_store_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_products');
    }
};
