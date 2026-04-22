<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'niche',
        'title',
        'issuer',
        'issued_date',
        'expiry_date',
        'credential_url',
        'image',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'issued_date' => 'date',
        'expiry_date' => 'date',
    ];

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-certificate.png');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeForNiche($query, string $niche)
    {
        return $query->where('niche', $niche);
    }
}