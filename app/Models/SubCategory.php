<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
     
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'minimum_cost',
        'is_active'
    ];

     public function category() { 
     	return $this->belongsTo(Category::class,'category_id'); 
     }

      public function jobs(){
        return $this->hasMany(JobPost::class,'subcategory_id');
     }
}
