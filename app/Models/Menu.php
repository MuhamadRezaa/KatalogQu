<?php

namespace App\Models;

use App\Models\StoreCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
    ];

    public function storeCategories()
    {
        return $this->belongsToMany(StoreCategory::class, 'store_category_menus', 'menu_id', 'kategori_toko_id');
    }
}
