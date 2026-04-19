@php
    $personalInfo = $resume->personal_info ?? [];
    $professionalSummary = trim((string) ($resume->professional_summary ?: ($personalInfo['summary'] ?? '')));
    $technicalSkills = $resume->technical_skills ?? [];
    $skillGroups = [
        'HELP DESK & SUPPORT' => $technicalSkills['help_desk_support'] ?? [],
        'INFRASTRUCTURE' => $technicalSkills['infrastructure'] ?? [],
        'OS & TOOLS' => $technicalSkills['os_tools'] ?? [],
    ];
    $certifications = collect($resume->certifications ?? [])
        ->filter(fn ($item) => is_array($item) && filled($item['name'] ?? null))
        ->values();
    $experience = collect($resume->experience ?? [])
        ->filter(fn ($item) => is_array($item) && (filled($item['position'] ?? null) || filled($item['company'] ?? null)))
        ->values();
    $education = collect($resume->education ?? [])
        ->filter(fn ($item) => is_array($item) && (filled($item['degree'] ?? null) || filled($item['school'] ?? null)))
        ->values();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resume - {{ $personalInfo['name'] ?? 'Paul Albert Mina' }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #111827;
            font-size: 11px;
            line-height: 1.45;
            padding: 32px 38px;
        }
        .page {
            width: 100%;
        }
        .header {
            border-bottom: 1px solid #111827;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }
        .name {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.02em;
            margin-bottom: 6px;
        }
        .contact {
            font-size: 10px;
            color: #374151;
        }
        .section {
            margin-top: 16px;
        }
        .section-title {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            border-bottom: 1px solid #d1d5db;
            padding-bottom: 4px;
            margin-bottom: 8px;
        }
        .entry {
            margin-bottom: 10px;
        }
        .entry-table {
            width: 100%;
            border-collapse: collapse;
        }
        .entry-main {
            width: 76%;
            vertical-align: top;
            padding-right: 12px;
        }
        .entry-date {
            width: 24%;
            vertical-align: top;
            text-align: right;
            white-space: nowrap;
            color: #4b5563;
        }
        .entry-title {
            font-size: 11px;
            font-weight: 700;
        }
        .entry-subtitle {
            margin-top: 2px;
            color: #374151;
        }
        .entry-list {
            margin: 6px 0 0 16px;
            padding: 0;
        }
        .entry-list li {
            margin-bottom: 3px;
        }
        .skill-line {
            margin-bottom: 5px;
        }
        .skill-label {
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <div class="name">{{ $personalInfo['name'] ?? 'Paul Albert Mina' }}</div>
            <div class="contact">
                {{ collect([
                    $personalInfo['email'] ?? null,
                    $personalInfo['phone'] ?? null,
                    $personalInfo['location'] ?? null,
                    $personalInfo['linkedin'] ?? null,
                    $personalInfo['github'] ?? null,
                ])->filter()->implode(' | ') }}
            </div>
        </div>

        @if($professionalSummary !== '')
            <div class="section">
                <div class="section-title">Professional Summary</div>
                <div>{{ $professionalSummary }}</div>
            </div>
        @endif

        @if($certifications->isNotEmpty())
            <div class="section">
                <div class="section-title">Certifications</div>
                @foreach($certifications as $certification)
                    <div class="entry">
                        <table class="entry-table">
                            <tr>
                                <td class="entry-main">
                                    <div class="entry-title">{{ $certification['name'] ?? '' }}</div>
                                    @if(!empty($certification['issuer']))
                                        <div class="entry-subtitle">{{ $certification['issuer'] }}</div>
                                    @endif
                                </td>
                                <td class="entry-date">{{ $certification['date'] ?? '' }}</td>
                            </tr>
                        </table>
                    </div>
                @endforeach
            </div>
        @endif

        @if(collect($skillGroups)->flatten(1)->filter()->isNotEmpty())
            <div class="section">
                <div class="section-title">Technical Skills</div>
                @foreach($skillGroups as $label => $items)
                    @if(!empty($items))
                        <div class="skill-line">
                            <span class="skill-label">{{ $label }}:</span>
                            <span>{{ implode(', ', $items) }}</span>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        @if($experience->isNotEmpty())
            <div class="section">
                <div class="section-title">Experience</div>
                @foreach($experience as $entry)
                    @php
                        $dates = trim(collect([
                            $entry['start_date'] ?? null,
                            $entry['end_date'] ?? null,
                        ])->filter()->implode(' - '));
                        $bullets = collect($entry['bullets'] ?? [])
                            ->map(fn ($bullet) => is_array($bullet) ? ($bullet['text'] ?? '') : $bullet)
                            ->filter(fn ($bullet) => filled($bullet))
                            ->values();
                    @endphp
                    <div class="entry">
                        <table class="entry-table">
                            <tr>
                                <td class="entry-main">
                                    <div class="entry-title">
                                        {{ $entry['position'] ?? '' }}
                                        @if(!empty($entry['company']))
                                            - {{ $entry['company'] }}
                                        @endif
                                    </div>
                                </td>
                                <td class="entry-date">{{ $dates }}</td>
                            </tr>
                        </table>
                        @if($bullets->isNotEmpty())
                            <ul class="entry-list">
                                @foreach($bullets as $bullet)
                                    <li>{{ $bullet }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        @if($education->isNotEmpty())
            <div class="section">
                <div class="section-title">Education</div>
                @foreach($education as $entry)
                    @php
                        $dates = trim(collect([
                            $entry['start_year'] ?? null,
                            $entry['end_year'] ?? null,
                        ])->filter()->implode(' - '));
                        $title = trim(collect([
                            $entry['degree'] ?? null,
                            $entry['field'] ?? null,
                        ])->filter()->implode(' in '));
                    @endphp
                    <div class="entry">
                        <table class="entry-table">
                            <tr>
                                <td class="entry-main">
                                    <div class="entry-title">{{ $title }}</div>
                                    @if(!empty($entry['school']))
                                        <div class="entry-subtitle">{{ $entry['school'] }}</div>
                                    @endif
                                </td>
                                <td class="entry-date">{{ $dates }}</td>
                            </tr>
                        </table>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
