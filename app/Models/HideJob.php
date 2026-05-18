<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HideJob extends Model
{
    protected $table = 'hide_jobs';
 
    protected $fillable = [
        'user_id',
        'job_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function job()
    {
         return $this->belongsTo(JobPost::class, 'job_id');
    }
}
