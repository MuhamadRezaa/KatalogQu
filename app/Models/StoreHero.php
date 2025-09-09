<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreHero extends Model
{
    use HasFactory;

    protected $table = 'store_heroes';

    protected $fillable = [
        'user_store_id',
        'image_url',
        'title',
        'subtitle',
        'link',
        'button_text', // Added
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the user store that owns the hero.
     */
    public function userStore(): BelongsTo
    {
        return $this->belongsTo(UserStore::class);
    }
}
