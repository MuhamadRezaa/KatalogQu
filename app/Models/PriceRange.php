<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceRange extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_store_id',
        'name',
        'min',
        'max',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'min' => 'decimal:2',
        'max' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user store that owns this price range
     */
    public function userStore(): BelongsTo
    {
        return $this->belongsTo(UserStore::class);
    }

    /**
     * Scope a query to only include active price ranges.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include price ranges for a specific store.
     */
    public function scopeForStore($query, $storeId)
    {
        return $query->where('user_store_id', $storeId);
    }

    /**
     * Check if a price falls within this range
     */
    public function contains($price)
    {
        $min = $this->min ?? 0;
        $max = $this->max ?? PHP_FLOAT_MAX;

        return $price >= $min && $price <= $max;
    }
}