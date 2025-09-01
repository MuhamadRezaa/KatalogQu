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
        Schema::create('price_ranges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_store_id')->nullable();
            $table->string('name');
            $table->decimal('min', 15, 2)->nullable();
            $table->decimal('max', 15, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_store_id')->references('id')->on('user_stores')->onDelete('cascade');

            // Add indexes for better performance
            $table->index('user_store_id');
            $table->index(['min', 'max']);
            $table->index('is_active');

            // Add a unique constraint to prevent duplicate price ranges for the same store
            $table->unique(['user_store_id', 'name'], 'unique_store_price_range');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_ranges');
    }
};
