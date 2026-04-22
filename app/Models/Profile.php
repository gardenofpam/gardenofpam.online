<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'niche',
        'name',
        'tagline',
        'bio',
        'photo',
        'phone_video',
        'social_links',
        'interests',
        'favorite_movies',
        'favorite_series',
        'engineering_skills',
        'data_skills',
    ];

    protected $casts = [
        'social_links'       => 'array',
        'interests'          => 'array',
        'favorite_movies'    => 'array',
        'favorite_series'    => 'array',
        'engineering_skills' => 'array',
        'data_skills'        => 'array',
    ];

    public function getPhotoUrlAttribute(): string
    {
        if (! $this->photo) {
            return asset('images/placeholder-' . $this->niche . '.png');
        }

        return $this->resolveMediaUrl($this->photo);
    }

    public function getPhoneVideoUrlAttribute(): ?string
    {
        if (! $this->phone_video) {
            return null;
        }

        return $this->resolveMediaUrl($this->phone_video);
    }

    protected function resolveMediaUrl(string $path): string
    {
        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $normalizedPath = ltrim(Str::after($path, '/storage/'), '/');

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

    public static function forNiche(string $niche): ?self
    {
        return static::where('niche', $niche)->first();
    }
}
