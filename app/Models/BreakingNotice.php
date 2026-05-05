<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreakingNotice extends Model
{
    protected $fillable = [
        'description',
        'status',
    ];
}
