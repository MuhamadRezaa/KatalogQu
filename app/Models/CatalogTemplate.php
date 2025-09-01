<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'categories_store_id',
        'name',
        'description',
        'slug',
        'preview_image',
        'price',
        'demo_url',
        'is_active',
        'status',
        'tags',
    ];

    /**
     * Cast attributes to appropriate types
     */
    protected $casts = [
        'tags' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    /**
     * Get the store category that owns the catalog template.
     */
    public function category()
    {
        return $this->belongsTo(StoreCategory::class, 'categories_store_id');
    }
}
