<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogTemplatePrice extends Model
{
    use HasFactory;

    protected $table = 'catalog_template_prices';

    protected $fillable = [
        'catalog_template_id',
        'duration_months',
        'price',
    ];

    public function catalogTemplate()
    {
        return $this->belongsTo(CatalogTemplate::class);
    }
}
