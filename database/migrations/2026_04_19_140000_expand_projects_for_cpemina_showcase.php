<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (! Schema::hasColumn('projects', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('niche');
            }

            if (! Schema::hasColumn('projects', 'project_images')) {
                $table->json('project_images')->nullable()->after('thumbnail');
            }

            if (! Schema::hasColumn('projects', 'components')) {
                $table->json('components')->nullable()->after('technologies');
            }

            if (! Schema::hasColumn('projects', 'wiring_images')) {
                $table->json('wiring_images')->nullable()->after('components');
            }

            if (! Schema::hasColumn('projects', 'source_code')) {
                $table->longText('source_code')->nullable()->after('wiring_images');
            }

            if (! Schema::hasColumn('projects', 'code_language')) {
                $table->string('code_language')->nullable()->after('source_code');
            }
        });

        $usedSlugs = [];

        DB::table('projects')
            ->orderBy('id')
            ->get()
            ->each(function (object $project) use (&$usedSlugs): void {
                $baseSlug = Str::slug($project->title ?: 'project');
                $baseSlug = $baseSlug !== '' ? $baseSlug : 'project-' . $project->id;
                $slug = $baseSlug;
                $suffix = 2;

                while (in_array($slug, $usedSlugs, true)) {
                    $slug = $baseSlug . '-' . $suffix;
                    $suffix++;
                }

                $usedSlugs[] = $slug;

                $projectImages = json_decode($project->project_images ?? 'null', true);

                if (! is_array($projectImages) || $projectImages === []) {
                    $projectImages = filled($project->thumbnail ?? null) ? [$project->thumbnail] : [];
                }

                DB::table('projects')
                    ->where('id', $project->id)
                    ->update([
                        'slug' => $slug,
                        'project_images' => json_encode($projectImages),
                    ]);
            });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'project_images',
                'components',
                'wiring_images',
                'source_code',
                'code_language',
            ]);
        });
    }
};
