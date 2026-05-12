@extends('frontend.layouts.app')

@section('title', 'Tips & Trick Beli Mobil Bekas — Kerinci Motor')
@section('description', 'Tips dan panduan beli mobil bekas dari praktisi Kerinci Motor. Cara cek kondisi mesin, bodi, dokumen, dan negosiasi harga terbaik.')

@section('content')

<section class="pt-32 pb-20 bg-brand-black min-h-screen">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        {{-- Header --}}
        <div class="text-center mb-14">
            <p class="section-label">TIPS &amp; PANDUAN</p>
            <h1 class="section-title">Tips &amp; Trick Beli Mobil Bekas</h1>
            <p class="section-subtitle mx-auto">
                Panduan lengkap dari praktisi — agar Anda tidak salah pilih.
            </p>
            <div class="divider-red mx-auto mt-6"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- ── Main Content ─────────────── --}}
            <div class="lg:col-span-2">

                {{-- Featured Post --}}
                @if(isset($featuredPost) && $featuredPost)
                <a href="{{ route('artikel.show', $featuredPost->slug) }}"
                   class="group block bg-brand-dark-gray border border-white/5 rounded-2xl overflow-hidden
                          hover:border-brand-red/30 transition-all duration-300 mb-10">
                    {{-- Image --}}
                    <div class="aspect-video overflow-hidden bg-brand-mid-gray">
                        @php
                            $featImg = $featuredPost->getFirstMediaUrl('cover')
                                    ?: ($featuredPost->featured_image ?? null)
                                    ?: ($featuredPost->thumbnail_url ?? null);
                        @endphp
                        @if($featImg)
                        <img src="{{ $featImg }}" alt="{{ $featuredPost->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                        <div class="flex items-center justify-center h-full text-6xl">📰</div>
                        @endif
                    </div>
                    {{-- Body --}}
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="bg-brand-red text-white text-xs font-heading font-bold uppercase tracking-wider px-3 py-1 rounded-full">
                                ⭐ ARTIKEL UTAMA
                            </span>
                            @if($featuredPost->category)
                            <span class="text-brand-text-gray text-xs">{{ $featuredPost->category }}</span>
                            @endif
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl text-brand-white mb-3 group-hover:text-brand-red transition-colors leading-snug">
                            {{ $featuredPost->title }}
                        </h2>
                        <p class="text-brand-text-gray text-sm leading-relaxed mb-4">
                            {{ Str::limit($featuredPost->excerpt, 180) }}
                        </p>
                        <div class="flex items-center gap-4 text-xs text-brand-text-gray">
                            <span>{{ $featuredPost->published_at?->locale('id')->isoFormat('D MMM YYYY') }}</span>
                            <span>·</span>
                            <span>{{ $featuredPost->read_time ?? 5 }} mnt baca</span>
                        </div>
                    </div>
                </a>
                @endif

                {{-- Posts Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($posts ?? [] as $post)
                    <a href="{{ route('artikel.show', $post->slug) }}"
                       class="group block bg-brand-dark-gray border border-white/5 rounded-2xl overflow-hidden
                              hover:border-brand-red/30 transition-all duration-300 hover:-translate-y-1">
                        {{-- Image --}}
                        <div class="aspect-video overflow-hidden bg-brand-mid-gray">
                            @php
                                $postImg = $post->getFirstMediaUrl('cover')
                                         ?: ($post->featured_image ?? null)
                                         ?: ($post->thumbnail_url ?? null);
                            @endphp
                            @if($postImg)
                            <img src="{{ $postImg }}" alt="{{ $post->title }}"
                                 loading="lazy"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                            <div class="flex items-center justify-center h-full text-4xl bg-brand-black">📰</div>
                            @endif
                        </div>
                        {{-- Body --}}
                        <div class="p-5">
                            @if($post->category)
                            <span class="inline-block bg-brand-red/15 text-brand-red text-xs font-heading font-bold uppercase tracking-wider px-3 py-1 rounded-full mb-3">
                                {{ $post->category }}
                            </span>
                            @endif
                            <h3 class="font-heading font-bold text-brand-white text-sm leading-snug mb-2 group-hover:text-brand-red transition-colors line-clamp-2">
                                {{ $post->title }}
                            </h3>
                            <p class="text-brand-text-gray text-xs leading-relaxed mb-3 line-clamp-3">
                                {{ Str::limit($post->excerpt, 100) }}
                            </p>
                            <div class="flex items-center justify-between text-xs text-brand-text-gray">
                                <span>{{ $post->published_at?->locale('id')->isoFormat('D MMM YYYY') }}</span>
                                <span>{{ $post->read_time ?? 5 }} mnt</span>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-2 text-center py-20 text-brand-text-gray">
                        <div class="text-5xl mb-4">📝</div>
                        <p class="text-sm">Belum ada artikel tersedia.</p>
                    </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @isset($posts)
                @if(method_exists($posts, 'hasPages') && $posts->hasPages())
                <div class="mt-10 flex justify-center">
                    {{ $posts->withQueryString()->links() }}
                </div>
                @endif
                @endisset

            </div>

            {{-- ── Sidebar ─────────────────── --}}
            <div class="lg:col-span-1 space-y-6">

                {{-- Hot Stock --}}
                @if(isset($hotStock) && $hotStock->count())
                <div class="bg-brand-dark-gray border border-white/5 rounded-2xl p-6">
                    <h3 class="font-heading font-bold text-brand-white mb-5 flex items-center gap-2">
                        🔥 Hot Stock Sekarang
                    </h3>
                    <div class="flex flex-col gap-4">
                        @foreach($hotStock as $car)
                        <a href="{{ route('car.detail', $car->slug) }}"
                           class="group flex gap-3 hover:bg-brand-mid-gray rounded-xl p-2 -m-2 transition-colors">
                            <div class="w-20 h-16 rounded-lg overflow-hidden flex-shrink-0 bg-brand-black">
                                <img src="{{ $car->getFirstMediaUrl('car_images', 'thumb') ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=400' }}"
                                     alt="{{ $car->make_model }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="font-heading font-semibold text-brand-white text-xs leading-snug group-hover:text-brand-red transition-colors line-clamp-2">
                                    {{ $car->make_model }}
                                </div>
                                <div class="text-brand-text-gray text-xs mt-0.5">{{ $car->year }} · {{ $car->formatted_mileage }}</div>
                                <div class="font-heading font-bold text-brand-red text-sm mt-1">{{ $car->formatted_price }}</div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <a href="{{ route('inventory.index') }}" class="btn-outline w-full justify-center text-sm mt-5">
                        Lihat Semua Unit →
                    </a>
                </div>
                @else
                {{-- Fallback CTA --}}
                <div class="bg-brand-dark-gray border border-white/5 rounded-2xl p-6 text-center">
                    <div class="text-4xl mb-3">🚗</div>
                    <h3 class="font-heading font-bold text-brand-white mb-2">Cari Mobil Bekas?</h3>
                    <p class="text-brand-text-gray text-sm mb-5">Lihat inventaris lengkap kami dengan harga terbaik.</p>
                    <a href="{{ route('inventory.index') }}" class="btn-primary w-full justify-center text-sm">
                        Lihat Inventaris
                    </a>
                </div>
                @endif

                {{-- Sell CTA --}}
                <div class="bg-gradient-to-br from-brand-red/20 to-brand-red/5 border border-brand-red/20 rounded-2xl p-6 text-center">
                    <div class="text-4xl mb-3">💰</div>
                    <h3 class="font-heading font-bold text-brand-white mb-2">Jual Mobil Anda</h3>
                    <p class="text-brand-text-gray text-sm mb-5">Proses cepat, harga terbaik, pembayaran langsung.</p>
                    <a href="{{ route('sell.index') }}" class="btn-wa w-full justify-center text-sm">
                        Jual Sekarang →
                    </a>
                </div>

                {{-- WA Contact --}}
                <div class="bg-brand-dark-gray border border-white/5 rounded-2xl p-6 text-center">
                    <h3 class="font-heading font-bold text-brand-white mb-2">Ada Pertanyaan?</h3>
                    <p class="text-brand-text-gray text-sm mb-4">Tim kami siap membantu Anda memilih unit terbaik.</p>
                    <a href="{{ route('whatsapp') }}" target="_blank" rel="noopener"
                       class="btn-wa w-full justify-center text-sm">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Chat via WhatsApp
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
