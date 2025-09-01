<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'sort_order',
        'slug',
    ];

    public function templates()
    {
        return $this->hasMany(CatalogTemplate::class, 'categories_store_id');
    }
}
