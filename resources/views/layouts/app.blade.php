<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Paul Albert Mina')</title>
    <meta name="description" content="@yield('description', 'Paul Albert Mina Portfolio')">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,600;0,700;1,400&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'forest':    '#061B0E',
                        'botanical': '#1B3022',
                        'parchment': '#FAF9F5',
                        'sage':      '#4A7C59',
                        'moss':      '#2D5016',
                        'cream':     '#F5F0E8',
                        'bark':      '#8B7355',
                    },
                    fontFamily: {
                        'serif':  ['Noto Serif', 'serif'],
                        'sans':   ['Space Grotesk', 'sans-serif'],
                    },
                    borderRadius: {
                        'arb': '12px',
                    }
                }
            }
        }
    </script>

    <style>
        * { font-family: 'Space Grotesk', sans-serif; }
        .font-serif { font-family: 'Noto Serif', serif; }

        /* Subtle shadow system */
        .shadow-arb {
            box-shadow: 0 4px 24px rgba(6, 27, 14, 0.08);
        }
        .shadow-arb-hover {
            box-shadow: 0 8px 40px rgba(6, 27, 14, 0.14);
        }

        /* Card hover */
        .card-arb {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
        }
        .card-arb:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 40px rgba(6, 27, 14, 0.14);
        }

        /* Organic shape */
        .organic-shape {
            border-radius: 60% 40% 55% 45% / 45% 55% 45% 55%;
        }

        /* Nav link */
        .nav-link {
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            transition: color 0.2s ease;
        }

        /* Status badge */
        .growth-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(74, 124, 89, 0.12);
            color: #4A7C59;
            border: 1px solid rgba(74, 124, 89, 0.25);
            padding: 4px 12px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.04em;
        }

        .growth-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            background: #4A7C59;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        [x-cloak] { display: none !important; }
    </style>

    @stack('styles')
</head>
<body class="bg-parchment text-forest">

    {{-- Navigation --}}
    <nav class="fixed top-0 w-full z-50 bg-parchment/90 backdrop-blur-md border-b border-forest/8">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">

            {{-- Logo --}}
            <a href="{{ route('gardenofpam.index') }}"
            class="font-serif text-lg font-semibold text-forest tracking-tight">
                <span class="hidden sm:inline">Paul Albert Mina</span>
                <span class="inline sm:hidden">PAM</span>
            </a>

            {{-- Nav Links --}}
            <div class="flex items-center gap-8">
                <a href="{{ route('gardenofpam.index') }}"
                   class="nav-link {{ request()->is('gardenofpam*') ? 'text-forest' : 'text-forest/50 hover:text-forest' }}">
                    Garden
                </a>
                <a href="{{ route('cpemina.index') }}"
                   class="nav-link {{ request()->is('cpemina*') ? 'text-forest' : 'text-forest/50 hover:text-forest' }}">
                    Engineering
                </a>
                <a href="{{ route('minapauldata.index') }}"
                   class="nav-link {{ request()->is('minapauldata*') ? 'text-forest' : 'text-forest/50 hover:text-forest' }}">
                    Data
                </a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="pt-16">
        @yield('content')
    </main>

    {{-- Message Modal --}}
    @include('layouts.message-modal')

    {{-- Flash Messages --}}
    @if(session('success'))
        <div x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 5000)"
             x-transition
             class="fixed bottom-6 right-6 bg-botanical text-parchment px-6 py-3 rounded-arb shadow-arb z-50 text-sm">
            ✓ {{ session('success') }}
        </div>
    @endif

        {{-- Floating Message Button --}}
    <div class="fixed bottom-6 right-6 z-40"
         x-data
         x-show="typeof currentNiche !== 'undefined'"
         style="display:block;">
        <button @click="$dispatch('open-message-modal', { niche: window.currentNiche || 'gardenofpam' })"
                style="background:#061B0E;
                       color:#FAF9F5;
                       border-radius:100px;
                       box-shadow: 0 8px 32px rgba(6,27,14,0.25);
                       font-size:13px;
                       font-weight:500;
                       letter-spacing:0.03em;
                       border:none;
                       cursor:pointer;"
                class="flex items-center gap-2 px-5 py-3 hover:opacity-90 transition-opacity">
            <span>🌱</span>
            <span>Plant a Message</span>
        </button>
    </div>

    @stack('scripts')
</body>
</html>