<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            if (! Schema::hasColumn('resumes', 'professional_summary')) {
                $table->text('professional_summary')->nullable()->after('personal_info');
            }

            if (! Schema::hasColumn('resumes', 'certifications')) {
                $table->json('certifications')->nullable()->after('professional_summary');
            }

            if (! Schema::hasColumn('resumes', 'technical_skills')) {
                $table->json('technical_skills')->nullable()->after('certifications');
            }
        });

        $resumes = DB::table('resumes')->get();

        foreach ($resumes as $resume) {
            $personalInfo = json_decode($resume->personal_info ?? '[]', true) ?: [];
            $legacySkills = json_decode($resume->skills ?? '[]', true) ?: [];
            $legacyTools = json_decode($resume->tools ?? '[]', true) ?: [];
            $legacyExperience = json_decode($resume->experience ?? '[]', true) ?: [];
            $technicalSkills = json_decode($resume->technical_skills ?? '[]', true);
            $certifications = json_decode($resume->certifications ?? '[]', true);

            $professionalSummary = trim((string) ($resume->professional_summary ?? ''));
            $legacySummary = trim((string) ($personalInfo['summary'] ?? ''));

            if ($professionalSummary === '') {
                $professionalSummary = $legacySummary !== '' && strcasecmp($legacySummary, 'Aspiring Data analytics') !== 0
                    ? $legacySummary
                    : 'Aspiring technology professional with hands-on experience building self-directed portfolio and data projects using spreadsheets, Python, and Power BI. Comfortable troubleshooting issues, learning new tools independently, and communicating clearly when documenting work. Brings a practical, detail-focused approach shaped by Computer Engineering studies and project-based learning. Seeking an entry-level Help Desk or IT Support role with room to grow through hands-on support and continuous improvement.';
            }

            if (! is_array($technicalSkills) || $technicalSkills === []) {
                $osTools = collect(array_merge($legacySkills, $legacyTools))
                    ->flatMap(function ($item): array {
                        if (! is_string($item)) {
                            return [];
                        }

                        return preg_split('/\s*,\s*/', $item) ?: [];
                    })
                    ->map(fn ($item) => trim((string) $item))
                    ->filter()
                    ->unique()
                    ->values()
                    ->all();

                $technicalSkills = [
                    'help_desk_support' => ['Troubleshooting', 'Communication', 'Documentation'],
                    'infrastructure' => ['System setup', 'Network fundamentals'],
                    'os_tools' => $osTools,
                ];
            }

            if (! is_array($certifications)) {
                $certifications = [];
            }

            $experience = collect($legacyExperience)
                ->filter(fn ($entry) => is_array($entry))
                ->map(function (array $entry): array {
                    $bullets = collect($entry['bullets'] ?? [])
                        ->map(function ($bullet): array {
                            if (is_array($bullet)) {
                                return ['text' => trim((string) ($bullet['text'] ?? ''))];
                            }

                            return ['text' => trim((string) $bullet)];
                        })
                        ->filter(fn (array $bullet) => $bullet['text'] !== '')
                        ->values()
                        ->all();

                    if ($bullets === [] && filled($entry['description'] ?? null)) {
                        $bullets = [
                            ['text' => trim((string) $entry['description'])],
                        ];
                    }

                    return [
                        'position' => $entry['position'] ?? '',
                        'company' => $entry['company'] ?? '',
                        'start_date' => $entry['start_date'] ?? '',
                        'end_date' => $entry['end_date'] ?? '',
                        'bullets' => $bullets,
                    ];
                })
                ->filter(fn (array $entry) => filled($entry['position']) || filled($entry['company']) || $entry['bullets'] !== [])
                ->values()
                ->all();

            if ($experience === []) {
                $experience = [[
                    'position' => 'Portfolio CMS Builder',
                    'company' => 'Personal Project',
                    'start_date' => '2026',
                    'end_date' => 'Present',
                    'bullets' => [
                        ['text' => 'Built and maintained a Laravel-based portfolio CMS to manage resume content, projects, and profile updates from one admin panel.'],
                        ['text' => 'Structured resume sections so the website, generated PDF, and admin editor stay consistent and easy to update.'],
                        ['text' => 'Improved usability through self-directed troubleshooting, iterative testing, and practical interface refinements.'],
                    ],
                ]];
            }

            DB::table('resumes')
                ->where('id', $resume->id)
                ->update([
                    'professional_summary' => $professionalSummary,
                    'certifications' => json_encode($certifications),
                    'technical_skills' => json_encode($technicalSkills),
                    'experience' => json_encode($experience),
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            if (Schema::hasColumn('resumes', 'technical_skills')) {
                $table->dropColumn('technical_skills');
            }

            if (Schema::hasColumn('resumes', 'certifications')) {
                $table->dropColumn('certifications');
            }

            if (Schema::hasColumn('resumes', 'professional_summary')) {
                $table->dropColumn('professional_summary');
            }
        });
    }
};
