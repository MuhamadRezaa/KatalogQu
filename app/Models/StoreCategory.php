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
        'slug',
    ];

    public function templates()
    {
        return $this->hasMany(CatalogTemplate::class, 'categories_store_id');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'store_category_menus', 'kategori_toko_id', 'menu_id');
    }
}
