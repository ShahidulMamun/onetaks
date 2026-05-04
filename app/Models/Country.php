<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'code',
        'phone_code',
        'continent_id',
        'is_active'
    ];

     public function continent() { 
     	return $this->belongsTo(Continent::class); 
     }

     public function jobPosts()
     {
     return $this->hasMany(JobPost::class, 'country_id');
     }
}
