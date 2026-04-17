@extends('layouts.app')

@section('title', 'Message Verified — Paul Albert Mina')

@section('content')

<section style="background:#FAF9F5; min-height:100vh;"
         class="flex items-center justify-center px-6">

    <div style="background:#F5F0E8;
                border:1px solid rgba(6,27,14,0.08);
                border-radius:16px;
                max-width:480px;
                width:100%;"
         class="p-12 text-center shadow-arb">

        {{-- Icon --}}
        <div style="width:64px; height:64px;
                    background:rgba(74,124,89,0.10);
                    border:1px solid rgba(74,124,89,0.20);
                    border-radius:50%;
                    margin:0 auto 24px;"
             class="flex items-center justify-center">
            <svg style="width:28px; height:28px; color:#4A7C59;"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="1.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        {{-- Label --}}
        <p class="section-label mb-3">Verification Complete</p>

        {{-- Heading --}}
        <h1 class="font-serif text-3xl font-bold mb-4"
            style="color:#061B0E;">
            Message Sent.
        </h1>

        {{-- Body --}}
        <p class="text-sm leading-relaxed mb-8"
           style="color:rgba(6,27,14,0.55);">
            Thank you for reaching out. Your message has been verified
            and delivered successfully. Paul will get back to you soon.
        </p>

        {{-- Divider --}}
        <div style="width:40px; height:1px;
                    background:rgba(6,27,14,0.12);
                    margin:0 auto 28px;">
        </div>

        {{-- Back Button --}}
        <a href="{{ route($niche . '.index') }}"
           style="background:#061B0E;
                  color:#FAF9F5;
                  border-radius:10px;
                  font-size:13px;
                  font-weight:500;
                  letter-spacing:0.04em;"
           class="inline-block px-6 py-3 hover:opacity-90 transition-opacity">
            ← Go Back
        </a>

    </div>

</section>

@endsection