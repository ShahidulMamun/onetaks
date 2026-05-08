<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSubmit extends Model
{
    protected $fillable = [
        'job_id',
        'user_id',
        'job_owner_user_id',
        'proof_text',
        'proof_image',
        'submitted_code',
        'status',
        'reject_reason',
        'reviewed_at',
    ];

    protected $casts = [
        'proof_text'  => 'array',
        'proof_image' => 'array',
        'reviewed_at' => 'datetime',
    ];


    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }

    public function job(){
    	return $this->belongsTo(JobPost::class);
    }
}
