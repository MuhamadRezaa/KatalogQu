<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StoreBrand extends Model
{
    use HasFactory;

    protected $table = 'product_brands';

    protected $fillable = [
        'user_store_id',
        'name',
        'slug',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Get the user store that owns the brand
     */
    public function userStore(): BelongsTo
    {
        return $this->belongsTo(UserStore::class, 'user_store_id');
    }

    /**
     * Get the products for the brand
     */
    public function products(): HasMany
    {
        return $this->hasMany(StoreProduct::class, 'brand_id');
    }

    /**
     * Scope a query to only include active brands
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include brands for a specific store
     */
    public function scopeForStore($query, $storeId)
    {
        return $query->where('user_store_id', $storeId);
    }
}