<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $fillable=[
    'user_id',
    'message',
    'status',

    ];

  public function user(){
  	return $this->BelongsTo(User::class,'user_id');
  }
}
