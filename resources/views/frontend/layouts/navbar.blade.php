@php
    $waNumber = $globalSettings['wa_number']->value ?? '6287776700009';
    $waMsg    = urlencode('Halo Kerinci Motor, saya ingin mengetahui unit yang tersedia.');
    $waUrl    = "https://wa.me/{$waNumber}?text={$waMsg}";
@endphp

<header id="main-navbar"
        class="fixed top-0 left-0 right-0 z-40 transition-all duration-300 py-4 px-4 md:px-8"
        x-data="{ scrolled: false, open: false }"
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 40 })"
        :class="scrolled ? 'bg-brand-dark-gray/95 backdrop-blur-md shadow-lg py-3' : 'bg-transparent py-4'">

    <div class="max-w-7xl mx-auto flex items-center justify-between">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex-shrink-0">
            <img src="{{ asset('images/logo.png') }}" alt="Kerinci Motor"
                 class="h-10 w-auto object-contain"
                 onerror="this.outerHTML='<span class=\'font-heading font-extrabold text-xl text-brand-white\'>KERINCI<span class=\'text-brand-red\'>MOTOR</span></span>'">
        </a>

        {{-- Desktop Nav --}}
        <nav class="hidden lg:flex items-center gap-7">
            <a href="{{ route('inventory.index') }}"
               class="navbar-link flex items-center gap-1.5">
                <span class="w-2 h-2 bg-brand-red rounded-full animate-pulse"></span>
                Mobil HOT DEALS!
            </a>
            <a href="{{ route('home') }}#financing" class="navbar-link">Simulasi Cicilan</a>
            <a href="{{ route('video.index') }}"    class="navbar-link">Video Review</a>
            <a href="{{ route('tips.index') }}"     class="navbar-link">Tips &amp; Trick</a>
            <a href="{{ route('sell.index') }}"     class="navbar-link">Jual Mobil Anda</a>
        </nav>

        {{-- WA CTA (desktop) --}}
        <a href="{{ route('whatsapp') }}" target="_blank" rel="noopener"
           class="hidden lg:inline-flex btn-wa text-sm">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            Hubungi Kami
        </a>

        {{-- Hamburger (mobile) --}}
        <button @click="open = !open"
                class="lg:hidden text-brand-white p-2 rounded-lg hover:bg-white/5 transition-colors"
                aria-label="Toggle menu">
            <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden mt-4 glass-dark rounded-xl p-4 mx-0"
         style="display: none;">
        <nav class="flex flex-col gap-1">
            <a href="{{ route('inventory.index') }}" @click="open=false"
               class="navbar-link py-3 px-3 rounded-lg hover:bg-white/5 flex items-center gap-2">
                <span class="w-2 h-2 bg-brand-red rounded-full"></span> Mobil HOT DEALS!
            </a>
            <a href="{{ route('home') }}#financing"  @click="open=false" class="navbar-link py-3 px-3 rounded-lg hover:bg-white/5">Simulasi Cicilan</a>
            <a href="{{ route('video.index') }}"     @click="open=false" class="navbar-link py-3 px-3 rounded-lg hover:bg-white/5">Video Review</a>
            <a href="{{ route('tips.index') }}"      @click="open=false" class="navbar-link py-3 px-3 rounded-lg hover:bg-white/5">Tips &amp; Trick</a>
            <a href="{{ route('sell.index') }}"      @click="open=false" class="navbar-link py-3 px-3 rounded-lg hover:bg-white/5">Jual Mobil Anda</a>
            <div class="border-t border-white/5 mt-2 pt-3">
                <a href="{{ route('whatsapp') }}" target="_blank" rel="noopener"
                   class="btn-wa w-full justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Hubungi via WhatsApp
                </a>
            </div>
        </nav>
    </div>
</header>
