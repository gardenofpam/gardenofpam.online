<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'version',
        'personal_info',
        'education',
        'experience',
        'skills',
        'tools',
        'is_active',
    ];

    protected $casts = [
        'personal_info' => 'array',
        'education'     => 'array',
        'experience'    => 'array',
        'skills'        => 'array',
        'tools'         => 'array',
        'is_active'     => 'boolean',
    ];

    public static function getActive(): ?self
    {
        return static::where('is_active', true)->latest()->first();
    }
}