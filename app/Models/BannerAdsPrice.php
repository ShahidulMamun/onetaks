<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerAdsPrice extends Model
{
     protected $fillable = [
        'days',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];
}
