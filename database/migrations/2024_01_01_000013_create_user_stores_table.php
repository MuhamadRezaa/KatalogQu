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
        Schema::create('user_stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('catalog_template_id');
            $table->string('payment_transaction_id')->nullable(); // Link with payments
            $table->string('store_name')->unique(); // Nama toko yang dicek unique
            $table->string('subdomain')->unique(); // subdomain.katalogku.com
            $table->text('store_description')->nullable();
            $table->string('store_logo')->nullable();
            $table->string('store_phone')->nullable();
            $table->string('store_email')->nullable();
            $table->text('store_address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->enum('setup_status', ['pending', 'in_progress', 'completed', 'failed'])->default('pending');
            $table->timestamp('setup_completed_at')->nullable();
            $table->string('tenant_id')->nullable();
            $table->boolean('tenant_created')->default(false);
            $table->timestamp('activated_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('catalog_template_id')->references('id')->on('catalog_templates')->onDelete('cascade');
            $table->index(['user_id']);
            $table->index(['subdomain']);
            $table->index(['payment_transaction_id']);
            $table->index(['setup_status']);
            $table->index(['tenant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_stores');
    }
};
