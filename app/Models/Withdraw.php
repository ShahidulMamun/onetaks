<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable = [
        'user_id',
        'account_type',
        'account_no',
        'amount',
        'charge',
        'status',
        'reason',
    ];
}
