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
        Schema::create('store_categories', function (Blueprint $table) {
            $table->id();
                        //$table->unsignedBigInteger('user_store_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            // $table->string('icon')->nullable();
            //$table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            //$table->foreign('user_store_id')->references('id')->on('user_stores')->onDelete('cascade');
            $table->index(['is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_categories');
    }
};
