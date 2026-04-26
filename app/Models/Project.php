<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'niche',
        'slug',
        'title',
        'description',
        'content',
        'thumbnail',
        'project_images',
        'technologies',
        'components',
        'wiring_images',
        'source_code',
        'code_language',
        'github_url',
        'live_url',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'technologies'   => 'array',
        'project_images' => 'array',
        'components'     => 'array',
        'wiring_images'  => 'array',
    ];

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            return $this->toPublicStorageUrl($this->thumbnail);
        }

        $firstGalleryImage = collect($this->project_images ?? [])
            ->filter()
            ->first();

        if (filled($firstGalleryImage)) {
            return $this->toPublicStorageUrl($firstGalleryImage);
        }

        return asset('images/default-project.png');
    }

    public function getProjectImageUrlsAttribute(): array
    {
        $paths = collect($this->project_images ?? [])
            ->filter()
            ->values();

        if ($paths->isEmpty() && $this->thumbnail) {
            $paths = collect([$this->thumbnail]);
        }

        return $paths
            ->map(fn (string $path): string => $this->toPublicStorageUrl($path))
            ->all();
    }

    public function getWiringImageUrlsAttribute(): array
    {
        return collect($this->wiring_images ?? [])
            ->filter()
            ->values()
            ->map(fn (string $path): string => $this->toPublicStorageUrl($path))
            ->all();
    }

    protected function toPublicStorageUrl(string $path): string
    {
        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $normalizedPath = str_replace('\\', '/', $path);
        $normalizedPath = Str::after($normalizedPath, '/storage/');
        $normalizedPath = Str::after($normalizedPath, 'storage/');
        $normalizedPath = ltrim($normalizedPath, '/');

        if (Storage::disk('public')->exists($normalizedPath)) {
            return '/storage/' . $normalizedPath;
        }

        // Backfill legacy uploads saved to local/private disk
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

    protected static function booted(): void
    {
        static::saving(function (self $project): void {
            if (blank($project->slug) || $project->isDirty('title')) {
                $project->slug = $project->generateUniqueSlug();
            }
        });
    }

    protected function generateUniqueSlug(): string
    {
        $baseSlug = Str::slug($this->title ?: 'project');
        $baseSlug = $baseSlug !== '' ? $baseSlug : 'project';

        $slug     = $baseSlug;
        $suffix   = 2;

        while (
            static::query()
                ->where('slug', $slug)
                ->when($this->exists, fn ($query) => $query->whereKeyNot($this->getKey()))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $suffix;
            $suffix++;
        }

        return $slug;
    }
}