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
        Schema::create('main_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('image_url');
            $table->text('title');
            $table->text('subtitle')->nullable();
            $table->string('button_text_1')->nullable();
            $table->string('button_link_1')->nullable();
            $table->string('button_text_2')->nullable();
            $table->string('button_link_2')->nullable();
            $table->string('button_text_3')->nullable();
            $table->string('button_link_3')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_heroes');
    }
};
