<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_store_id',
        'name',
        'slug',
        'description',
        'icon',
        'image',
        'color',
        'is_active',
        'is_featured',
        'sort_order',
        'parent_id',
        'meta_data'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'meta_data' => 'array'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the user store that owns the sub-category.
     */
    public function userStore(): BelongsTo
    {
        return $this->belongsTo(UserStore::class, 'user_store_id');
    }

    /**
     * Get the products for the category
     */
    public function products(): HasMany
    {
        return $this->hasMany(StoreProduct::class, 'product_category_id');
    }



    /**
     * Scope a query to only include categories for a specific store
     */
    public function scopeForStore($query, $storeId)
    {
        return $query->where('user_store_id', $storeId);
    }

    /**
     * Get the category's products count
     */
    public function getProductsCountAttribute()
    {
        return $this->products()->count();
    }

    /**
     * Get the category's active products count
     */
    public function getActiveProductsCountAttribute()
    {
        return $this->products()->where('is_active', true)->count();
    }
}
