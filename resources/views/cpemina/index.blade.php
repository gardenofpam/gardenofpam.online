@extends('layouts.app')

@section('title', 'CPEmina - Computer Engineering')
@section('description', 'Computer Engineering Portfolio of Paul Albert Mina')

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
        border-radius: 18px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .project-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 60px rgba(6,27,14,0.12);
    }
    .project-showcase-track {
        display: flex;
        gap: 1.5rem;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        padding-bottom: 1rem;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .project-showcase-track::-webkit-scrollbar {
        display: none;
    }
    .project-showcase-slide {
        min-width: min(85vw, 24rem);
        scroll-snap-align: start;
    }
    @media (min-width: 768px) {
        .project-showcase-slide {
            min-width: 26rem;
        }
    }
    .project-summary-clamp {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
    }
    .showcase-nav {
        width: 3rem;
        height: 3rem;
        border-radius: 999px;
        border: 1px solid rgba(6,27,14,0.10);
        background: #F5F0E8;
        color: #061B0E;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s ease, background 0.2s ease;
    }
    .showcase-nav:hover {
        transform: translateY(-1px);
        background: #ece4d8;
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
        height: 35rem;
        padding: 12px;
        border-radius: 2.25rem;
        background:
            linear-gradient(145deg, rgba(74,124,89,0.25), rgba(6,27,14,0.95)),
            radial-gradient(circle at 18% 22%, rgba(154, 214, 170, 0.28), transparent 48%);
        border: 1px solid rgba(74,124,89,0.30);
        box-shadow: 0 0 60px rgba(74,124,89,0.22);
        position: relative;
    }
    .profile-photo-frame::before {
        content: "";
        position: absolute;
        top: 12px;
        left: 50%;
        transform: translateX(-50%);
        width: 7rem;
        height: 1.6rem;
        border-radius: 999px;
        background: rgba(6,27,14,0.92);
        border: 1px solid rgba(250,249,245,0.08);
        z-index: 2;
    }
    .profile-photo-frame .photo,
    .profile-photo-frame .phone-video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 1.8rem;
        border: 1px solid rgba(250,249,245,0.10);
        background: #0b130d;
    }
    .profile-photo-frame .photo {
        object-position: center top;
    }
</style>
@endpush

@section('content')

<section class="hero-dark flex items-center">
    <div class="max-w-6xl mx-auto px-6 py-28">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <div class="growth-badge mb-8"
                     style="background:rgba(74,124,89,0.12); color:#4A7C59; border-color:rgba(74,124,89,0.25);">
                    Computer Engineer - Active
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
                    {{ $profile->tagline ?? "Life is like soldering, rush it or lose focus and it will not hold; with patience and precision, you build something strong and lasting." }}
                </p>
            </div>

            <div class="flex justify-center lg:justify-end">
                @if($profile && $profile->phone_video_url)
                    <div class="profile-photo-frame">
                        <video
                            class="phone-video"
                            src="{{ $profile->phone_video_url }}"
                            autoplay
                            muted
                            loop
                            playsinline>
                        </video>
                    </div>
                @elseif($profile && $profile->photo)
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

<section style="background:#FAF9F5;" class="py-24">
    <div class="max-w-6xl mx-auto px-6"
         x-data="{ scrollProjects(direction) { const amount = window.innerWidth >= 768 ? 440 : 320; this.$refs.projectTrack.scrollBy({ left: direction * amount, behavior: 'smooth' }); } }">

        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between mb-12">
            <div>
                <p class="section-label mb-4">Work</p>
                <h2 class="font-serif text-4xl font-bold"
                    style="color:#061B0E;">
                    Interactive Project Showcase
                </h2>
            </div>

            <div class="flex items-center gap-3">
                <button type="button"
                        class="showcase-nav"
                        @click="scrollProjects(-1)"
                        aria-label="Scroll projects left">
                    <span aria-hidden="true">&larr;</span>
                </button>
                <button type="button"
                        class="showcase-nav"
                        @click="scrollProjects(1)"
                        aria-label="Scroll projects right">
                    <span aria-hidden="true">&rarr;</span>
                </button>
            </div>
        </div>

        @if($projects->count() > 0)
            <div class="project-showcase-track"
                 x-ref="projectTrack">
                @foreach($projects as $project)
                    @php($isComingSoon = $project->status === 'coming_soon')
                    @if($isComingSoon)
                        <article class="project-card project-showcase-slide block">
                    @else
                        <a href="{{ route('cpemina.projects.show', $project->slug) }}"
                           class="project-card project-showcase-slide group block">
                    @endif
                            <div class="w-full h-56 flex items-center justify-center overflow-hidden" style="background:#ece4d8;">
                                <img src="{{ $project->thumbnail_url }}"
                                     alt="{{ $project->title }}"
                                     loading="lazy"
                                     decoding="async"
                                     class="w-full h-full object-contain transition-transform duration-300 group-hover:scale-[1.02]">
                            </div>

                            <div class="p-6">
                                @if($isComingSoon)
                                    <span class="tag-tech mb-3">Coming Soon</span>
                                @endif

                                <h3 class="font-serif text-lg font-semibold mb-2"
                                    style="color:#061B0E;">
                                    {{ $project->title }}
                                </h3>
                                <p class="text-sm leading-relaxed mb-4 project-summary-clamp"
                                   style="color:rgba(6,27,14,0.55);">
                                    {{ $project->description }}
                                </p>

                                @if($project->technologies)
                                    <div class="flex flex-wrap gap-2 mb-5">
                                        @foreach(collect($project->technologies)->take(4) as $tech)
                                            <span class="tag-tech">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="flex items-center justify-between gap-4 pt-3"
                                     style="border-top:1px solid rgba(6,27,14,0.06);">
                                    <span class="text-xs font-medium tracking-[0.16em] uppercase"
                                          style="color:rgba(6,27,14,0.35);">
                                        {{ $isComingSoon ? 'Slug Unavailable' : 'Dedicated Page' }}
                                    </span>
                                    <span class="text-sm font-semibold transition-transform duration-200 group-hover:translate-x-1"
                                          style="color:#4A7C59;">
                                        {{ $isComingSoon ? 'Coming Soon' : 'Explore →' }}
                                    </span>
                                </div>
                            </div>
                    @if($isComingSoon)
                        </article>
                    @else
                        </a>
                    @endif
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
                    Computer Engineering
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
                &copy; {{ date('Y') }} Paul Albert Mina
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
