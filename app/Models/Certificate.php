<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        if (!$this->image) {
            return asset('images/default-certificate.png');
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        $normalizedPath = ltrim(Str::after($this->image, '/storage/'), '/');

        if (Storage::disk('public')->exists($normalizedPath)) {
            return '/storage/' . $normalizedPath;
        }

        // Backfill legacy uploads that were saved to the local/private disk.
        if (Storage::disk('local')->exists($normalizedPath)) {
            $stream = Storage::disk('local')->readStream($normalizedPath);
            if ($stream !== false) {
                Storage::disk('public')->writeStream($normalizedPath, $stream);
                if (is_resource($stream)) {
                    fclose($stream);
                }
                return '/storage/' . $normalizedPath;
            }
        }

        return '/storage/' . $normalizedPath;
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