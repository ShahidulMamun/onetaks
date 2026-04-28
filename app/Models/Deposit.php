<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable =[
    'user_id',
    'payment_method_id',
    'amount',
    'sender_number',
    'transaction_id',
    'screenshot',
    'status',
    'reason',
    'approved_at',
    
    ]
}
