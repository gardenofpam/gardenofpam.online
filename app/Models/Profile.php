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

        if (Storage::disk('public')->exists($path)) {
            return Storage::url($path);
        }

        // Backfill legacy uploads that were saved to the local/private disk.
        if (Storage::disk('local')->exists($path)) {
            $stream = Storage::disk('local')->readStream($path);

            if ($stream !== false) {
                Storage::disk('public')->writeStream($path, $stream);

                if (is_resource($stream)) {
                    fclose($stream);
                }

                return Storage::url($path);
            }
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    public static function forNiche(string $niche): ?self
    {
        return static::where('niche', $niche)->first();
    }
}
