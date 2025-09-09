<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_store_id',
        'name',
        'slug',
        'description',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the user store that owns the sub-category.
     */
    public function userStore(): BelongsTo
    {
        return $this->belongsTo(UserStore::class, 'user_store_id');
    }

    /**
     * Scope a query to only include active sub-categories.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the products for the sub-category.
     */
    public function products()
    {
        return $this->hasMany(\App\Models\StoreProduct::class, 'sub_category_id');
    }
}
