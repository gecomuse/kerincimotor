@extends('frontend.layouts.app')

@section('title', 'Kerinci Motor | Dealer Mobil Bekas Terpercaya Bekasi')
@section('description', 'Dealer mobil bekas terpercaya Sejabodetabek. Stok lengkap, harga transparan, 150+ poin inspeksi. Bebas banjir, laka, dan terbakar.')

@section('content')

@php
    $waNumber   = $globalSettings['wa_number']->value ?? '6287776700009';
    $tagline    = $globalSettings['hero_tagline']->value ?? 'Mobil Bekas Terpercaya, Harga Terbaik';
    $subtagline = $globalSettings['hero_subtagline']->value ?? 'Stok lengkap, harga transparan, inspeksi ketat 150+ poin.';
    $address    = $globalSettings['address']->value ?? 'Bekasi, Jawa Barat';
    $hours      = $globalSettings['operating_hours']->value ?? 'Setiap Hari 08:00–20:00 WIB';
    $mapsUrl    = $globalSettings['google_maps_url']->value ?? '#';
    $mapsEmbed  = $globalSettings['google_maps_embed']->value ?? '';
    $waHeroMsg  = urlencode('Halo Kerinci Motor, saya ingin mengetahui unit mobil bekas yang tersedia.');
    $waHeroUrl  = "https://wa.me/{$waNumber}?text={$waHeroMsg}";
    $totalCars  = $totalCars ?? 0;
@endphp

{{-- ═══════════════════════════ HERO ═══════════════════════════ --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-brand-black">

    {{-- BG --}}
    <div class="absolute inset-0 bg-gradient-to-br from-brand-black via-[#1a0000] to-brand-black"></div>
    <div class="absolute inset-0 opacity-10"
         style="background-image:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23CC0000\' fill-opacity=\'0.12\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
    </div>
    <div class="absolute top-1/2 right-0 -translate-y-1/2 w-[700px] h-[700px] rounded-full bg-brand-red/5 blur-3xl pointer-events-none"></div>

    @if($hero && $hero->image_url)
    {{-- Hero Car Image --}}
    <div class="absolute right-0 bottom-0 w-1/2 h-full pointer-events-none hidden lg:block">
        <img id="hero-main-img" src="{{ $hero->image_url }}" alt="{{ $hero->card_name }}"
             class="absolute bottom-0 right-0 h-[85%] w-auto object-contain object-bottom"
             style="filter: drop-shadow(0 0 60px rgba(204,0,0,0.2));">

        {{-- Car Info Card --}}
        <div class="absolute bottom-16 right-16 bg-brand-dark-gray/90 backdrop-blur border border-white/10 rounded-2xl px-6 py-4">
            <div id="hero-card-name"  class="font-heading font-bold text-brand-white text-lg">{{ $hero->card_name }}</div>
            <div id="hero-card-sub"   class="text-brand-text-gray text-sm mt-0.5">{{ $hero->card_sub }}</div>
            <div id="hero-card-price" class="font-heading font-extrabold text-brand-red text-2xl mt-2">
                Rp {{ $hero->card_price }}jt
            </div>
        </div>
    </div>
    @endif

    <div class="relative max-w-7xl mx-auto px-4 md:px-8 pt-32 pb-20 {{ $hero && $hero->image_url ? 'lg:max-w-3xl lg:ml-0 lg:mr-auto text-left' : 'text-center' }}">
        <p class="section-label mb-4">🏆 Showroom Mobil Bekas #1 Terpercaya di Bekasi</p>

        <h1 class="font-heading font-extrabold text-4xl md:text-6xl lg:text-7xl text-brand-white leading-tight mb-6">
            {{ $tagline }}
        </h1>

        <p class="text-brand-text-gray text-lg md:text-xl max-w-2xl mb-10">
            {{ $subtagline }}
        </p>

        <div class="flex flex-col sm:flex-row items-center {{ $hero && $hero->image_url ? '' : 'justify-center' }} gap-4">
            <a href="{{ $waHeroUrl }}" target="_blank" rel="noopener" class="btn-wa text-base px-8 py-4">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Hubungi via WhatsApp
            </a>
            <a href="{{ route('inventory.index') }}" class="btn-outline text-base px-8 py-4">
                Lihat Inventaris
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        {{-- Stats --}}
        <div class="mt-16 grid grid-cols-3 gap-4 max-w-sm">
            <div class="text-center">
                <div class="font-heading font-extrabold text-3xl text-brand-red">{{ $totalCars }}+</div>
                <div class="text-brand-text-gray text-xs mt-1">Unit Tersedia</div>
            </div>
            <div class="text-center border-x border-white/10">
                <div class="font-heading font-extrabold text-3xl text-brand-red">150+</div>
                <div class="text-brand-text-gray text-xs mt-1">Poin Inspeksi</div>
            </div>
            <div class="text-center">
                <div class="font-heading font-extrabold text-3xl text-brand-red">100%</div>
                <div class="text-brand-text-gray text-xs mt-1">Transparan</div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-brand-text-gray text-xs animate-bounce">
        <span>Scroll</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>

{{-- ════════════════════ FLASH SALE / FEATURED CARS ════════════════════ --}}
@if(isset($featuredCars) && $featuredCars->count())
<section id="featured-cars" class="py-20 bg-brand-black">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="flex items-end justify-between mb-10">
            <div>
                <p class="section-label">🔥 Hot Deals</p>
                <h2 class="section-title mb-0">Unit Pilihan Terbaik</h2>
            </div>
            <a href="{{ route('inventory.index') }}" class="btn-outline hidden md:inline-flex text-sm">
                Lihat Semua →
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($featuredCars as $car)
            <div class="car-card group cursor-pointer"
                 onclick="window.location='{{ route('car.detail', $car->slug) }}'">
                {{-- Thumb --}}
                <div class="relative aspect-[4/3] overflow-hidden bg-brand-dark-gray rounded-t-xl">
                    <img src="{{ $car->getFirstMediaUrl('car_images', 'thumb') ?: $car->getFirstMediaUrl('car_images') ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=800' }}"
                         alt="{{ $car->make_model }} {{ $car->year }}"
                         loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         onerror="this.src='https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=800'">

                    {{-- Badge --}}
                    @if($car->is_featured)
                    <span class="absolute top-3 left-3 bg-brand-red text-white text-xs font-heading font-bold px-2 py-1 rounded-full">
                        🔥 HOT DEAL
                    </span>
                    @endif

                    {{-- Availability --}}
                    <span class="absolute top-3 right-3 {{ $car->is_available ? 'badge-available' : 'badge-sold' }}">
                        {{ $car->is_available ? 'TERSEDIA' : 'TERJUAL' }}
                    </span>
                </div>

                {{-- Info --}}
                <div class="p-5">
                    <h3 class="font-heading font-bold text-brand-white text-sm leading-snug mb-1 group-hover:text-brand-red transition-colors line-clamp-2">
                        {{ $car->make_model }}
                    </h3>
                    <div class="text-brand-text-gray text-xs mb-3">
                        {{ $car->year }} · {{ strtoupper($car->transmission) }} · {{ $car->formatted_mileage }}
                    </div>
                    <div class="font-heading font-extrabold text-brand-white text-lg mb-4">
                        {{ $car->formatted_price }}
                    </div>
                    <a href="{{ route('car.detail', $car->slug) }}"
                       class="btn-primary w-full justify-center text-sm py-2.5"
                       onclick="event.stopPropagation()">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-20 text-brand-text-gray">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                Belum ada unit tersedia.
            </div>
            @endforelse
        </div>

        <div class="text-center mt-10 md:hidden">
            <a href="{{ route('inventory.index') }}" class="btn-primary">Lihat Semua Unit</a>
        </div>
    </div>
</section>
@endif

{{-- ══════════════════ KALKULATOR CICILAN ══════════════════ --}}
<section id="financing" class="py-20 bg-brand-dark-gray">
    <div class="max-w-3xl mx-auto px-4 md:px-8">
        <div class="text-center mb-10">
            <p class="section-label">Simulasi Kredit</p>
            <h2 class="section-title">Kalkulator Cicilan</h2>
            <p class="section-subtitle mx-auto">
                Estimasi cicilan bulanan sesuai harga dan DP yang Anda masukkan.
            </p>
            <div class="divider-red mx-auto mt-4"></div>
        </div>

        <div class="bg-brand-mid-gray border border-white/5 rounded-2xl p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div>
                    <label class="km-label">Harga Mobil (Rp)</label>
                    <input type="number" id="calc-price" oninput="calcKredit()"
                           placeholder="150000000" class="km-input">
                </div>
                <div>
                    <label class="km-label">Uang Muka / DP (Rp)</label>
                    <input type="number" id="calc-dp" oninput="calcKredit()"
                           placeholder="30000000" class="km-input">
                </div>
                <div>
                    <label class="km-label">Tenor</label>
                    <select id="calc-tenor" onchange="calcKredit()" class="km-select">
                        <option value="12">12 bulan</option>
                        <option value="24">24 bulan</option>
                        <option value="36">36 bulan</option>
                        <option value="48" selected>48 bulan</option>
                        <option value="60">60 bulan</option>
                        <option value="72">72 bulan</option>
                    </select>
                </div>
            </div>

            {{-- Result --}}
            <div class="bg-brand-dark-gray border border-white/5 rounded-xl p-6 text-center">
                <div class="text-brand-text-gray text-sm mb-2">Estimasi Cicilan per Bulan</div>
                <div id="calc-result" class="font-heading font-extrabold text-4xl text-brand-red">—</div>
                <div id="calc-breakdown" class="text-brand-text-gray text-xs mt-2">
                    Masukkan harga dan DP untuk melihat estimasi
                </div>
                <p class="text-brand-text-gray/50 text-xs mt-3">
                    * Sudah termasuk asuransi Rp 6.000.000. Angka final leasing bisa berbeda.
                </p>
            </div>

            <div class="text-center mt-6">
                <a href="{{ route('sell.index') }}" class="text-brand-text-gray hover:text-brand-red text-sm transition-colors">
                    Ingin menjual mobil Anda? →
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════ USP / WHY US ══════════════════ --}}
<section id="why-us" class="py-20 bg-brand-black">
    <div class="max-w-7xl mx-auto px-4 md:px-8 text-center">
        <p class="section-label">Komitmen Kami</p>
        <h2 class="section-title">Kenapa Pilih Kerinci Motor?</h2>
        <div class="divider-red mx-auto mb-12"></div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['icon' => '🔍', 'title' => 'Harga Transparan',  'desc' => 'Harga yang Anda lihat adalah harga final. Tidak ada biaya tersembunyi.'],
                ['icon' => '🔧', 'title' => 'Inspeksi 150+ Poin','desc' => 'Setiap unit melewati 150+ poin inspeksi untuk memastikan kondisi terbaik.'],
                ['icon' => '⚡', 'title' => 'Proses Cepat',      'desc' => 'Dokumen lengkap, STNK atas nama Anda, proses pembelian yang cepat.'],
                ['icon' => '📊', 'title' => 'Kilometer Jujur',   'desc' => 'Kilometer asli, tidak direkayasa. Didukung riwayat servis lengkap.'],
            ] as $usp)
            <div class="bg-brand-dark-gray border border-white/5 rounded-xl p-7 hover:border-brand-red/30 transition-all duration-300 hover:-translate-y-1 group text-left">
                <div class="text-4xl mb-4">{{ $usp['icon'] }}</div>
                <h3 class="font-heading font-bold text-lg text-brand-white mb-2 group-hover:text-brand-red transition-colors">
                    {{ $usp['title'] }}
                </h3>
                <p class="text-brand-text-gray text-sm leading-relaxed">{{ $usp['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════ TESTIMONIALS ══════════════════ --}}
@if(isset($testimonials) && $testimonials->count() >= 1)
<section id="testimonials" class="py-20 bg-brand-dark-gray">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="text-center mb-12">
            <p class="section-label">Kata Pelanggan</p>
            <h2 class="section-title">Ulasan Pelanggan Kami</h2>
            <div class="divider-red mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $testi)
            <div class="testi-card flex flex-col h-full">
                {{-- Stars --}}
                <div class="flex gap-1 text-yellow-400 mb-3">
                    @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= $testi->rating ? 'fill-current' : 'text-white/10 fill-current' }}" viewBox="0 0 24 24">
                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    @endfor
                </div>

                <p class="text-brand-text-gray text-sm leading-relaxed mb-5 italic flex-1">
                    "{{ $testi->content }}"
                </p>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-brand-red/20 flex items-center justify-center font-heading font-bold text-brand-red">
                        {{ strtoupper(substr($testi->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="font-heading font-semibold text-brand-white text-sm">{{ $testi->name }}</div>
                        @if($testi->location)
                        <div class="text-brand-text-gray text-xs">{{ $testi->location }}</div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
const FIXED_INSURANCE = 6000000;

function calcKredit() {
    const price = parseFloat(document.getElementById('calc-price').value) || 0;
    const dp    = parseFloat(document.getElementById('calc-dp').value) || 0;
    const tenor = parseInt(document.getElementById('calc-tenor').value) || 48;

    if (price > 0 && dp >= 0 && dp < price) {
        const principal  = price - dp + FIXED_INSURANCE;
        const totalBunga = principal * (0.11 * (tenor / 12));
        const cicilan    = (principal + totalBunga) / tenor + 200000;

        document.getElementById('calc-result').textContent =
            'Rp ' + Math.round(cicilan).toLocaleString('id-ID');
        document.getElementById('calc-breakdown').textContent =
            'Total bayar: Rp ' + Math.round(principal + totalBunga).toLocaleString('id-ID')
            + ' | ' + tenor + ' bulan';
    } else {
        document.getElementById('calc-result').textContent = '—';
        document.getElementById('calc-breakdown').textContent =
            'Masukkan harga dan DP untuk melihat estimasi';
    }
}
</script>
@endpush
