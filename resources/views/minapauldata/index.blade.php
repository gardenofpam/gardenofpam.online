@extends('layouts.app')

@section('title', 'MinaPaulData — Data Analytics Portfolio')
@section('description', 'Data Analytics Portfolio of Paul Albert Mina')

@push('styles')
<style>
    .hero-bg {
        background-color: #FAF9F5;
        background-image:
            radial-gradient(ellipse at 15% 50%, rgba(74,124,89,0.06) 0%, transparent 55%),
            radial-gradient(ellipse at 85% 20%, rgba(27,48,34,0.04) 0%, transparent 50%);
        min-height: 100vh;
    }
    .stat-card {
        background: #F5F0E8;
        border: 1px solid rgba(6,27,14,0.08);
        border-radius: 12px;
        padding: 24px;
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 40px rgba(6,27,14,0.10);
    }
    .project-card {
        background: #FAF9F5;
        border: 1px solid rgba(6,27,14,0.08);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .project-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 60px rgba(6,27,14,0.12);
    }
    .cert-card {
        background: #F5F0E8;
        border: 1px solid rgba(6,27,14,0.08);
        border-radius: 12px;
        padding: 24px;
        transition: all 0.3s ease;
    }
    .cert-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(6,27,14,0.10);
    }
    .skill-card {
        background: #FAF9F5;
        border: 1px solid rgba(6,27,14,0.08);
        border-radius: 12px;
        padding: 20px;
        transition: all 0.3s ease;
        text-align: center;
    }
    .skill-card:hover {
        border-color: rgba(74,124,89,0.25);
        transform: translateY(-2px);
    }
    .tag-data {
        background: rgba(74,124,89,0.08);
        color: #4A7C59;
        border: 1px solid rgba(74,124,89,0.15);
        padding: 3px 10px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 500;
        display: inline-block;
    }
    .tag-skill {
        background: #F5F0E8;
        color: rgba(6,27,14,0.60);
        border: 1px solid rgba(6,27,14,0.08);
        padding: 6px 14px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 500;
        display: inline-block;
    }
    .resume-section {
        border-bottom: 1px solid rgba(6,27,14,0.06);
        padding-bottom: 28px;
        margin-bottom: 28px;
    }
    .resume-section:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }
    .resume-viewer-shell {
        background: #ffffff;
        border: 1px solid rgba(6,27,14,0.10);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 18px 56px rgba(6,27,14,0.08);
    }
    .resume-viewer-frame {
        width: 100%;
        height: 780px;
        border: 0;
        background: #ffffff;
    }
    .resume-meta-card {
        background: #FAF9F5;
        border: 1px solid rgba(6,27,14,0.08);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 12px 32px rgba(6,27,14,0.05);
    }
    .resume-meta-label {
        font-size: 11px;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: rgba(6,27,14,0.40);
        margin-bottom: 10px;
    }
    .profile-photo-frame {
        width: 22rem;
        height: 22rem;
        padding: 10px;
        border-radius: 14px;
        background:
            linear-gradient(160deg, rgba(27,48,34,0.90) 0%, rgba(74,124,89,0.38) 100%),
            radial-gradient(circle at 20% 18%, rgba(145, 214, 166, 0.24) 0%, transparent 52%);
        border: 1px solid rgba(74,124,89,0.25);
        box-shadow: 0 18px 56px rgba(6,27,14,0.16);
    }
    .profile-photo-frame .photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid rgba(250,249,245,0.12);
    }
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════ --}}
{{-- HERO                                    --}}
{{-- ═══════════════════════════════════════ --}}
<section class="hero-bg flex items-center">
    <div class="max-w-6xl mx-auto px-6 py-28">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Left: Text --}}
            <div>
                <div class="growth-badge mb-8">
                    Data Analyst · Active
                </div>

                <h1 class="font-serif text-6xl font-bold leading-tight mb-6"
                    style="color:#061B0E;">
                    PRUNING<br>
                    <em class="font-normal" style="color:#4A7C59;">
                        Complexity.
                    </em>
                </h1>

                <div class="divider"></div>

                <p class="text-lg leading-relaxed mb-10 max-w-md"
                   style="color:rgba(6,27,14,0.55);">
                    {{ $profile->tagline ?? 'Turning raw data into meaningful insights through modeling, visualization, and analytical thinking.' }}
                </p>

                <div class="flex items-center gap-4 flex-wrap">
                    @if($resume)
                        <a href="{{ route('resume.view') }}"
                           target="_blank"
                           style="background:#FAF9F5; color:#061B0E; border:1px solid rgba(6,27,14,0.10); border-radius:10px;"
                           class="px-6 py-3 text-sm font-medium tracking-wide hover:opacity-90 transition-opacity inline-flex items-center gap-2">
                            View Resume
                        </a>
                        <a href="{{ route('resume.download') }}"
                           style="background:#061B0E; color:#FAF9F5; border-radius:10px;"
                           class="px-6 py-3 text-sm font-medium tracking-wide hover:opacity-90 transition-opacity inline-flex items-center gap-2">
                            Download Resume →
                        </a>
                    @endif
                </div>
            </div>

            {{-- Right: Photo --}}
            <div class="flex justify-center lg:justify-end">
                <div class="relative">
                    @if($profile && $profile->photo)
                        <div class="profile-photo-frame">
                            <img src="{{ $profile->photo_url }}"
                                 alt="Paul Albert Mina Data"
                                 class="photo shadow-arb">
                        </div>
                    @else
                        <div class="profile-photo-frame flex items-center justify-center">
                            <span class="font-serif text-5xl"
                                  style="color:rgba(74,124,89,0.25);">Data</span>
                        </div>
                    @endif

                    {{-- Floating Stat Card --}}
                    <div style="background:#FAF9F5;
                                border:1px solid rgba(6,27,14,0.06);
                                border-radius:12px;"
                         class="absolute -bottom-4 -left-4 px-4 py-3 shadow-arb">
                        <p class="section-label">System Health</p>
                        <p class="text-sm font-medium mt-0.5" style="color:#4A7C59;">
                            99.98% Active 🟢
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════ --}}
{{-- HEALTH STATS                            --}}
{{-- ═══════════════════════════════════════ --}}
<section style="background:#F5F0E8;" class="py-16">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            <div class="stat-card text-center">
                <p class="font-serif text-3xl font-bold mb-1"
                   style="color:#061B0E;">
                    {{ $projects->count() }}
                </p>
                <p class="section-label">Projects</p>
            </div>

            <div class="stat-card text-center">
                <p class="font-serif text-3xl font-bold mb-1"
                   style="color:#061B0E;">
                    {{ $certificates->count() }}
                </p>
                <p class="section-label">Certificates</p>
            </div>

            <div class="stat-card text-center">
                <p class="font-serif text-3xl font-bold mb-1"
                   style="color:#061B0E;">
                    {{ $profile && $profile->data_skills ? count($profile->data_skills) : 0 }}
                </p>
                <p class="section-label">Skills</p>
            </div>

            <div class="stat-card text-center">
                <p class="font-serif text-3xl font-bold mb-1"
                   style="color:#4A7C59;">
                    99.98%
                </p>
                <p class="section-label">System Health</p>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════ --}}
{{-- DATA SKILLS                             --}}
{{-- ═══════════════════════════════════════ --}}
@if($profile && $profile->data_skills)
<section style="background:#FAF9F5;" class="py-24">
    <div class="max-w-6xl mx-auto px-6">

        <p class="section-label mb-4">Proficiencies</p>
        <h2 class="font-serif text-4xl font-bold mb-12"
            style="color:#061B0E;">
            Technological Foundations
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($profile->data_skills as $skill)
                <div class="skill-card">
                    <p class="text-sm font-medium mb-1"
                       style="color:#061B0E;">
                        {{ $skill['name'] ?? '' }}
                    </p>
                    @if(!empty($skill['level']))
                        <span class="tag-data">{{ $skill['level'] }}</span>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ═══════════════════════════════════════ --}}
{{-- PROJECTS / CASE STUDIES                 --}}
{{-- ═══════════════════════════════════════ --}}
<section style="background:#F5F0E8;" class="py-24">
    <div class="max-w-6xl mx-auto px-6">

        <p class="section-label mb-4">Portfolio</p>
        <h2 class="font-serif text-4xl font-bold mb-12"
            style="color:#061B0E;">
            Case Studies
        </h2>

        @if($projects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                    <div class="project-card">

                        {{-- Thumbnail --}}
                        @if($project->thumbnail)
                            <div class="relative w-full h-48 flex items-center justify-center overflow-hidden" style="background:#F5F0E8;">
                                @if($project->status === 'coming_soon')
                                    <span class="tag-data absolute top-3 left-3 z-10">Coming Soon</span>
                                @endif
                                <img src="{{ $project->thumbnail_url }}"
                                     alt=""
                                     aria-hidden="true"
                                     class="absolute inset-0 w-full h-full object-cover scale-110 opacity-55">
                                <div class="absolute inset-0" style="background:linear-gradient(180deg, rgba(245,240,232,0.18) 0%, rgba(245,240,232,0.34) 100%);"></div>
                                <img src="{{ $project->thumbnail_url }}"
                                     alt="{{ $project->title }}"
                                     class="relative z-[1] w-full h-full object-contain">
                            </div>
                        @else
                            <div class="w-full h-48 flex items-center justify-center"
                                 style="background:#061B0E;">
                                <span class="font-serif text-3xl"
                                      style="color:rgba(74,124,89,0.35);">📊</span>
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="font-serif text-lg font-semibold mb-2"
                                style="color:#061B0E;">
                                {{ $project->title }}
                            </h3>
                            <p class="text-sm leading-relaxed mb-4"
                               style="color:rgba(6,27,14,0.55);">
                                {{ $project->description }}
                            </p>

                            {{-- Technologies --}}
                            @if($project->technologies)
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach($project->technologies as $tech)
                                        <span class="tag-data">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Links --}}
                            <div class="flex gap-4 pt-3"
                                 style="border-top:1px solid rgba(6,27,14,0.06);">
                                @if($project->github_url)
                                    <a href="{{ $project->github_url }}"
                                       target="_blank"
                                       class="text-xs font-medium hover:opacity-70 transition-opacity"
                                       style="color:#4A7C59;">
                                        GitHub →
                                    </a>
                                @endif
                                @if($project->live_url)
                                    <a href="{{ $project->live_url }}"
                                       target="_blank"
                                       class="text-xs font-medium hover:opacity-70 transition-opacity"
                                       style="color:#4A7C59;">
                                        Live Demo →
                                    </a>
                                @endif
                                @if($project->status === 'coming_soon' && ! $project->github_url && ! $project->live_url)
                                    <span class="text-xs font-medium" style="color:#4A7C59;">
                                        Slug unavailable until launch
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-24">
                <p class="font-serif text-2xl mb-3"
                   style="color:rgba(6,27,14,0.20);">
                    No case studies yet.
                </p>
                <p class="text-sm" style="color:rgba(6,27,14,0.30);">
                    Projects will appear here once added from the admin panel.
                </p>
            </div>
        @endif

    </div>
</section>

{{-- ═══════════════════════════════════════ --}}
{{-- CERTIFICATES                            --}}
{{-- ═══════════════════════════════════════ --}}
@if($certificates->count() > 0)
<section style="background:#FAF9F5;" class="py-24">
    <div class="max-w-6xl mx-auto px-6">

        <p class="section-label mb-4">Credentials</p>
        <h2 class="font-serif text-4xl font-bold mb-12"
            style="color:#061B0E;">
            Certificates
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($certificates as $certificate)
                <div class="cert-card">

                    @if($certificate->image)
                        <img src="{{ $certificate->image_url }}"
                             alt="{{ $certificate->title }}"
                             class="w-full h-36 object-cover mb-4"
                             style="border-radius:8px;">
                    @else
                        <div class="w-full h-36 flex items-center justify-center mb-4"
                             style="background:rgba(6,27,14,0.04);
                                    border-radius:8px;
                                    border:1px solid rgba(6,27,14,0.06);">
                            <span style="color:rgba(6,27,14,0.20); font-size:28px;">🏆</span>
                        </div>
                    @endif

                    <h3 class="font-serif text-lg font-semibold mb-1"
                        style="color:#061B0E;">
                        {{ $certificate->title }}
                    </h3>
                    <p class="text-sm font-medium mb-2"
                       style="color:#4A7C59;">
                        {{ $certificate->issuer }}
                    </p>
                    <p class="text-xs mb-4"
                       style="color:rgba(6,27,14,0.35);">
                        Issued: {{ $certificate->issued_date->format('M Y') }}
                        @if($certificate->expiry_date)
                            · Expires: {{ $certificate->expiry_date->format('M Y') }}
                        @endif
                    </p>

                    @if($certificate->credential_url)
                        <a href="{{ $certificate->credential_url }}"
                           target="_blank"
                           class="text-xs font-medium hover:opacity-70 transition-opacity"
                           style="color:#4A7C59;">
                            View Credential →
                        </a>
                    @endif

                </div>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ═══════════════════════════════════════ --}}
{{-- FOOTER                                  --}}
{{-- ═══════════════════════════════════════ --}}
<footer style="background:#061B0E; border-top:1px solid rgba(250,249,245,0.05);"
        class="py-12">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <p class="font-serif text-lg font-semibold"
                   style="color:#FAF9F5;">
                    Paul Albert Mina
                </p>
                <p style="color:rgba(250,249,245,0.25); font-size:12px;"
                   class="mt-1">
                    Data Analytics Portfolio
                </p>
            </div>
            <div class="flex gap-8">
                <a href="{{ route('gardenofpam.index') }}"
                   class="nav-link hover:opacity-80 transition-opacity"
                   style="color:rgba(250,249,245,0.35);">
                    Garden
                </a>
                <a href="{{ route('cpemina.index') }}"
                   class="nav-link hover:opacity-80 transition-opacity"
                   style="color:rgba(250,249,245,0.35);">
                    Engineering
                </a>
                <a href="{{ route('minapauldata.index') }}"
                   class="nav-link hover:opacity-80 transition-opacity"
                   style="color:rgba(250,249,245,0.35);">
                    Data
                </a>
            </div>
            <p style="color:rgba(250,249,245,0.20); font-size:12px;">
                © {{ date('Y') }} Paul Albert Mina
            </p>
        </div>
    </div>
</footer>

@push('scripts')
<script>
    window.currentNiche = 'minapauldata';
</script>
@endpush

@endsection
