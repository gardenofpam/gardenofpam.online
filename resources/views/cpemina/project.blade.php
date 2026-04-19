@php
    $galleryImages = $project->project_image_urls;
    $wiringImages = $project->wiring_image_urls;
    $components = collect($project->components ?? [])->filter(fn ($component) => filled($component['name'] ?? null))->values();
    $technologies = collect($project->technologies ?? [])->filter()->values();
    $codeLanguage = $project->code_language ?: 'cpp';
    $codeClass = match ($codeLanguage) {
        'cpp' => 'language-cpp',
        'python' => 'language-python',
        'php' => 'language-php',
        'javascript' => 'language-javascript',
        'html' => 'language-markup',
        'css' => 'language-css',
        'json' => 'language-json',
        'sql' => 'language-sql',
        'yaml' => 'language-yaml',
        'xml' => 'language-markup',
        default => 'language-clike',
    };
@endphp

@extends('layouts.app')

@section('title', $project->title . ' | CPEmina')
@section('description', \Illuminate\Support\Str::limit(strip_tags($project->description), 155))

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-tomorrow.min.css">
<style>
    .detail-hero {
        background:
            radial-gradient(circle at top left, rgba(116, 169, 126, 0.22), transparent 38%),
            radial-gradient(circle at 90% 10%, rgba(27, 48, 34, 0.10), transparent 28%),
            linear-gradient(180deg, #faf9f5 0%, #f5f0e8 100%);
    }
    .detail-shell {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    .detail-card {
        background: rgba(255,255,255,0.72);
        border: 1px solid rgba(6,27,14,0.10);
        border-radius: 22px;
        box-shadow: 0 18px 50px rgba(6,27,14,0.08);
    }
    .detail-slider {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        background: #102117;
    }
    .detail-slide {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .detail-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 2.75rem;
        height: 2.75rem;
        border-radius: 999px;
        background: rgba(6,27,14,0.72);
        color: #FAF9F5;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(250,249,245,0.18);
    }
    .detail-nav:hover {
        background: rgba(6,27,14,0.88);
    }
    .detail-dot {
        width: 0.7rem;
        height: 0.7rem;
        border-radius: 999px;
        background: rgba(250,249,245,0.34);
    }
    .detail-dot.is-active {
        background: #FAF9F5;
    }
    .detail-tag {
        background: rgba(74,124,89,0.10);
        color: #4A7C59;
        border: 1px solid rgba(74,124,89,0.20);
        padding: 0.45rem 0.8rem;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.04em;
    }
    .affiliate-card {
        border: 1px solid rgba(6,27,14,0.08);
        border-radius: 18px;
        background: #fffdf9;
        padding: 1.25rem;
    }
    .affiliate-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        padding: 0.7rem 1rem;
        font-size: 0.85rem;
        font-weight: 600;
        transition: transform 0.2s ease, opacity 0.2s ease;
    }
    .affiliate-button:hover {
        transform: translateY(-1px);
        opacity: 0.92;
    }
    .code-frame {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        background: #0f1720;
        border: 1px solid rgba(255,255,255,0.08);
    }
    .code-copy {
        position: absolute;
        top: 1rem;
        right: 1rem;
        z-index: 2;
        border-radius: 999px;
        background: rgba(255,255,255,0.08);
        color: #FAF9F5;
        border: 1px solid rgba(255,255,255,0.18);
        padding: 0.5rem 0.85rem;
        font-size: 0.78rem;
        font-weight: 600;
    }
    .code-copy:hover {
        background: rgba(255,255,255,0.14);
    }
    pre[class*="language-"] {
        margin: 0;
        padding: 4.5rem 1.25rem 1.5rem;
        background: transparent !important;
        max-height: 32rem;
        overflow: auto;
    }
</style>
@endpush

@section('content')
<section class="detail-hero pt-16 pb-20">
    <div class="detail-shell pt-12">
        <a href="{{ route('cpemina.index') }}"
           class="inline-flex items-center gap-2 text-sm font-medium mb-8"
           style="color:#4A7C59;">
            <span aria-hidden="true">&larr;</span>
            <span>Back to Projects</span>
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-[1.2fr,0.8fr] gap-8 items-start">
            <div class="space-y-6">
                <div>
                    <p class="section-label mb-4">Project Page</p>
                    <h1 class="font-serif text-5xl leading-tight font-bold mb-5"
                        style="color:#061B0E;">
                        {{ $project->title }}
                    </h1>
                    <p class="text-lg leading-relaxed max-w-3xl"
                       style="color:rgba(6,27,14,0.62);">
                        {{ $project->description }}
                    </p>
                </div>

                @if($technologies->isNotEmpty())
                    <div class="flex flex-wrap gap-3">
                        @foreach($technologies as $technology)
                            <span class="detail-tag">{{ $technology }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="detail-card p-6">
                <p class="section-label mb-4">Quick Links</p>
                <div class="space-y-3">
                    @if($project->github_url)
                        <a href="{{ $project->github_url }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="affiliate-button w-full"
                           style="background:#061B0E; color:#FAF9F5;">
                            View GitHub
                        </a>
                    @endif
                    @if($project->live_url)
                        <a href="{{ $project->live_url }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="affiliate-button w-full"
                           style="background:#4A7C59; color:#FAF9F5;">
                            Open Live Demo
                        </a>
                    @endif
                    <div class="text-sm pt-2"
                         style="color:rgba(6,27,14,0.46);">
                        URL: <span class="font-medium" style="color:#061B0E;">/cpemina/{{ $project->slug }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="background:#FAF9F5;" class="pb-24">
    <div class="detail-shell space-y-8">
        @if(count($galleryImages))
            <div class="detail-card p-6"
                 x-data="sliderComponent(@js($galleryImages))">
                <div class="flex items-center justify-between gap-4 mb-5">
                    <div>
                        <p class="section-label mb-2">Gallery</p>
                        <h2 class="font-serif text-3xl font-bold" style="color:#061B0E;">Image Slider</h2>
                    </div>
                    <p class="text-sm" style="color:rgba(6,27,14,0.42);" x-text="`${current + 1} / ${slides.length}`"></p>
                </div>

                <div class="detail-slider aspect-[16/10]"
                     @touchstart="touchStart($event)"
                     @touchend="touchEnd($event)">
                    <template x-for="(slide, index) in slides" :key="slide">
                        <img x-show="current === index"
                             x-transition.opacity.duration.300ms
                             :src="slide"
                             alt="{{ $project->title }}"
                             class="detail-slide">
                    </template>

                    <template x-if="slides.length > 1">
                        <button type="button" class="detail-nav left-4" @click="prev()" aria-label="Previous image">&larr;</button>
                    </template>
                    <template x-if="slides.length > 1">
                        <button type="button" class="detail-nav right-4" @click="next()" aria-label="Next image">&rarr;</button>
                    </template>

                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2">
                        <template x-for="(slide, index) in slides" :key="`${slide}-dot`">
                            <button type="button"
                                    class="detail-dot"
                                    :class="{ 'is-active': current === index }"
                                    @click="go(index)"
                                    :aria-label="`Go to image ${index + 1}`">
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 xl:grid-cols-[0.78fr,1.22fr] gap-8">
            <div class="space-y-8">
                <div class="detail-card p-6">
                    <p class="section-label mb-4">Build Sheet</p>
                    <h2 class="font-serif text-3xl font-bold mb-5" style="color:#061B0E;">Components Used</h2>

                    @if($components->isNotEmpty())
                        <div class="space-y-4">
                            @foreach($components as $component)
                                <div class="affiliate-card">
                                    <div class="flex items-start justify-between gap-4 mb-4">
                                        <p class="font-semibold" style="color:#061B0E;">
                                            {{ $component['name'] }}
                                        </p>
                                    </div>
                                    <div class="flex flex-wrap gap-3">
                                        @if(!empty($component['shopee_url']))
                                            <a href="{{ $component['shopee_url'] }}"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="affiliate-button"
                                               style="background:#EE4D2D; color:#FAF9F5;">
                                                Buy on Shopee
                                            </a>
                                        @endif
                                        @if(!empty($component['tiktok_url']))
                                            <a href="{{ $component['tiktok_url'] }}"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="affiliate-button"
                                               style="background:#111111; color:#FAF9F5;">
                                                View on TikTok
                                            </a>
                                        @endif
                                        @if(empty($component['shopee_url']) && empty($component['tiktok_url']))
                                            <span class="text-sm" style="color:rgba(6,27,14,0.45);">
                                                Affiliate links not added yet.
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm" style="color:rgba(6,27,14,0.45);">
                            Components will appear here once added from the CMS.
                        </p>
                    @endif
                </div>

                @if(count($wiringImages))
                    <div class="detail-card p-6"
                         x-data="sliderComponent(@js($wiringImages))">
                        <div class="flex items-center justify-between gap-4 mb-5">
                            <div>
                                <p class="section-label mb-2">Connections</p>
                                <h2 class="font-serif text-3xl font-bold" style="color:#061B0E;">Wiring Section</h2>
                            </div>
                            <p class="text-sm" style="color:rgba(6,27,14,0.42);" x-text="`${current + 1} / ${slides.length}`"></p>
                        </div>

                        <div class="detail-slider aspect-[4/3]"
                             @touchstart="touchStart($event)"
                             @touchend="touchEnd($event)">
                            <template x-for="(slide, index) in slides" :key="slide">
                                <img x-show="current === index"
                                     x-transition.opacity.duration.300ms
                                     :src="slide"
                                     alt="Wiring diagram for {{ $project->title }}"
                                     class="detail-slide">
                            </template>

                            <template x-if="slides.length > 1">
                                <button type="button" class="detail-nav left-4" @click="prev()" aria-label="Previous wiring image">&larr;</button>
                            </template>
                            <template x-if="slides.length > 1">
                                <button type="button" class="detail-nav right-4" @click="next()" aria-label="Next wiring image">&rarr;</button>
                            </template>
                        </div>
                    </div>
                @endif
            </div>

            <div class="space-y-8">
                @if(filled($project->content))
                    <div class="detail-card p-6 md:p-8">
                        <p class="section-label mb-4">Overview</p>
                        <h2 class="font-serif text-3xl font-bold mb-6" style="color:#061B0E;">Project Detail</h2>
                        <div class="prose max-w-none leading-relaxed"
                             style="color:rgba(6,27,14,0.66);">
                            {!! $project->content !!}
                        </div>
                    </div>
                @endif

                @if(filled($project->source_code))
                    <div class="detail-card p-6 md:p-8"
                         x-data="{ copied: false, code: @js($project->source_code) }">
                        <div class="flex items-center justify-between gap-4 mb-5">
                            <div>
                                <p class="section-label mb-2">Source</p>
                                <h2 class="font-serif text-3xl font-bold" style="color:#061B0E;">Code Section</h2>
                            </div>
                            <span class="detail-tag">{{ strtoupper($codeLanguage) }}</span>
                        </div>

                        <div class="code-frame">
                            <button type="button"
                                    class="code-copy"
                                    @click="navigator.clipboard.writeText(code); copied = true; setTimeout(() => copied = false, 1800)">
                                <span x-show="!copied">Copy Code</span>
                                <span x-show="copied" x-cloak>Copied</span>
                            </button>
                            <pre><code class="{{ $codeClass }}">{{ $project->source_code }}</code></pre>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if($relatedProjects->isNotEmpty())
            <div class="detail-card p-6 md:p-8">
                <div class="flex items-center justify-between gap-4 mb-6">
                    <div>
                        <p class="section-label mb-2">More Work</p>
                        <h2 class="font-serif text-3xl font-bold" style="color:#061B0E;">Related Projects</h2>
                    </div>
                    <a href="{{ route('cpemina.index') }}"
                       class="text-sm font-semibold"
                       style="color:#4A7C59;">
                        Back to Showcase
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                    @foreach($relatedProjects as $relatedProject)
                        <a href="{{ route('cpemina.projects.show', $relatedProject->slug) }}"
                           class="project-card group block">
                            <img src="{{ $relatedProject->thumbnail_url }}"
                                 alt="{{ $relatedProject->title }}"
                                 loading="lazy"
                                 decoding="async"
                                 class="w-full h-44 object-cover">
                            <div class="p-5">
                                <h3 class="font-serif text-xl font-semibold mb-2" style="color:#061B0E;">
                                    {{ $relatedProject->title }}
                                </h3>
                                <p class="text-sm project-summary-clamp" style="color:rgba(6,27,14,0.55);">
                                    {{ $relatedProject->description }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-c.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-cpp.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-python.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-php.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-javascript.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-json.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-sql.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-yaml.min.js"></script>
<script>
    window.currentNiche = 'cpemina';

    function sliderComponent(slides) {
        return {
            slides,
            current: 0,
            touchStartX: 0,
            next() {
                this.current = (this.current + 1) % this.slides.length;
            },
            prev() {
                this.current = (this.current - 1 + this.slides.length) % this.slides.length;
            },
            go(index) {
                this.current = index;
            },
            touchStart(event) {
                this.touchStartX = event.changedTouches[0].clientX;
            },
            touchEnd(event) {
                const delta = event.changedTouches[0].clientX - this.touchStartX;

                if (Math.abs(delta) < 40) {
                    return;
                }

                if (delta < 0) {
                    this.next();
                    return;
                }

                this.prev();
            },
        };
    }
</script>
@endpush

@endsection
