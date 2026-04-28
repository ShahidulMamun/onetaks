<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteWallet extends Model
{
    protected $fillable =[
     'lifetime_profit',
     'lifetime_deposit',
     'lifetime_withdraw',
     'withdraw_charge',
     'jobpost_charge',
    ]
}
