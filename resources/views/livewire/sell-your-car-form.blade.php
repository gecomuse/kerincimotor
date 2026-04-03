<div
    x-data
    @redirect-to-wa.window="setTimeout(() => window.location.href = $event.detail[0].url, 800)"
    class="bg-brand-dark-gray border border-white/5 rounded-2xl p-6 md:p-10">

    {{-- Step Indicator --}}
    <div class="flex items-center justify-center gap-0 mb-10">
        @foreach([1 => 'Info Pribadi', 2 => 'Info Kendaraan', 3 => 'Detail Penawaran'] as $num => $label)
        <div class="flex items-center {{ $num < 3 ? 'flex-1' : '' }}">
            <div class="flex flex-col items-center gap-1.5">
                <div class="step-dot
                    {{ $step == $num ? 'step-dot-active' : ($step > $num ? 'step-dot-done' : 'step-dot-pending') }}">
                    @if($step > $num)
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    @else
                    {{ $num }}
                    @endif
                </div>
                <span class="text-xs text-brand-text-gray hidden sm:block whitespace-nowrap">{{ $label }}</span>
            </div>
            @if($num < 3)
            <div class="flex-1 h-px mx-3 {{ $step > $num ? 'bg-brand-red' : 'bg-white/10' }} transition-colors duration-500"></div>
            @endif
        </div>
        @endforeach
    </div>

    {{-- Success State --}}
    @if($submitted)
    <div class="text-center py-10">
        <div class="w-16 h-16 rounded-full bg-brand-wa-green/20 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-brand-wa-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h3 class="font-heading font-bold text-xl text-brand-white mb-2">Permintaan Diterima!</h3>
        <p class="text-brand-text-gray text-sm">Mengalihkan Anda ke WhatsApp untuk melanjutkan percakapan...</p>
    </div>

    {{-- STEP 1: Personal Info --}}
    @elseif($step === 1)
    <div>
        <h3 class="font-heading font-bold text-xl text-brand-white mb-6">Langkah 1 — Informasi Pribadi</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="km-label">Nama Lengkap <span class="text-brand-red">*</span></label>
                <input type="text" wire:model="name"
                       placeholder="contoh: Budi Santoso"
                       class="km-input @error('name') border-brand-red/60 @enderror">
                @error('name')<p class="text-brand-red text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="km-label">Nomor WhatsApp <span class="text-brand-red">*</span></label>
                <input type="tel" wire:model="phone"
                       placeholder="+62 812 3456 7890"
                       class="km-input @error('phone') border-brand-red/60 @enderror">
                @error('phone')<p class="text-brand-red text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex justify-end mt-8">
            <button wire:click="nextStep" class="btn-primary">
                Lanjut: Info Kendaraan
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- STEP 2: Vehicle Info --}}
    @elseif($step === 2)
    <div>
        <h3 class="font-heading font-bold text-xl text-brand-white mb-6">Langkah 2 — Informasi Kendaraan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="km-label">Merek <span class="text-brand-red">*</span></label>
                <select wire:model="car_make"
                        class="km-select @error('car_make') border-brand-red/60 @enderror">
                    <option value="">Pilih merek...</option>
                    @foreach(['Toyota','Honda','Suzuki','Daihatsu','Mitsubishi','Nissan','Mazda','BMW','Mercedes-Benz','Hyundai','Kia','Ford','Isuzu','Wuling','DFSK','Other'] as $b)
                    <option value="{{ $b }}">{{ $b }}</option>
                    @endforeach
                </select>
                @error('car_make')<p class="text-brand-red text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="km-label">Model / Tipe <span class="text-brand-red">*</span></label>
                <input type="text" wire:model="car_model"
                       placeholder="contoh: Avanza 1.3 G"
                       class="km-input @error('car_model') border-brand-red/60 @enderror">
                @error('car_model')<p class="text-brand-red text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="km-label">Tahun Produksi <span class="text-brand-red">*</span></label>
                <input type="number" wire:model="year"
                       placeholder="{{ date('Y') }}" min="1990" max="{{ date('Y') + 1 }}"
                       class="km-input @error('year') border-brand-red/60 @enderror">
                @error('year')<p class="text-brand-red text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="km-label">Kilometer (KM) <span class="text-brand-red">*</span></label>
                <input type="number" wire:model="mileage"
                       placeholder="contoh: 45000" min="0"
                       class="km-input @error('mileage') border-brand-red/60 @enderror">
                @error('mileage')<p class="text-brand-red text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="km-label">Transmisi</label>
                <div class="flex gap-3">
                    <button type="button" wire:click="$set('transmission', 'manual')"
                            class="filter-chip flex-1 text-center {{ $transmission === 'manual' ? 'filter-chip-active' : '' }}">
                        Manual
                    </button>
                    <button type="button" wire:click="$set('transmission', 'automatic')"
                            class="filter-chip flex-1 text-center {{ $transmission === 'automatic' ? 'filter-chip-active' : '' }}">
                        Otomatis
                    </button>
                </div>
            </div>
            <div>
                <label class="km-label">Warna</label>
                <input type="text" wire:model="color"
                       placeholder="contoh: Putih"
                       class="km-input">
            </div>
            <div>
                <label class="km-label">Plat Nomor</label>
                <input type="text" wire:model="plate_number"
                       placeholder="contoh: B 1234 XYZ"
                       class="km-input">
            </div>
            <div>
                <label class="km-label">Kondisi Umum</label>
                <select wire:model="condition" class="km-select">
                    <option value="">Pilih kondisi...</option>
                    <option value="Sangat Baik">Sangat Baik</option>
                    <option value="Baik">Baik</option>
                    <option value="Cukup">Cukup</option>
                    <option value="Perlu Perbaikan">Perlu Perbaikan</option>
                </select>
            </div>
        </div>
        <div class="flex justify-between mt-8">
            <button wire:click="prevStep" class="btn-outline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                Kembali
            </button>
            <button wire:click="nextStep" class="btn-primary">
                Lanjut: Detail Penawaran
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- STEP 3: Offer Details --}}
    @elseif($step === 3)
    <div>
        <h3 class="font-heading font-bold text-xl text-brand-white mb-6">Langkah 3 — Tinjau & Penawaran</h3>

        {{-- Summary --}}
        <div class="bg-brand-mid-gray rounded-xl p-5 mb-6 text-sm">
            <h4 class="font-heading font-semibold text-brand-silver mb-3 text-xs uppercase tracking-wider">Ringkasan</h4>
            <div class="grid grid-cols-2 gap-y-2 gap-x-4">
                <div class="text-brand-text-gray">Nama</div><div class="text-brand-white">{{ $name }}</div>
                <div class="text-brand-text-gray">Telepon</div><div class="text-brand-white">{{ $phone }}</div>
                <div class="text-brand-text-gray">Kendaraan</div><div class="text-brand-white">{{ $car_make }} {{ $car_model }}</div>
                <div class="text-brand-text-gray">Tahun</div><div class="text-brand-white">{{ $year }}</div>
                <div class="text-brand-text-gray">Kilometer</div><div class="text-brand-white">{{ number_format((int)$mileage, 0, ',', '.') }} KM</div>
                @if($transmission)<div class="text-brand-text-gray">Transmisi</div><div class="text-brand-white">{{ ucfirst($transmission) }}</div>@endif
                @if($condition)<div class="text-brand-text-gray">Kondisi</div><div class="text-brand-white">{{ $condition }}</div>@endif
            </div>
        </div>

        <div class="space-y-5">
            <div>
                <label class="km-label">Harga yang Diinginkan (IDR) <span class="text-brand-red">*</span></label>
                <input type="text" wire:model="asking_price"
                       placeholder="contoh: 150.000.000"
                       class="km-input @error('asking_price') border-brand-red/60 @enderror">
                @error('asking_price')<p class="text-brand-red text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="km-label">Catatan Tambahan</label>
                <textarea wire:model="notes" rows="3"
                          placeholder="Informasi tambahan tentang kendaraan..."
                          class="km-input resize-none"></textarea>
            </div>
        </div>

        <div class="flex justify-between mt-8">
            <button wire:click="prevStep" class="btn-outline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                Kembali
            </button>
            <button wire:click="submit" wire:loading.attr="disabled" class="btn-wa">
                <span wire:loading.remove>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                </span>
                <span wire:loading>Mengirim...</span>
                <span wire:loading.remove>Kirim via WhatsApp</span>
            </button>
        </div>
    </div>
    @endif
</div>
