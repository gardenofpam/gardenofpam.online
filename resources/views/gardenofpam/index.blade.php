@extends('layouts.app')

@section('title', 'GardenofPam — Paul Albert Mina')
@section('description', 'Welcome to my digital garden')

@push('styles')
<style>
    .hero-bg {
        background-color: #FAF9F5;
        background-image:
            radial-gradient(ellipse at 20% 50%, rgba(74,124,89,0.07) 0%, transparent 60%),
            radial-gradient(ellipse at 80% 20%, rgba(27,48,34,0.05) 0%, transparent 50%);
        min-height: 100vh;
    }
    .branch-card {
        background: #F5F0E8;
        border: 1px solid rgba(6,27,14,0.08);
        border-radius: 16px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: block;
    }
    .branch-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 60px rgba(6,27,14,0.12);
        border-color: rgba(6,27,14,0.15);
    }
    .project-card {
        background: #FAF9F5;
        border: 1px solid rgba(6,27,14,0.08);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .project-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 60px rgba(6,27,14,0.12);
    }
    .movie-card {
        background: #F5F0E8;
        border: 1px solid rgba(6,27,14,0.08);
        border-radius: 12px;
        padding: 24px;
        transition: all 0.3s ease;
    }
    .movie-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(6,27,14,0.10);
    }
    .series-card {
        background: #FAF9F5;
        border: 1px solid rgba(6,27,14,0.08);
        border-radius: 12px;
        padding: 24px;
        transition: all 0.3s ease;
    }
    .series-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(6,27,14,0.10);
    }
    .interest-tag {
        background: #FAF9F5;
        border: 1px solid rgba(6,27,14,0.10);
        color: rgba(6,27,14,0.70);
        padding: 8px 16px;
        border-radius: 100px;
        font-size: 13px;
        font-weight: 500;
        display: inline-block;
    }
    .project-tag {
        background: rgba(74,124,89,0.08);
        color: #4A7C59;
        border: 1px solid rgba(74,124,89,0.15);
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
    }
    .profile-photo-frame {
        width: 22rem;
        height: 22rem;
        padding: 12px;
        border-radius: 32% 68% 55% 45% / 35% 40% 60% 65%;
        background:
            radial-gradient(circle at 22% 20%, rgba(123, 167, 102, 0.32) 0%, transparent 45%),
            radial-gradient(circle at 80% 78%, rgba(74, 124, 89, 0.22) 0%, transparent 48%),
            linear-gradient(145deg, #edf4e8 0%, #dae8d2 100%);
        border: 1px solid rgba(74,124,89,0.22);
        box-shadow: 0 18px 54px rgba(27,48,34,0.12);
    }
    .profile-photo-frame .photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: inherit;
        border: 1px solid rgba(6,27,14,0.10);
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
                    Growth Phase · {{ date('Y') }}
                </div>

                <h1 class="font-serif text-6xl font-bold leading-tight mb-6"
                    style="color:#061B0E;">
                    Welcome to my<br>
                    <em class="font-normal" style="color:#4A7C59;">
                        digital garden,
                    </em>
                </h1>

                <div class="divider"></div>

                <p class="text-lg leading-relaxed mb-10 max-w-md"
                   style="color:rgba(6,27,14,0.55);">
                    {{ $profile->tagline ?? 'where ideas grow and evolve over time. This space reflects my journey in technology, creativity, and continuous learning. Here you’ll find my projects, skills, and experiments as I build and improve them.' }}
                </p>

                <div class="flex items-center gap-4 flex-wrap">
                    
                    <a href="#about"
                       style="color:rgba(6,27,14,0.45); font-size:14px; font-weight:500;"
                       class="hover:opacity-80 transition-opacity">
                        Learn More ↓
                    </a>
                </div>
            </div>

            {{-- Right: Photo --}}
            <div class="flex justify-center lg:justify-end">
                <div class="relative">
                    @if($profile && $profile->photo)
                        <div class="profile-photo-frame organic-shape">
                            <img src="{{ $profile->photo_url }}"
                                 alt="Paul Albert Mina"
                                 class="photo shadow-arb">
                        </div>
                    @else
                        <div class="profile-photo-frame organic-shape flex items-center justify-center">
                            <span class="font-serif text-7xl" style="color:rgba(74,124,89,0.3);">P</span>
                        </div>
                    @endif

                    {{-- Floating Info Card --}}
                    <div style="background:#FAF9F5; border:1px solid rgba(6,27,14,0.06); border-radius:12px;"
                         class="absolute -bottom-4 -left-4 px-4 py-3 shadow-arb">
                        <p class="section-label">Based in</p>
                        <p class="text-sm font-medium mt-0.5" style="color:#061B0E;">
                            Philippines 🌿
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════ --}}
{{-- ABOUT                                   --}}
{{-- ═══════════════════════════════════════ --}}
<section id="about" style="background:#F5F0E8;" class="py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

            {{-- Bio --}}
            <div>
                <p class="section-label mb-4">About Me</p>
                <h2 class="font-serif text-4xl font-bold mb-6" style="color:#061B0E;">
                    The person behind<br>the garden.
                </h2>
                <div class="divider"></div>

                @if($profile && $profile->bio)
                    <div class="leading-relaxed text-base prose max-w-none"
                         style="color:rgba(6,27,14,0.60);">
                        {!! $profile->bio !!}
                    </div>
                @else
                    <p style="color:rgba(6,27,14,0.35);" class="italic text-sm">
                        Bio coming soon...
                    </p>
                @endif
            </div>

            {{-- Interests --}}
            <div>
                <p class="section-label mb-6">What I Like</p>
                @if($profile && $profile->interests)
                    <div class="flex flex-wrap gap-3">
                        @foreach($profile->interests as $interest)
                            <span class="interest-tag">{{ $interest }}</span>
                        @endforeach
                    </div>
                @else
                    <p style="color:rgba(6,27,14,0.35);" class="italic text-sm">
                        Interests coming soon...
                    </p>
                @endif
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════ --}}
{{-- FAVORITE MOVIES                         --}}
{{-- ═══════════════════════════════════════ --}}
@if($profile && $profile->favorite_movies)
<section style="background:#FAF9F5;" class="py-24">
    <div class="max-w-6xl mx-auto px-6">

        <p class="section-label mb-4">Cinema</p>
        <h2 class="font-serif text-4xl font-bold mb-12" style="color:#061B0E;">
            Favorite Movies
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($profile->favorite_movies as $movie)
                <div class="movie-card">
                    <div class="flex justify-between items-start mb-4">
                        <span class="section-label">
                            {{ $movie['genre'] ?? 'Film' }}
                        </span>
                        @if(!empty($movie['year']))
                            <span style="color:rgba(6,27,14,0.25); font-size:12px;">
                                {{ $movie['year'] }}
                            </span>
                        @endif
                    </div>
                    <h3 class="font-serif text-xl font-semibold mb-3"
                        style="color:#061B0E;">
                        {{ $movie['title'] ?? '' }}
                    </h3>
                    @if(!empty($movie['reason']))
                        <p class="text-sm leading-relaxed"
                           style="color:rgba(6,27,14,0.50);">
                            {{ $movie['reason'] }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ═══════════════════════════════════════ --}}
{{-- FAVORITE SERIES                         --}}
{{-- ═══════════════════════════════════════ --}}
@if($profile && $profile->favorite_series)
<section style="background:#F5F0E8;" class="py-24">
    <div class="max-w-6xl mx-auto px-6">

        <p class="section-label mb-4">Television</p>
        <h2 class="font-serif text-4xl font-bold mb-12" style="color:#061B0E;">
            Favorite Series
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($profile->favorite_series as $series)
                <div class="series-card">
                    <div class="flex justify-between items-start mb-4">
                        <span class="section-label">
                            {{ $series['genre'] ?? 'Series' }}
                        </span>
                        @if(!empty($series['seasons']))
                            <span style="color:rgba(6,27,14,0.25); font-size:12px;">
                                {{ $series['seasons'] }} Seasons
                            </span>
                        @endif
                    </div>
                    <h3 class="font-serif text-xl font-semibold mb-3"
                        style="color:#061B0E;">
                        {{ $series['title'] ?? '' }}
                    </h3>
                    @if(!empty($series['reason']))
                        <p class="text-sm leading-relaxed"
                           style="color:rgba(6,27,14,0.50);">
                            {{ $series['reason'] }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ═══════════════════════════════════════ --}}
<section style="background:#FAF9F5;" class="py-24">
    <div class="max-w-6xl mx-auto px-6">
        <p class="section-label mb-4">Projects</p>
        <h2 class="font-serif text-4xl font-bold mb-12" style="color:#061B0E;">
            Things Growing in the Garden
        </h2>

        @if($projects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                    <article class="project-card">
                        <img src="{{ $project->thumbnail_url }}"
                             alt="{{ $project->title }}"
                             loading="lazy"
                             decoding="async"
                             class="w-full h-56 object-cover">

                        <div class="p-6">
                            <h3 class="font-serif text-xl font-semibold mb-3" style="color:#061B0E;">
                                {{ $project->title }}
                            </h3>
                            <p class="text-sm leading-relaxed mb-4" style="color:rgba(6,27,14,0.58);">
                                {{ $project->description }}
                            </p>

                            @if($project->technologies)
                                <div class="flex flex-wrap gap-2 mb-5">
                                    @foreach(collect($project->technologies)->take(4) as $technology)
                                        <span class="project-tag">{{ $technology }}</span>
                                    @endforeach
                                </div>
                            @endif

                            @if($project->github_url || $project->live_url)
                                <div class="flex flex-wrap gap-4 pt-4" style="border-top:1px solid rgba(6,27,14,0.06);">
                                    @if($project->github_url)
                                        <a href="{{ $project->github_url }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="text-sm font-semibold hover:opacity-75 transition-opacity"
                                           style="color:#4A7C59;">
                                            View Source &rarr;
                                        </a>
                                    @endif
                                    @if($project->live_url)
                                        <a href="{{ $project->live_url }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="text-sm font-semibold hover:opacity-75 transition-opacity"
                                           style="color:#4A7C59;">
                                            Open Project &rarr;
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <p class="font-serif text-2xl mb-3" style="color:rgba(6,27,14,0.22);">
                    No projects yet.
                </p>
                <p class="text-sm" style="color:rgba(6,27,14,0.35);">
                    GardenOfPam projects will appear here once added from the CMS.
                </p>
            </div>
        @endif
    </div>
</section>

{{-- THE BRANCHES                            --}}
{{-- ═══════════════════════════════════════ --}}
<section style="background:#061B0E;" class="py-24">
    <div class="max-w-6xl mx-auto px-6">

        <p class="section-label mb-4" style="color:rgba(250,249,245,0.35);">
            Explore More
        </p>
        <h2 class="font-serif text-4xl font-bold mb-12" style="color:#FAF9F5;">
            The Branches
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- CPEmina --}}
            <a href="{{ route('cpemina.index') }}" class="branch-card group"
               style="background:rgba(250,249,245,0.04); border:1px solid rgba(250,249,245,0.08);">
                <div class="p-8">
                    <p class="section-label mb-4" style="color:rgba(250,249,245,0.30);">
                        Computer Engineering
                    </p>
                    <h3 class="font-serif text-3xl font-bold mb-3" style="color:#FAF9F5;">
                        CPEmina
                    </h3>
                    <p class="text-sm leading-relaxed mb-6"
                       style="color:rgba(250,249,245,0.45);">
                        Architecting living systems through electronics and embedded engineering.
                    </p>
                    <span style="color:rgba(250,249,245,0.35); font-size:13px; font-weight:500;">
                        View Portfolio →
                    </span>
                </div>
            </a>

            {{-- MinaPaulData --}}
            <a href="{{ route('minapauldata.index') }}" class="branch-card group"
               style="background:rgba(250,249,245,0.04); border:1px solid rgba(250,249,245,0.08);">
                <div class="p-8">
                    <p class="section-label mb-4" style="color:rgba(250,249,245,0.30);">
                        Data Analytics
                    </p>
                    <h3 class="font-serif text-3xl font-bold mb-3" style="color:#FAF9F5;">
                        MinaPaulData
                    </h3>
                    <p class="text-sm leading-relaxed mb-6"
                       style="color:rgba(250,249,245,0.45);">
                        Synthesizing complexity into clarity through data modeling and visual synthesis.
                    </p>
                    <span style="color:rgba(250,249,245,0.35); font-size:13px; font-weight:500;">
                        View Portfolio →
                    </span>
                </div>
            </a>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════ --}}
{{-- FOOTER                                  --}}
{{-- ═══════════════════════════════════════ --}}
<footer style="background:#061B0E; border-top:1px solid rgba(250,249,245,0.05);" class="py-12">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <p class="font-serif text-lg font-semibold" style="color:#FAF9F5;">
                    Paul Albert Mina
                </p>
                <p style="color:rgba(250,249,245,0.25); font-size:12px;" class="mt-1">
                    Stay for a while.
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
    window.currentNiche = 'gardenofpam';
</script>
@endpush

@endsection
