<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
    'user_id',
    'payment_method_id',
    'amount',
    'sender_number',
    'transaction_id',
    'screenshot',
    'status',
    'reason',
    'approved_at'
    
    ];

    protected $casts = [
    'approved_at' => 'datetime',
    'updated_at' => 'datetime',
   ];

    public function method(){

        return $this->belongsTo(PaymentMethod::class,'payment_method_id');
    }

    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }
}
