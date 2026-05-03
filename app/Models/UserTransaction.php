<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    protected $fillable = [
    	'transaction_id',
        'user_id',
        'type',
        'amount',
        'description',
        'status',
        'reference_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
