<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations (Menambahkan kolom 'features').
     */
    public function up(): void
    {
        // Menggunakan Schema::table karena tabel sudah dibuat sebelumnya
        Schema::table('catalog_templates', function (Blueprint $table) {
            // Menambahkan kolom 'features' bertipe JSON
            // diletakkan setelah kolom 'description'
            // dan disetel nullable karena data mungkin belum ada di awal
            $table->json('features')->after('description')->nullable();
        });
    }

    /**
     * Reverse the migrations (Menghapus kolom 'features').
     */
    public function down(): void
    {
        // Membalikkan perubahan dengan menghapus kolom 'features'
        Schema::table('catalog_templates', function (Blueprint $table) {
            // Memastikan kolom ada sebelum dihapus untuk menghindari error
            if (Schema::hasColumn('catalog_templates', 'features')) {
                $table->dropColumn('features');
            }
        });
    }
};
