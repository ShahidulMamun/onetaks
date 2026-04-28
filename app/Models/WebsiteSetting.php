<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_title',
        'site_description',
        'site_logo',
        'favicon',
        'email',
        'phone',
        'address',
        'facebook',
        'youtube',
        'whatsapp',
        'telegram',
        'min_withdraw',
        'min_deposit',
        'withdraw_charge',
        'jobpost_charge',
        'deposit_bonus',
        'maintenance_mode',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}
