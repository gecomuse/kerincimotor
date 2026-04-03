<div x-data="{ mobileFilter: false }">

    {{-- ── Mobile Filter Toggle ─────────────────────── --}}
    <div class="flex items-center justify-between mb-6 lg:hidden">
        <p class="text-brand-text-gray text-sm">
            Menampilkan <span class="text-brand-white font-semibold">{{ $total }}</span> kendaraan
        </p>
        <button @click="mobileFilter = true"
                class="btn-outline text-sm gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
            </svg>
            Filter
        </button>
    </div>

    <div class="flex gap-8">

        {{-- ── Desktop Sidebar Filter ───────────────────── --}}
        <aside class="hidden lg:block w-72 flex-shrink-0">
            @include('livewire.partials.filter-panel')
        </aside>

        {{-- ── Mobile Filter Drawer ─────────────────────── --}}
        <div x-show="mobileFilter"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="lg:hidden fixed inset-0 z-50 bg-black/70 backdrop-blur-sm"
             @click.self="mobileFilter = false">
            <div class="absolute right-0 top-0 bottom-0 w-80 bg-brand-dark-gray overflow-y-auto"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0">
                <div class="flex items-center justify-between p-4 border-b border-white/10">
                    <h3 class="font-heading font-bold text-brand-white">Filter</h3>
                    <button @click="mobileFilter = false" class="text-brand-text-gray hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="p-4">
                    @include('livewire.partials.filter-panel')
                </div>
            </div>
        </div>

        {{-- ── Results ──────────────────────────────────── --}}
        <div class="flex-1 min-w-0">

            {{-- Result count & reset --}}
            <div class="flex items-center justify-between mb-6">
                <p class="text-brand-text-gray text-sm hidden lg:block">
                    Menampilkan <span class="text-brand-white font-semibold">{{ $total }}</span> kendaraan
                </p>
                <button wire:click="resetFilters"
                        class="text-brand-text-gray hover:text-brand-red text-sm transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Reset Filter
                </button>
            </div>

            {{-- Loading state --}}
            <div wire:loading class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                @for($i = 0; $i < 6; $i++)
                <div class="car-card animate-pulse">
                    <div class="aspect-video bg-brand-mid-gray"></div>
                    <div class="p-5 space-y-3">
                        <div class="h-5 bg-brand-mid-gray rounded w-3/4"></div>
                        <div class="h-4 bg-brand-mid-gray rounded w-1/2"></div>
                        <div class="h-10 bg-brand-mid-gray rounded mt-4"></div>
                    </div>
                </div>
                @endfor
            </div>

            {{-- Cars Grid --}}
            <div wire:loading.remove>
                @if($cars->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                    @foreach($cars as $car)
                    @include('components.car-card', ['car' => $car])
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $cars->links('livewire.partials.pagination') }}
                </div>
                @else
                {{-- Empty state --}}
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <svg class="w-16 h-16 text-brand-text-gray/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                              d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="font-heading font-bold text-brand-white text-xl mb-2">Tidak ada kendaraan ditemukan</h3>
                    <p class="text-brand-text-gray text-sm mb-6">Coba sesuaikan filter untuk menemukan lebih banyak pilihan.</p>
                    <button wire:click="resetFilters" class="btn-primary">Reset Filter</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
