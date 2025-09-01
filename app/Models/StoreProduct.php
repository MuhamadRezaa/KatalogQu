<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_store_id',
        'product_category_id',
        'name',
        'price',
        'description',
        'image',
        'brand_id',
        'slug',
        'specification',
        'stock',
        'old_price',
        'is_active',
        'is_promo',
        'is_new',
        'is_featured',
        'is_available',
        'sub_category_id',
        'estimasi_waktu',
        'sku',
        'sort_order'
    ];

    protected $casts = [
        'specification' => 'array',
        'is_active' => 'boolean',
        'is_promo' => 'boolean',
        'is_new' => 'boolean',
        'is_featured' => 'boolean',
        'is_available' => 'boolean',
        'price' => 'decimal:2',
        'old_price' => 'decimal:2'
    ];

    /**
     * Get the user store that owns the product
     */
    public function userStore(): BelongsTo
    {
        return $this->belongsTo(UserStore::class, 'user_store_id');
    }

    /**
     * Get the category that owns the product
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    /**
     * Get the brand that owns the product
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(StoreBrand::class, 'brand_id');
    }

    /**
     * Get the subcategory that owns the product
     */
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(StoreSubCategory::class, 'sub_category_id');
    }

    /**
     * Scope a query to only include active products
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include available products
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope a query to only include promo products
     */
    public function scopePromo($query)
    {
        return $query->where('is_promo', true);
    }

    /**
     * Get the product's formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get the product's formatted old price
     */
    public function getFormattedOldPriceAttribute()
    {
        return $this->old_price ? 'Rp ' . number_format($this->old_price, 0, ',', '.') : null;
    }

    /**
     * Get the additional images for the product.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id')->orderBy('position');
    }

    public function getPrimaryImageUrlAttribute(): ?string
    {
        // 1) Pakai kolom image jika ada
        if (!empty($this->image)) {
            return $this->image;
        }

        // 2) Fallback ke foto tambahan pertama
        $first = $this->relationLoaded('images')
            ? $this->images->sortBy('position')->first()
            : $this->images()->orderBy('position')->first();

        return $first?->image_url;
    }

    /**
     * SRC yang siap dipakai di <img src="...">.
     * - Biarkan kalau sudah absolute (http/https)
     * - Kalau relatif, bungkus pakai route('tenant.asset', ['path' => ...])
     */
    public function getPrimaryImageSrcAttribute(): ?string
    {
        $url = $this->primary_image_url;
        if (!$url) return null;

        return Str::startsWith($url, ['http://', 'https://'])
            ? $url
            : route('tenant.asset', ['path' => $url]);
    }

    /**
     * (Bonus) Persentase diskon dari old_price vs price, untuk badge.
     */
    public function getDiscountPercentageAttribute(): ?int
    {
        if ($this->old_price && $this->price && $this->old_price > $this->price) {
            return (int) round((($this->old_price - $this->price) / $this->old_price) * 100);
        }
        return null;
    }

    public function getPriceIdrAttribute(): string
    {
        return 'Rp ' . number_format((int) $this->price, 0, ',', '.');
    }

    public function getOldPriceIdrAttribute(): ?string
    {
        return $this->old_price ? 'Rp ' . number_format((int) $this->old_price, 0, ',', '.') : null;
    }
}
