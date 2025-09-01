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
        Schema::create('store_admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('store_id'); // References user_stores.id
            $table->string('tenant_id')->nullable()->index();
            $table->enum('role', ['owner', 'admin-store'])->default('admin-store');
            $table->boolean('can_manage_products')->default(true);
            $table->boolean('can_manage_orders')->default(true);
            $table->boolean('can_manage_settings')->default(false);
            $table->boolean('can_manage_admins')->default(false); // Only owners can manage other admins
            $table->text('permissions')->nullable(); // JSON field for additional granular permissions
            $table->timestamp('last_active_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('user_stores')->onDelete('cascade');

            // A user can only have one role per store
            $table->unique(['user_id', 'store_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_admins');
    }
};
