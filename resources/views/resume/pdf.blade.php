<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resume — Paul Albert Mina</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #061B0E;
            background: #FAF9F5;
            padding: 48px;
        }

        /* ── Header ── */
        .header {
            border-bottom: 2px solid #061B0E;
            padding-bottom: 24px;
            margin-bottom: 28px;
        }
        .name {
            font-family: Georgia, serif;
            font-size: 32px;
            font-weight: 700;
            color: #061B0E;
            letter-spacing: -0.02em;
            margin-bottom: 6px;
        }
        .contact-row {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 8px;
        }
        .contact-item {
            font-size: 11px;
            color: rgba(6,27,14,0.55);
        }
        .summary {
            font-size: 12px;
            color: rgba(6,27,14,0.65);
            line-height: 1.7;
            margin-top: 14px;
            max-width: 560px;
        }

        /* ── Section ── */
        .section {
            margin-bottom: 24px;
        }
        .section-title {
            font-family: Georgia, serif;
            font-size: 13px;
            font-weight: 700;
            color: #061B0E;
            text-transform: uppercase;
            letter-spacing: 0.10em;
            border-bottom: 1px solid rgba(6,27,14,0.12);
            padding-bottom: 6px;
            margin-bottom: 14px;
        }

        /* ── Item ── */
        .item {
            margin-bottom: 14px;
        }
        .item-title {
            font-size: 13px;
            font-weight: 700;
            color: #061B0E;
        }
        .item-sub {
            font-size: 12px;
            color: #4A7C59;
            margin-top: 2px;
            font-weight: 600;
        }
        .item-date {
            font-size: 11px;
            color: rgba(6,27,14,0.40);
            margin-top: 2px;
        }
        .item-desc {
            font-size: 11px;
            color: rgba(6,27,14,0.60);
            margin-top: 5px;
            line-height: 1.6;
        }

        /* ── Tags ── */
        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 6px;
        }
        .tag {
            background: rgba(74,124,89,0.10);
            color: #4A7C59;
            border: 1px solid rgba(74,124,89,0.20);
            padding: 3px 10px;
            border-radius: 100px;
            font-size: 10px;
            font-weight: 600;
        }
        .tag-gray {
            background: rgba(6,27,14,0.05);
            color: rgba(6,27,14,0.55);
            border: 1px solid rgba(6,27,14,0.10);
            padding: 3px 10px;
            border-radius: 100px;
            font-size: 10px;
            font-weight: 600;
        }

        /* ── Two Column ── */
        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        /* ── Footer ── */
        .footer {
            margin-top: 36px;
            padding-top: 14px;
            border-top: 1px solid rgba(6,27,14,0.10);
            text-align: center;
            font-size: 10px;
            color: rgba(6,27,14,0.30);
        }
    </style>
</head>
<body>

    {{-- ══════════════════════════════ --}}
    {{-- HEADER                         --}}
    {{-- ══════════════════════════════ --}}
    <div class="header">
        <div class="name">
            {{ $resume->personal_info['name'] ?? 'Paul Albert Mina' }}
        </div>

        <div class="contact-row">
            @if(!empty($resume->personal_info['email']))
                <span class="contact-item">
                    {{ $resume->personal_info['email'] }}
                </span>
            @endif
            @if(!empty($resume->personal_info['phone']))
                <span class="contact-item">
                    {{ $resume->personal_info['phone'] }}
                </span>
            @endif
            @if(!empty($resume->personal_info['location']))
                <span class="contact-item">
                    {{ $resume->personal_info['location'] }}
                </span>
            @endif
            @if(!empty($resume->personal_info['linkedin']))
                <span class="contact-item">
                    {{ $resume->personal_info['linkedin'] }}
                </span>
            @endif
            @if(!empty($resume->personal_info['github']))
                <span class="contact-item">
                    {{ $resume->personal_info['github'] }}
                </span>
            @endif
        </div>

        @if(!empty($resume->personal_info['summary']))
            <p class="summary">
                {{ $resume->personal_info['summary'] }}
            </p>
        @endif
    </div>

    {{-- ══════════════════════════════ --}}
    {{-- EDUCATION                      --}}
    {{-- ══════════════════════════════ --}}
    @if($resume->education)
        <div class="section">
            <div class="section-title">Education</div>
            @foreach($resume->education as $edu)
                <div class="item">
                    <div class="item-title">
                        {{ $edu['degree'] ?? '' }}
                        {{ $edu['field'] ?? '' }}
                    </div>
                    <div class="item-sub">
                        {{ $edu['school'] ?? '' }}
                    </div>
                    <div class="item-date">
                        {{ $edu['start_year'] ?? '' }}
                        @if(!empty($edu['end_year']))
                            — {{ $edu['end_year'] }}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- ══════════════════════════════ --}}
    {{-- EXPERIENCE                     --}}
    {{-- ══════════════════════════════ --}}
    @if($resume->experience)
        <div class="section">
            <div class="section-title">Work Experience</div>
            @foreach($resume->experience as $exp)
                <div class="item">
                    <div class="item-title">
                        {{ $exp['position'] ?? '' }}
                    </div>
                    <div class="item-sub">
                        {{ $exp['company'] ?? '' }}
                    </div>
                    <div class="item-date">
                        {{ $exp['start_date'] ?? '' }}
                        @if(!empty($exp['end_date']))
                            — {{ $exp['end_date'] }}
                        @endif
                    </div>
                    @if(!empty($exp['description']))
                        <div class="item-desc">
                            {{ $exp['description'] }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    {{-- ══════════════════════════════ --}}
    {{-- SKILLS + TOOLS                 --}}
    {{-- ══════════════════════════════ --}}
    <div class="two-col">

        @if($resume->skills)
            <div class="section">
                <div class="section-title">Skills</div>
                <div class="tags">
                    @foreach($resume->skills as $skill)
                        <span class="tag">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        @if($resume->tools)
            <div class="section">
                <div class="section-title">Tools</div>
                <div class="tags">
                    @foreach($resume->tools as $tool)
                        <span class="tag-gray">{{ $tool }}</span>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

    {{-- ══════════════════════════════ --}}
    {{-- FOOTER                         --}}
    {{-- ══════════════════════════════ --}}
    <div class="footer">
        Paul Albert Mina · Data Analytics Portfolio · MinaPaulData
        · Generated {{ date('F d, Y') }}
    </div>

</body>
</html>