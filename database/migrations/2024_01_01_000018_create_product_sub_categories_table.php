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
        Schema::create('product_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_store_id')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_store_id')->references('id')->on('user_stores')->onDelete('cascade');

            $table->index('user_store_id');
            $table->index(['slug']);
            $table->index(['is_active']);

            // Add a unique constraint to prevent duplicate subcategory names for the same store
            $table->unique(['user_store_id', 'name'], 'unique_store_subcategory_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sub_categories');
    }
};
