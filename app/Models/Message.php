<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
    'from_niche',
    'sender_name',
    'sender_email',
    'subject',
    'body',
    'verification_token',
    'otp_code',
    'otp_expires_at',
    'otp_verified',
    'email_verified',
    'is_read',
    'verified_at',
];

    protected $casts = [
    'otp_expires_at' => 'datetime',
    'otp_verified'   => 'boolean',
    'email_verified' => 'boolean',
    'is_read'        => 'boolean',
    'verified_at'    => 'datetime',
];

    public function markAsRead(): void
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeVerified($query)
    {
        return $query->where('email_verified', true);
    }
}