@extends('layouts.app')

@section('title', 'CPEmina — Electronics Engineering')
@section('description', 'Electronics Engineering Portfolio of Paul Albert Mina')

@push('styles')
<style>
    .hero-dark {
        background-color: #061B0E;
        background-image:
            radial-gradient(ellipse at 10% 60%, rgba(27,48,34,0.9) 0%, transparent 55%),
            radial-gradient(ellipse at 85% 15%, rgba(74,124,89,0.12) 0%, transparent 50%);
        min-height: 100vh;
    }
    .tech-card {
        background: rgba(250,249,245,0.03);
        border: 1px solid rgba(250,249,245,0.08);
        border-radius: 12px;
        padding: 20px;
        transition: all 0.3s ease;
    }
    .tech-card:hover {
        background: rgba(250,249,245,0.06);
        border-color: rgba(74,124,89,0.30);
        transform: translateY(-2px);
    }
    .project-card {
        background: #F5F0E8;
        border: 1px solid rgba(6,27,14,0.08);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .project-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 60px rgba(6,27,14,0.12);
    }
    .tag-tech {
        background: rgba(74,124,89,0.10);
        color: #4A7C59;
        border: 1px solid rgba(74,124,89,0.20);
        padding: 3px 10px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 500;
        display: inline-block;
    }
    .section-label-light {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: rgba(250,249,245,0.35);
    }
    .skill-level {
        font-size: 11px;
        font-weight: 500;
        color: #4A7C59;
        margin-top: 4px;
    }
    .profile-photo-frame {
        width: 20rem;
        height: 20rem;
        padding: 10px;
        border-radius: 12px;
        background:
            linear-gradient(145deg, rgba(74,124,89,0.25), rgba(6,27,14,0.95)),
            radial-gradient(circle at 18% 22%, rgba(154, 214, 170, 0.28), transparent 48%);
        border: 1px solid rgba(74,124,89,0.30);
        box-shadow: 0 0 60px rgba(74,124,89,0.22);
    }
    .profile-photo-frame .photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid rgba(250,249,245,0.10);
    }
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════ --}}
{{-- HERO                                    --}}
{{-- ═══════════════════════════════════════ --}}
<section class="hero-dark flex items-center">
    <div class="max-w-6xl mx-auto px-6 py-28">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Left: Text --}}
            <div>
                <div class="growth-badge mb-8"
                     style="background:rgba(74,124,89,0.12);
                            color:#4A7C59;
                            border-color:rgba(74,124,89,0.25);">
                    Electronics Engineer · Active
                </div>

                <h1 class="font-serif text-6xl font-bold leading-tight mb-6"
                    style="color:#FAF9F5;">
                    Architecting the<br>
                    <em class="font-normal" style="color:#4A7C59;">
                        Living System.
                    </em>
                </h1>

                <div class="divider-light"></div>

                <p class="text-lg leading-relaxed mb-10 max-w-md"
                   style="color:rgba(250,249,245,0.50);">
                    {{ $profile->tagline ?? 'Building precision electronics and embedded systems that bridge the physical and digital world.' }}
                </p>

                
            </div>

            {{-- Right: Photo --}}
            <div class="flex justify-center lg:justify-end">
                @if($profile && $profile->photo)
                    <div class="profile-photo-frame">
                        <img src="{{ $profile->photo_url }}"
                             alt="Paul Albert Mina CPE"
                             class="photo">
                    </div>
                @else
                    <div class="profile-photo-frame flex items-center justify-center">
                        <span class="font-serif text-5xl"
                              style="color:rgba(74,124,89,0.30);">CPE</span>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════ --}}
{{-- TECHNICAL TOOLKIT                       --}}
{{-- ═══════════════════════════════════════ --}}
@if($profile && $profile->engineering_skills)
<section style="background:#1B3022;" class="py-24">
    <div class="max-w-6xl mx-auto px-6">

        <p class="section-label-light mb-4">Proficiencies</p>
        <h2 class="font-serif text-4xl font-bold mb-12"
            style="color:#FAF9F5;">
            Technical Toolkit
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($profile->engineering_skills as $skill)
                <div class="tech-card">
                    <p class="text-sm font-medium" style="color:#FAF9F5;">
                        {{ $skill['name'] ?? '' }}
                    </p>
                    @if(!empty($skill['level']))
                        <p class="skill-level">{{ $skill['level'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ═══════════════════════════════════════ --}}
{{-- PROJECTS                                --}}
{{-- ═══════════════════════════════════════ --}}
<section style="background:#FAF9F5;" class="py-24">
    <div class="max-w-6xl mx-auto px-6">

        <p class="section-label mb-4">Work</p>
        <h2 class="font-serif text-4xl font-bold mb-12"
            style="color:#061B0E;">
            Project Grid
        </h2>

        @if($projects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                    <div class="project-card">

                        {{-- Thumbnail --}}
                        @if($project->thumbnail)
                            <img src="{{ $project->thumbnail_url }}"
                                 alt="{{ $project->title }}"
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 flex items-center justify-center"
                                 style="background:#1B3022;">
                                <span class="font-serif text-3xl"
                                      style="color:rgba(74,124,89,0.40);">⚡</span>
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
                                        <span class="tag-tech">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Links --}}
                            <div class="flex gap-4 pt-2"
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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-24">
                <p class="font-serif text-2xl mb-3" style="color:rgba(6,27,14,0.20);">
                    No projects yet.
                </p>
                <p class="text-sm" style="color:rgba(6,27,14,0.30);">
                    Projects will appear here once added from the admin panel.
                </p>
            </div>
        @endif

    </div>
</section>

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
                    Electronics Engineering
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
    window.currentNiche = 'cpemina';
</script>
@endpush

@endsection