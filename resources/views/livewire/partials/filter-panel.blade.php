<div class="bg-brand-dark-gray border border-white/5 rounded-xl p-5 space-y-6 sticky top-24">
    <h3 class="font-heading font-bold text-brand-white text-base">Filter Kendaraan</h3>

    {{-- ── Availability ─────────────────────────────── --}}
    <div>
        <label class="km-label">Ketersediaan</label>
        <div class="flex gap-3">
            <button wire:click="$set('onlyAvailable', true)"
                    class="filter-chip flex-1 text-center {{ $onlyAvailable ? 'filter-chip-active' : '' }}">
                Tersedia
            </button>
            <button wire:click="$set('onlyAvailable', false)"
                    class="filter-chip flex-1 text-center {{ !$onlyAvailable ? 'filter-chip-active' : '' }}">
                Semua Unit
            </button>
        </div>
    </div>

    {{-- ── Brand / Model ────────────────────────────── --}}
    <div>
        <label class="km-label">Merek / Model</label>
        <div class="space-y-2">
            @foreach(['Toyota','Honda','Suzuki','Daihatsu','Mitsubishi','Nissan','Mazda','BMW','Mercedes-Benz','Hyundai','Kia','Ford'] as $brand)
            <label class="flex items-center gap-3 cursor-pointer group">
                <input type="checkbox"
                       wire:model.live="brands"
                       value="{{ $brand }}"
                       class="w-4 h-4 rounded border-white/20 bg-brand-mid-gray text-brand-red
                              focus:ring-brand-red/30 focus:ring-offset-0">
                <span class="text-sm text-brand-text-gray group-hover:text-white transition-colors">{{ $brand }}</span>
            </label>
            @endforeach
        </div>
    </div>

    {{-- ── Production Year ──────────────────────────── --}}
    <div>
        <label class="km-label">Tahun Produksi</label>
        <div class="grid grid-cols-2 gap-2">
            <select wire:model.live="yearMin" class="km-select text-sm">
                <option value="">Dari</option>
                @foreach($availableYears->sortDesc() as $y)
                <option value="{{ $y }}">{{ $y }}</option>
                @endforeach
            </select>
            <select wire:model.live="yearMax" class="km-select text-sm">
                <option value="">Sampai</option>
                @foreach($availableYears as $y)
                <option value="{{ $y }}">{{ $y }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- ── Price Range ──────────────────────────────── --}}
    <div>
        <label class="km-label">
            Harga
            <span class="text-brand-text-gray font-normal ml-2 text-xs">
                Rp {{ number_format($priceMin/1000000, 0) }}M – Rp {{ $priceMax >= 1000000000 ? '1B+' : number_format($priceMax/1000000, 0).'M' }}
            </span>
        </label>
        <div class="space-y-2">
            <input type="range"
                   x-bind:value="$wire.priceMin"
                   x-on:input.debounce.300ms="$wire.set('priceMin', Number($event.target.value))"
                   min="0" max="1000000000" step="5000000"
                   class="w-full accent-brand-red">
            <input type="range"
                   x-bind:value="$wire.priceMax"
                   x-on:input.debounce.300ms="$wire.set('priceMax', Number($event.target.value))"
                   min="0" max="1000000000" step="5000000"
                   class="w-full accent-brand-red">
        </div>
        <div class="flex justify-between text-xs text-brand-text-gray mt-1">
            <span>Rp 0</span><span>Rp 1B+</span>
        </div>
    </div>

    {{-- ── Mileage ──────────────────────────────────── --}}
    <div>
        <label class="km-label">
            Maks. Kilometer
            <span class="text-brand-text-gray font-normal ml-2 text-xs">
                {{ $mileageMax >= 300000 ? 'Semua' : number_format($mileageMax, 0, ',', '.') . ' KM' }}
            </span>
        </label>
        <input type="range"
               x-bind:value="$wire.mileageMax"
               x-on:input.debounce.300ms="$wire.set('mileageMax', Number($event.target.value))"
               min="0" max="300000" step="5000"
               class="w-full accent-brand-red">
        <div class="flex justify-between text-xs text-brand-text-gray mt-1">
            <span>0 KM</span><span>300K+ KM</span>
        </div>
    </div>

    {{-- ── Transmission ─────────────────────────────── --}}
    <div>
        <label class="km-label">Transmisi</label>
        <div class="flex gap-2">
            <button wire:click="$set('transmission', '')"
                    class="filter-chip flex-1 text-center {{ $transmission === '' ? 'filter-chip-active' : '' }}">
                Semua
            </button>
            <button wire:click="$set('transmission', 'manual')"
                    class="filter-chip flex-1 text-center {{ $transmission === 'manual' ? 'filter-chip-active' : '' }}">
                Manual
            </button>
            <button wire:click="$set('transmission', 'automatic')"
                    class="filter-chip flex-1 text-center {{ $transmission === 'automatic' ? 'filter-chip-active' : '' }}">
                Otomatis
            </button>
        </div>
    </div>

    {{-- ── Vehicle Type ─────────────────────────────── --}}
    <div>
        <label class="km-label">Tipe Kendaraan</label>
        <div class="flex flex-wrap gap-2">
            @foreach(['sedan' => 'Sedan','suv' => 'SUV','mpv' => 'MPV','city_car' => 'City Car','hatchback' => 'Hatchback','pickup' => 'Pickup','minibus' => 'Minibus'] as $val => $label)
            <button wire:click="
                    @if(in_array('{{ $val }}', $bodyTypes))
                        $set('bodyTypes', array_values(array_diff($bodyTypes, ['{{ $val }}'])))
                    @else
                        $set('bodyTypes', array_merge($bodyTypes, ['{{ $val }}']))
                    @endif
                    "
                    class="filter-chip text-xs {{ in_array($val, $bodyTypes) ? 'filter-chip-active' : '' }}">
                {{ $label }}
            </button>
            @endforeach
        </div>
    </div>

    {{-- ── Fuel Type ────────────────────────────────── --}}
    <div>
        <label class="km-label">Bahan Bakar</label>
        <div class="space-y-2">
            @foreach(['petrol' => 'Bensin','diesel' => 'Solar','hybrid' => 'Hybrid','electric' => 'Listrik'] as $val => $label)
            <label class="flex items-center gap-3 cursor-pointer group">
                <input type="checkbox"
                       wire:model.live="fuelTypes"
                       value="{{ $val }}"
                       class="w-4 h-4 rounded border-white/20 bg-brand-mid-gray text-brand-red
                              focus:ring-brand-red/30 focus:ring-offset-0">
                <span class="text-sm text-brand-text-gray group-hover:text-white transition-colors">{{ $label }}</span>
            </label>
            @endforeach
        </div>
    </div>

    {{-- ── Color ────────────────────────────────────── --}}
    @if($allColors->count())
    <div>
        <label class="km-label">Warna</label>
        <div class="flex flex-wrap gap-2">
            @foreach($allColors as $color)
            <button wire:click="
                    @if(in_array('{{ $color }}', $colors))
                        $set('colors', array_values(array_diff($colors, ['{{ $color }}'])))
                    @else
                        $set('colors', array_merge($colors, ['{{ $color }}']))
                    @endif
                    "
                    class="filter-chip text-xs {{ in_array($color, $colors) ? 'filter-chip-active' : '' }}">
                {{ $color }}
            </button>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ── Reset Button ─────────────────────────────── --}}
    <button wire:click="resetFilters"
            class="w-full py-3 rounded-lg border border-brand-red/40 text-brand-red
                   font-heading font-semibold text-sm hover:bg-brand-red/10 transition-colors">
        Reset Semua Filter
    </button>
</div>
