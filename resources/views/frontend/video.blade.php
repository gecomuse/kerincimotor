@extends('frontend.layouts.app')

@section('title', 'Video Review Unit — Kerinci Motor')
@section('description', 'Tonton video review lengkap unit mobil bekas di Kerinci Motor. Cek eksterior, interior, mesin, dan test drive — jujur tanpa filter.')

@section('content')

<section class="pt-32 pb-20 bg-brand-black min-h-screen">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        {{-- Header --}}
        <div class="text-center mb-14">
            <p class="section-label">VIDEO REVIEW</p>
            <h1 class="section-title">Lihat Kondisi Unit<br class="hidden md:block"> Sebelum ke Showroom</h1>
            <p class="section-subtitle mx-auto">
                Video jujur tanpa filter — cek eksterior, interior, mesin, dan test drive langsung.
            </p>
            <div class="divider-red mx-auto mt-6"></div>
        </div>

        {{-- Featured Video --}}
        @if(isset($featuredVideo) && $featuredVideo)
        <div class="mb-14 bg-brand-dark-gray border border-white/5 rounded-2xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                {{-- Video Embed --}}
                <div class="relative" style="aspect-ratio: 9/16; max-height: 600px;">
                    <iframe
                        src="{{ $featuredVideo->embed_url }}"
                        class="absolute inset-0 w-full h-full border-none"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        loading="lazy"
                        title="{{ $featuredVideo->title }}">
                    </iframe>
                </div>

                {{-- Info --}}
                <div class="p-8 lg:p-10 flex flex-col justify-center">
                    <span class="section-label mb-3">⭐ FEATURED</span>
                    <h2 class="font-heading font-extrabold text-2xl md:text-3xl text-brand-white leading-tight mb-4">
                        {{ $featuredVideo->title }}
                    </h2>
                    @if($featuredVideo->description)
                    <p class="text-brand-text-gray text-sm leading-relaxed mb-6">
                        {{ $featuredVideo->description }}
                    </p>
                    @endif
                    @if($featuredVideo->price_label)
                    <div class="font-heading font-extrabold text-3xl text-brand-white mb-6">
                        Rp {{ $featuredVideo->price_label }}jt
                    </div>
                    @endif
                    <a href="https://wa.me/{{ $globalSettings['wa_number']->value ?? '6287776700009' }}?text={{ urlencode('Halo, saya tertarik dengan unit di video: ' . $featuredVideo->title) }}"
                       target="_blank" rel="noopener"
                       class="btn-wa w-full justify-center">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Tanya Unit ini via WA
                    </a>
                </div>
            </div>
        </div>
        @endif

        {{-- Video Grid --}}
        @php
            $videoList = isset($videos) ? $videos : collect([]);
            $fallback = $videoList->isEmpty();
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">

            @forelse($videoList as $video)
            <div class="bg-brand-dark-gray border border-white/5 rounded-2xl overflow-hidden
                        hover:-translate-y-1 hover:shadow-red-glow transition-all duration-300 group">
                {{-- Embed --}}
                <div class="relative" style="aspect-ratio: 9/16;">
                    <iframe
                        src="{{ $video->embed_url }}"
                        class="absolute inset-0 w-full h-full border-none"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        loading="lazy"
                        title="{{ $video->title }}">
                    </iframe>
                </div>
                {{-- Info --}}
                <div class="p-4">
                    <h3 class="font-heading font-semibold text-brand-white text-sm leading-snug mb-1 group-hover:text-brand-red transition-colors">
                        {{ $video->title }}
                    </h3>
                    @if($video->price_label)
                    <span class="font-heading font-bold text-brand-red text-sm">Rp {{ $video->price_label }}jt</span>
                    @else
                    <span class="text-brand-text-gray text-xs">Kerinci Motor</span>
                    @endif
                </div>
            </div>
            @empty
            {{-- Fallback hardcoded videos --}}
            @foreach([['-A3QvyQ9sP8', 'Review Unit Honda Brio'], ['s9KAaHeKOu8', 'Review Unit Toyota Avanza']] as [$id, $title])
            <div class="bg-brand-dark-gray border border-white/5 rounded-2xl overflow-hidden hover:-translate-y-1 transition-all duration-300">
                <div class="relative" style="aspect-ratio: 9/16;">
                    <iframe src="https://www.youtube.com/embed/{{ $id }}"
                            class="absolute inset-0 w-full h-full border-none"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen loading="lazy" title="{{ $title }}">
                    </iframe>
                </div>
                <div class="p-4">
                    <h3 class="font-heading font-semibold text-brand-white text-sm leading-snug">{{ $title }}</h3>
                    <span class="text-brand-text-gray text-xs">Kerinci Motor</span>
                </div>
            </div>
            @endforeach

            {{-- Placeholder slot --}}
            <div class="bg-brand-dark-gray border border-white/5 rounded-2xl overflow-hidden opacity-50">
                <div class="flex items-center justify-center" style="aspect-ratio: 9/16; background:#0A0A0A;">
                    <div class="text-center">
                        <div class="w-14 h-14 bg-brand-red/10 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-brand-red" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                        <p class="text-brand-text-gray text-xs">Segera Hadir</p>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-heading font-semibold text-brand-text-gray text-sm">Video Berikutnya</h3>
                    <span class="text-brand-text-gray/50 text-xs">Segera hadir</span>
                </div>
            </div>
            @endforelse
        </div>

        {{-- Subscribe CTA --}}
        <div class="text-center">
            <a href="https://www.youtube.com/@kerincimotor" target="_blank" rel="noopener"
               class="btn-outline inline-flex items-center gap-2">
                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
                Subscribe YouTube Kerinci Motor →
            </a>
        </div>

    </div>
</section>

@endsection
