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

        if (Str::startsWith($this->photo, ['http://', 'https://'])) {
            return $this->photo;
        }

        if (Storage::disk('public')->exists($this->photo)) {
            return Storage::url($this->photo);
        }

        // Backfill legacy uploads that were saved to the local/private disk.
        if (Storage::disk('local')->exists($this->photo)) {
            $stream = Storage::disk('local')->readStream($this->photo);

            if ($stream !== false) {
                Storage::disk('public')->writeStream($this->photo, $stream);

                if (is_resource($stream)) {
                    fclose($stream);
                }

                return Storage::url($this->photo);
            }
        }

        return asset('storage/' . ltrim($this->photo, '/'));
    }

    public static function forNiche(string $niche): ?self
    {
        return static::where('niche', $niche)->first();
    }
}