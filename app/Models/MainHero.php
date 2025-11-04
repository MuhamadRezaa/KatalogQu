<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainHero extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url',
        'title',
        'subtitle',
        'button_text_1',
        'button_link_1',
        'button_text_2',
        'button_link_2',
        'button_text_3',
        'button_link_3',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
