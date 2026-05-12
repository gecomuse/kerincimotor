@extends('frontend.layouts.app')

@section('title', $car->make_model . ' ' . $car->year . ' Bekas | Kerinci Motor')
@section('description', 'Beli ' . $car->make_model . ' tahun ' . $car->year . ', ' . $car->formatted_mileage . ', transmisi ' . $car->transmission . '. Harga ' . $car->formatted_price . '. Hubungi Kerinci Motor via WhatsApp.')
@section('og_image', $car->getFirstMediaUrl('car_images', 'medium') ?: $car->getFirstMediaUrl('car_images'))

@section('content')

@php
    $waNumber = $globalSettings['wa_number']->value ?? '6287776700009';
    $photos   = $car->getMedia('car_images');

    $pdpMsg = "Halo Kerinci Motor, saya tertarik dengan:\n\n"
            . "🚗 *{$car->make_model}*\n"
            . "📅 Tahun: {$car->year}\n"
            . "💰 Harga: {$car->formatted_price}\n"
            . "🛣️ Kilometer: {$car->formatted_mileage}\n"
            . "⚙️ Transmisi: " . ucfirst($car->transmission) . "\n"
            . "🎨 Warna: {$car->color}\n\n"
            . "Apakah unit ini masih tersedia? Terima kasih!";
    $waUrl = "https://wa.me/{$waNumber}?text=" . urlencode($pdpMsg);

    // Cicilan estimate (48 bulan, bunga 11%/tahun, insurance sudah include)
    $FIXED_INSURANCE = 6000000;
    $dp = $car->price * 0.30;
    $principal = ($car->price - $dp) + $FIXED_INSURANCE;
    $tenor = 48;
    $totalBunga = $principal * (0.11 * ($tenor / 12));
    $cicilanPerBulan = isset($cicilanPerBulan) ? $cicilanPerBulan : (($principal + $totalBunga) / $tenor + 200000);
@endphp

{{-- Sticky CTA Bar --}}
<div id="sticky-cta"
     class="fixed bottom-0 left-0 right-0 z-30 bg-brand-dark-gray/95 backdrop-blur-md
            border-t border-white/10 py-3 px-4 translate-y-full opacity-0 transition-all duration-300">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
        <div class="hidden sm:block">
            <div class="font-heading font-bold text-brand-white">{{ $car->make_model }} {{ $car->year }}</div>
            <div class="text-brand-red font-heading font-bold text-lg">{{ $car->formatted_price }}</div>
        </div>
        <a href="{{ $waUrl }}" target="_blank" rel="noopener"
           class="btn-wa ml-auto">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            Tanya Harga
        </a>
    </div>
</div>

<div class="pt-28 pb-24 bg-brand-black">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-brand-text-gray mb-8 flex-wrap">
            <a href="{{ route('home') }}"          class="hover:text-brand-red transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('inventory.index') }}" class="hover:text-brand-red transition-colors">Inventaris</a>
            <span>/</span>
            <span class="text-brand-white">{{ $car->make_model }} {{ $car->year }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">

            {{-- ── Gallery ─────────────────── --}}
            <div class="lg:col-span-3">
                @if($photos->count())

                {{-- Main image --}}
                <div id="det-img-wrapper"
                     class="rounded-2xl overflow-hidden bg-brand-dark-gray border border-white/5 mb-3 aspect-video">
                    <img id="det-img"
                         src="{{ $photos->first()->hasGeneratedConversion('medium') ? $photos->first()->getUrl('medium') : $photos->first()->getUrl() }}"
                         alt="{{ $car->make_model }} {{ $car->year }}"
                         class="w-full h-full object-cover">
                </div>

                {{-- Thumbnails --}}
                @if($photos->count() > 1)
                <div class="grid grid-cols-5 gap-2">
                    @foreach($photos as $i => $photo)
                    <button onclick="document.getElementById('det-img').src='{{ $photo->hasGeneratedConversion('large') ? $photo->getUrl('large') : $photo->getUrl() }}';
                                     document.querySelectorAll('.det-thumb').forEach(t=>t.classList.remove('border-brand-red'));
                                     this.querySelector('img').closest('button').classList.add('border-brand-red');"
                            class="det-thumb rounded-lg overflow-hidden border-2 {{ $i === 0 ? 'border-brand-red' : 'border-transparent' }} hover:border-brand-red transition-colors">
                        <img src="{{ $photo->hasGeneratedConversion('thumb') ? $photo->getUrl('thumb') : $photo->getUrl() }}"
                             alt="Foto {{ $i+1 }}"
                             class="w-full aspect-video object-cover">
                    </button>
                    @endforeach
                </div>
                @endif

                @else
                <div class="rounded-2xl bg-brand-dark-gray border border-white/5 aspect-video flex items-center justify-center">
                    <div class="text-center text-brand-text-gray">
                        <svg class="w-16 h-16 mx-auto mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm">Foto tidak tersedia</p>
                    </div>
                </div>
                @endif
            </div>

            {{-- ── Details ──────────────────────────── --}}
            <div class="lg:col-span-2 flex flex-col gap-5">

                {{-- Status badges --}}
                <div class="flex items-center gap-3">
                    <span class="{{ $car->is_available ? 'badge-available' : 'badge-sold' }}">
                        {{ $car->is_available ? 'TERSEDIA' : 'TERJUAL' }}
                    </span>
                    @if($car->is_featured)
                    <span class="bg-yellow-500/20 text-yellow-400 border border-yellow-500/30 rounded-full px-3 py-1 text-xs font-heading font-bold">
                        ★ Unggulan
                    </span>
                    @endif
                </div>

                {{-- Title --}}
                <div>
                    <h1 class="font-heading font-extrabold text-2xl md:text-3xl text-brand-white leading-tight">
                        {{ $car->make_model }}
                    </h1>
                    <p class="text-brand-text-gray text-sm mt-1">
                        {{ $car->year }} · {{ ucfirst(str_replace('_', ' ', $car->body_type)) }}
                    </p>
                </div>

                {{-- Price --}}
                <div class="bg-brand-dark-gray border border-white/5 rounded-xl p-5">
                    <div class="text-brand-text-gray text-sm mb-1">Harga</div>
                    <div class="font-heading font-extrabold text-3xl text-brand-white">{{ $car->formatted_price }}</div>
                    @if($car->tax_status)
                    <div class="text-xs text-green-400 mt-1">✓ Pajak {{ $car->tax_status }}</div>
                    @endif
                </div>

                {{-- Cicilan estimate --}}
                <div class="bg-brand-red/10 border border-brand-red/20 rounded-xl p-4 text-center">
                    <div class="text-brand-text-gray text-xs mb-1">Estimasi Cicilan 48 Bulan</div>
                    <div class="font-heading font-extrabold text-xl text-brand-red">
                        Rp {{ number_format($cicilanPerBulan, 0, ',', '.') }}/bln
                    </div>
                    <div class="text-brand-text-gray/60 text-xs mt-1">DP 30% · Sudah termasuk asuransi</div>
                </div>

                {{-- Specs --}}
                <div class="bg-brand-dark-gray border border-white/5 rounded-xl p-5">
                    <h3 class="font-heading font-bold text-brand-silver text-xs uppercase tracking-wider mb-4">Spesifikasi</h3>
                    <div class="grid grid-cols-2 gap-y-3 gap-x-4 text-sm">
                        @foreach([
                            ['Kilometer',   $car->formatted_mileage],
                            ['Transmisi',   ucfirst($car->transmission)],
                            ['Bahan Bakar', ucfirst($car->fuel_type)],
                            ['Warna',       $car->color],
                            ['Tipe Bodi',   ucfirst(str_replace('_',' ',$car->body_type))],
                            ['Tahun',       $car->year],
                        ] as [$label, $value])
                        <div>
                            <div class="text-brand-text-gray text-xs mb-0.5">{{ $label }}</div>
                            <div class="text-brand-white font-semibold">{{ $value }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- CTA --}}
                @if($car->is_available)
                <a href="{{ $waUrl }}" target="_blank" rel="noopener"
                   class="btn-wa w-full justify-center text-base py-4">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    💬 Tanya via WhatsApp
                </a>
                @endif

                <a href="{{ route('inventory.index') }}" class="btn-outline w-full justify-center text-sm">
                    ← Kembali ke Inventaris
                </a>
            </div>
        </div>

        {{-- Description / Condition Notes --}}
        @if($car->description || $car->condition_notes)
        <div class="mt-14 grid grid-cols-1 lg:grid-cols-2 gap-8">
            @if($car->description)
            <div class="bg-brand-dark-gray border border-white/5 rounded-2xl p-7">
                <h2 class="font-heading font-bold text-xl text-brand-white mb-5">Deskripsi Kendaraan</h2>
                <div class="prose prose-invert prose-sm max-w-none text-brand-text-gray leading-relaxed">
                    {!! $car->description !!}
                </div>
            </div>
            @endif
            @if($car->condition_notes)
            <div class="bg-brand-dark-gray border border-white/5 rounded-2xl p-7">
                <h2 class="font-heading font-bold text-xl text-brand-white mb-5">Catatan Kondisi</h2>
                <p class="text-brand-text-gray text-sm leading-relaxed">{{ $car->condition_notes }}</p>
            </div>
            @endif
        </div>
        @endif

        {{-- Related Cars --}}
        @if(isset($relatedCars) && $relatedCars->count())
        <div class="mt-16">
            <h2 class="font-heading font-bold text-2xl text-brand-white mb-6">Kendaraan Serupa</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedCars as $related)
                <div class="car-card group cursor-pointer"
                     onclick="window.location='{{ route('car.detail', $related->slug) }}'">
                    <div class="relative aspect-[4/3] overflow-hidden bg-brand-dark-gray rounded-t-xl">
                        <img src="{{ $related->getFirstMediaUrl('car_images', 'thumb') ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=800' }}"
                             alt="{{ $related->make_model }}"
                             loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-4">
                        <h3 class="font-heading font-bold text-brand-white text-sm mb-1 group-hover:text-brand-red transition-colors line-clamp-1">
                            {{ $related->make_model }}
                        </h3>
                        <div class="text-brand-text-gray text-xs mb-2">{{ $related->year }} · {{ $related->formatted_mileage }}</div>
                        <div class="font-heading font-bold text-brand-white">{{ $related->formatted_price }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

@endsection

@push('scripts')
<script>
    // Sticky CTA trigger
    const stickyCta = document.getElementById('sticky-cta');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            stickyCta.classList.remove('translate-y-full', 'opacity-0');
        } else {
            stickyCta.classList.add('translate-y-full', 'opacity-0');
        }
    });

    // Meta Pixel
    if (typeof fbq !== 'undefined') {
        fbq('track', 'ViewContent', {
            content_name: '{{ addslashes($car->make_model) }} {{ $car->year }}',
            content_type: 'vehicle',
            content_ids: ['{{ $car->id }}'],
            @if($car->price)
            value: {{ $car->price }},
            currency: 'IDR',
            @endif
        });
    }

    // GA4
    if (typeof gtag !== 'undefined') {
        gtag('event', 'pdp_view', {
            car_slug: '{{ $car->slug }}',
            car_price: {{ $car->price }}
        });
    }
</script>
@endpush
