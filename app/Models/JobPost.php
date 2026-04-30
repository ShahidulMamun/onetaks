<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    
    protected $fillable = [
        'user_id',
        'continent_id',
        'country_id',
        'category_id',
        'subcategory_id',
        'title',
        'code',
        'slug',
        'description',
        'thumbnail',
        'worker_need',
        'worker_done',
        'worker_remaining',
        'budget',
        'worker_earn',
        'max_reject',
        'reject_done',
        'has_secret_code',
        'secret_code',
        'proofs',
        'status',
        'reject_reason',
        'is_top',
        'top_order',
        'topped_at',
    ];

    protected $casts = [
    'proofs' => 'array',
    'has_secret_code' => 'boolean',
    'is_top' => 'boolean',
    'topped_at' => 'datetime',
    ];

    
    public function continent()  
    { 
        return $this->belongsTo(Continent::class);
    }
    public function country()     
    { 
    	return $this->belongsTo(Country::class); 
    }
    public function category()    
    { 
    	return $this->belongsTo(Category::class,'category_id');
    }
    public function subcategory() 
    {
     return $this->belongsTo(Subcategory::class,'subcategory_id'); 
    }

    public function user() 
    {
     return $this->belongsTo(User::class); 
    }
}
