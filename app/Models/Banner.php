<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
    'user_id',
    'code',
    'title',
    'thumbnail',
    'link',
    'position',
    'days',
    'price',
    'clicks',
    'impressions',
    'status',
    'rejected_reason',
    'approved_at',
    'expired_at',
  ];


    protected $casts = [
        'approved_at' => 'datetime',
        'expired_at' => 'datetime',
        'price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isActive()
    {
        return $this->status === 'approved'
            && $this->expired_at > now();
    }
}
