@php
    $waNumber = $globalSettings['wa_number']->value ?? '6287776700009';
    $waMsg    = urlencode("Halo Kerinci Motor, saya tertarik dengan {$car->make_model} Tahun {$car->year} — {$car->formatted_price}. Apakah masih tersedia?");
    $waUrl    = "https://wa.me/{$waNumber}?text={$waMsg}";
    $thumb    = $car->getFirstMediaUrl('car_images', 'thumb');
    $fallback = 'https://placehold.co/400x300/1A1A1A/AAAAAA?text=' . urlencode($car->make_model);
@endphp
<div class="car-card flex flex-col">
    {{-- Image --}}
    <a href="{{ route('catalog.show', $car->slug) }}" class="block relative overflow-hidden aspect-video bg-brand-mid-gray">
        <img src="{{ $thumb ?: $fallback }}"
             alt="{{ $car->make_model }} {{ $car->year }} {{ $car->color }} — Kerinci Motor"
             loading="lazy"
             class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">

        {{-- Status badge --}}
        @if($car->is_available)
        <span class="car-card-badge badge-available">TERSEDIA</span>
        @else
        <span class="car-card-badge badge-sold">TERJUAL</span>
        <div class="absolute inset-0 bg-brand-black/60 flex items-center justify-center">
            <span class="font-heading font-extrabold text-3xl text-brand-red/60 rotate-[-20deg] border-4 border-brand-red/60 px-4 py-1 rounded">TERJUAL</span>
        </div>
        @endif

        {{-- Featured badge --}}
        @if($car->is_featured)
        <span class="absolute top-3 right-3 bg-yellow-500/90 text-brand-black text-xs font-heading font-bold px-2 py-1 rounded">★ Unggulan</span>
        @endif
    </a>

    {{-- Content --}}
    <div class="p-5 flex flex-col flex-1">
        <div class="flex items-start justify-between gap-2 mb-2">
            <a href="{{ route('catalog.show', $car->slug) }}">
                <h3 class="font-heading font-bold text-brand-white hover:text-brand-red transition-colors leading-tight">
                    {{ $car->make_model }}
                </h3>
            </a>
        </div>

        {{-- Specs chips --}}
        <div class="flex flex-wrap gap-2 mb-4">
            <span class="filter-chip text-xs">{{ $car->year }}</span>
            <span class="filter-chip text-xs">{{ ucfirst($car->transmission) }}</span>
            <span class="filter-chip text-xs">{{ $car->formatted_mileage }}</span>
            <span class="filter-chip text-xs">{{ ucfirst(str_replace('_', ' ', $car->body_type)) }}</span>
        </div>

        {{-- Price --}}
        <div class="mt-auto">
            <div class="font-heading font-extrabold text-xl text-brand-white mb-3">
                {{ $car->formatted_price }}
            </div>

            @if($car->is_available)
            <a href="{{ $waUrl }}"
               target="_blank" rel="noopener"
               onclick="trackWA('catalog', '{{ addslashes($car->make_model) }}', {{ $car->price }})"
               class="btn-wa w-full justify-center text-sm">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Tanya via WhatsApp
            </a>
            @else
            <button disabled class="w-full py-3 rounded-lg bg-brand-mid-gray text-brand-text-gray font-heading font-semibold text-sm cursor-not-allowed">
                Unit Tidak Tersedia
            </button>
            @endif
        </div>
    </div>
</div>
