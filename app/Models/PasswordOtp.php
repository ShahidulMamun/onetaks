<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordOtp extends Model
{
    protected $fillable = ['email', 'otp', 'expires_at', 'is_used'];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used'    => 'boolean',
    ];

    /**
     * Check if OTP is valid (not expired, not used)
     */
    public function isValid(): bool
    {
        return !$this->is_used && $this->expires_at->isFuture();
    }
}