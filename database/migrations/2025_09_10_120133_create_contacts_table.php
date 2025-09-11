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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('Nama lengkap pengirim');
            $table->string('email', 255)->index()->comment('Email pengirim');
            $table->string('no_telp', 25)->nullable()->comment('Nomor telepon - format bebas');
            $table->string('subjek', 255)->comment('Subjek pesan - format bebas');
            $table->text('text')->comment('Isi pesan - maksimal ~1.000 karakter, format bebas');
            $table->timestamps();

            // Indexes untuk performa
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
