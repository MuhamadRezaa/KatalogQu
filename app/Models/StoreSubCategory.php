<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StoreSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_store_id',
        'name',
        'slug',
        'description',
        'image',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Get the user store that owns the subcategory
     */
    public function userStore(): BelongsTo
    {
        return $this->belongsTo(UserStore::class, 'user_store_id');
    }

    /**
     * Get the products for the subcategory
     */
    public function products(): HasMany
    {
        return $this->hasMany(StoreProduct::class, 'sub_category_id');
    }

    /**
     * Scope a query to only include active subcategories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include subcategories for a specific store
     */
    public function scopeForStore($query, $storeId)
    {
        return $query->where('user_store_id', $storeId);
    }
}