@extends('frontend.layouts.app')

@section('title', 'Inventaris Mobil Bekas — Kerinci Motor Bekasi')
@section('description', 'Temukan mobil bekas berkualitas di Kerinci Motor. Stok lengkap Honda, Toyota, Daihatsu, Suzuki. Harga transparan, km jujur, inspeksi ketat.')

@section('content')

@php
    $makes = $makes ?? [];
    $bodyTypes = $bodyTypes ?? [];
    $selectedMake = request('make', '');
    $selectedBody = request('body_type', '');
    $selectedTrans = request('transmission', '');
    $selectedMin = request('price_min', '');
    $selectedMax = request('price_max', '');
    $selectedYear = request('year', '');
    $sort = request('sort', 'featured');
@endphp

{{-- Page Hero --}}
<section class="pt-32 pb-12 bg-brand-black">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="flex items-end justify-between">
            <div>
                <p class="section-label">Inventaris Lengkap</p>
                <h1 class="section-title mb-0">Semua Unit Tersedia</h1>
                @isset($cars)
                <p class="text-brand-text-gray text-sm mt-2">
                    Menampilkan {{ $cars->total() ?? 0 }} kendaraan
                </p>
                @endisset
            </div>
            <a href="{{ route('whatsapp') }}" target="_blank" rel="noopener" class="hidden md:inline-flex btn-wa text-sm">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Tanya Stok via WA
            </a>
        </div>
    </div>
</section>

<section class="pb-20 bg-brand-black">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        {{-- Filter Bar --}}
        <form method="GET" action="{{ route('inventory.index') }}"
              class="bg-brand-dark-gray border border-white/5 rounded-xl p-5 mb-8 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">

            {{-- Merek --}}
            <div>
                <label class="km-label text-xs">Merek</label>
                <input type="text" name="make" value="{{ $selectedMake }}"
                       placeholder="Honda, Toyota..."
                       class="km-input text-sm py-2">
            </div>

            {{-- Transmisi --}}
            <div>
                <label class="km-label text-xs">Transmisi</label>
                <select name="transmission" class="km-select text-sm py-2">
                    <option value="">Semua</option>
                    <option value="automatic" {{ $selectedTrans === 'automatic' ? 'selected' : '' }}>Automatic</option>
                    <option value="manual"    {{ $selectedTrans === 'manual'    ? 'selected' : '' }}>Manual</option>
                </select>
            </div>

            {{-- Tahun --}}
            <div>
                <label class="km-label text-xs">Tahun</label>
                <input type="number" name="year" value="{{ $selectedYear }}"
                       placeholder="{{ date('Y') }}" min="2000" max="{{ date('Y') }}"
                       class="km-input text-sm py-2">
            </div>

            {{-- Harga Min --}}
            <div>
                <label class="km-label text-xs">Harga Min (jt)</label>
                <input type="number" name="price_min" value="{{ $selectedMin }}"
                       placeholder="50" class="km-input text-sm py-2">
            </div>

            {{-- Harga Max --}}
            <div>
                <label class="km-label text-xs">Harga Max (jt)</label>
                <input type="number" name="price_max" value="{{ $selectedMax }}"
                       placeholder="300" class="km-input text-sm py-2">
            </div>

            {{-- Submit --}}
            <div class="flex items-end gap-2">
                <button type="submit" class="btn-primary flex-1 justify-center py-2 text-sm">Cari</button>
                <a href="{{ route('inventory.index') }}" class="btn-outline py-2 px-3 text-sm">✕</a>
            </div>
        </form>

        {{-- Sort --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <span class="text-brand-text-gray text-sm">Urutkan:</span>
                <div class="flex gap-2">
                    @foreach(['featured' => 'Unggulan', 'newest' => 'Terbaru', 'price_asc' => 'Harga ↑', 'price_desc' => 'Harga ↓'] as $val => $label)
                    <a href="{{ request()->fullUrlWithQuery(['sort' => $val]) }}"
                       class="px-3 py-1 rounded-full text-xs font-heading font-semibold transition-colors
                              {{ $sort === $val ? 'bg-brand-red text-white' : 'bg-brand-dark-gray text-brand-text-gray hover:text-brand-white border border-white/5' }}">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Cars Grid --}}
        @isset($cars)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($cars as $car)
            <div class="car-card group cursor-pointer"
                 onclick="window.location='{{ route('car.detail', $car->slug) }}'">
                {{-- Thumb --}}
                <div class="relative aspect-[4/3] overflow-hidden bg-brand-dark-gray rounded-t-xl">
                    <img src="{{ $car->getFirstMediaUrl('car_images', 'thumb') ?: $car->getFirstMediaUrl('car_images') ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=800' }}"
                         alt="{{ $car->make_model }} {{ $car->year }}"
                         loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         onerror="this.src='https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=800'">

                    @if($car->is_featured)
                    <span class="absolute top-3 left-3 bg-brand-red text-white text-xs font-heading font-bold px-2 py-1 rounded-full">
                        🔥 HOT
                    </span>
                    @endif
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
            <div class="col-span-4 text-center py-24 text-brand-text-gray">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="font-heading font-bold text-xl text-brand-white mb-2">Unit Tidak Ditemukan</h3>
                <p class="text-sm mb-6">Coba ubah filter pencarian Anda.</p>
                <a href="{{ route('inventory.index') }}" class="btn-outline">Reset Filter</a>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($cars->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $cars->withQueryString()->links() }}
        </div>
        @endif

        @else
        {{-- Fallback when no $cars variable --}}
        <div class="text-center py-24 text-brand-text-gray">
            <div class="text-6xl mb-4">🚗</div>
            <p class="text-sm">Memuat inventaris...</p>
        </div>
        @endisset

    </div>
</section>

@endsection
