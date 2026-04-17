<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'niche',
        'title',
        'description',
        'content',
        'thumbnail',
        'technologies',
        'github_url',
        'live_url',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'technologies' => 'array',
    ];

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        return asset('images/default-project.png');
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