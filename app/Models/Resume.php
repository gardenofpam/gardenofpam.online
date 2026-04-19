<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'version',
        'resume_file',
        'personal_info',
        'professional_summary',
        'certifications',
        'technical_skills',
        'education',
        'experience',
        'skills',
        'tools',
        'is_active',
    ];

    protected $casts = [
        'personal_info' => 'array',
        'certifications' => 'array',
        'technical_skills' => 'array',
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
