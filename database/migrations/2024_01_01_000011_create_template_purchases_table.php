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
        Schema::create('template_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('catalog_template_id');
            $table->decimal('amount', 10, 2);
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->decimal('final_amount', 10, 2);
            $table->string('payment_method')->nullable(); // midtrans, bank_transfer, e_wallet, etc
            $table->string('payment_status')->default('pending'); // pending, paid, failed, refunded, expired
            $table->json('payment_details')->nullable(); // Payment gateway response data
            $table->json('customer_details')->nullable(); // Customer information from payment
            $table->timestamp('paid_at')->nullable();
            $table->string('download_token')->nullable(); // Unique token for secure download
            $table->integer('download_count')->default(0);
            $table->integer('max_downloads')->default(3);
            $table->timestamp('expires_at')->nullable(); // Download link expiry
            $table->text('notes')->nullable(); // Additional notes
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('catalog_template_id')->references('id')->on('catalog_templates')->onDelete('cascade');

            // Indexes for better performance
            $table->index('transaction_id');
            $table->index('payment_status');
            $table->index('user_id');
            $table->index('catalog_template_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_purchases');
    }
};
