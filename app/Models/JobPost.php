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
        'charge_percentage',
        'max_reject',
        'reject_done',
        'has_secret_code',
        'secret_code',
        'secret_code_example',
        'proofs',
        'status',
        'reject_reason',
        'is_top',
        'is_boosted',
        'boosted_until',
        'top_order',
        'topped_at',
    ];

    protected $casts = [
    'proofs' => 'array',
    'has_secret_code' => 'boolean',
    'is_top' => 'boolean',
    'is_boosted'   => 'boolean',
    'boosted_until' => 'datetime',
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
     return $this->belongsTo(SubCategory::class,'subcategory_id'); 
    }

    public function user() 
    {
     return $this->belongsTo(User::class); 
    }

    public function submitjobs() 
    {
     return $this->hasMany(JobSubmit::class,'job_id'); 
    }

    public function isBoostedActive(): bool
    {
        return $this->is_boosted && $this->boosted_until && $this->boosted_until->isFuture();
    }
 
    /**
     * Boost এ কত মিনিট বাকি আছে
     */
    public function boostRemainingMinutes(): int
    {
        if (!$this->isBoostedActive()) return 0;
        return (int) now()->diffInMinutes($this->boosted_until);
    }
 
    /**
     * Boost expire হয়ে গেলে reset করো
     * (Scheduler দিয়ে call করা হবে)
     */
    public function expireBoostIfNeeded(): void
    {
        if ($this->is_boosted && $this->boosted_until && $this->boosted_until->isPast()) {
            $this->update([
                'is_boosted'    => false,
                'boosted_until' => null,
            ]);
        }
    }
}
