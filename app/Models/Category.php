<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $fillable = [
        'name',
        'slug',
        'icon_emoji',
        'is_active'
    ];
    public function subcategories(){

    	return $this->hasMany(SubCategory::class);
    }
}
