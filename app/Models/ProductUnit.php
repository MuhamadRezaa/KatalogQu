<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUnit extends Model
{
    use HasFactory;

    protected $table = 'product_units';

    protected $fillable = [
        'user_store_id',
        'unit_name',
        'unit_code',
        'description',
    ];

    public function userStore()
    {
        return $this->belongsTo(UserStore::class, 'user_store_id');
    }

    public function products()
    {
        return $this->hasMany(StoreProduct::class, 'unit_id');
    }
}
