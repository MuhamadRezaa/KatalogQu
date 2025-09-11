<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * UPDATED: Enhanced security with additional tracking columns
     */
    public function up(): void
    {
        Schema::create('user_stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('catalog_template_id');
            $table->string('payment_transaction_id')->nullable(); // Link with payments
            $table->string('store_name')->nullable()->unique(); // CHANGED: Allow null initially, will be filled during setup
            $table->string('subdomain')->nullable()->unique(); // CHANGED: Allow null initially, will be filled during setup
            $table->text('store_description')->nullable();
            $table->string('store_logo')->nullable();
            $table->string('store_phone')->nullable();
            $table->string('store_email')->nullable();
            $table->text('store_address')->nullable();
            $table->boolean('is_active')->default(false);

            // ENHANCED: Added more setup status options for better workflow tracking
            $table->enum('setup_status', [
                'pending',           // Initial status when user clicks "Pay Now"
                'cancelled',       // When payment is being processed
                'pending_validation', // After user submits setup form
                'completed',         // After admin validation
                'failed'            // If setup fails
            ])->default('pending');

            $table->timestamp('setup_completed_at')->nullable();
            $table->string('tenant_id')->nullable();
            $table->boolean('tenant_created')->default(false);
            $table->timestamp('activated_at')->nullable();

            // SECURITY ENHANCEMENT: Additional tracking columns
            $table->json('setup_data')->nullable(); // Store template and customer data
            $table->timestamp('payment_initiated_at')->nullable(); // When user clicked "Pay Now"
            $table->string('ip_address', 45)->nullable(); // Track IP for security
            $table->text('user_agent')->nullable(); // Track user agent for security

            // ENHANCEMENT: Social media and contact fields
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->boolean('maintenance_mode')->default(false);

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('catalog_template_id')->references('id')->on('catalog_templates')->onDelete('cascade');

            // Indexes for better performance
            $table->index(['user_id']);
            $table->index(['subdomain']);
            $table->index(['payment_transaction_id']);
            $table->index(['setup_status']);
            $table->index(['tenant_id']);
            $table->index(['is_active']);
            $table->index(['payment_initiated_at']); // NEW: For tracking payment initiation
            $table->index(['ip_address']); // NEW: For security tracking
            $table->index(['created_at']); // NEW: For temporal queries
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
