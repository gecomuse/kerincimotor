@extends('layouts.app')

@push('scripts')
<script>
    // Meta Pixel — Search (fires when Livewire filter state changes)
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('catalog-search', ({ search_string }) => {
            if (typeof fbq !== 'undefined') {
                fbq('track', 'Search', { search_string: search_string });
            }
        });
    });
</script>
@endpush

@section('content')
<div class="pt-24 pb-20 bg-brand-black min-h-screen">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-brand-text-gray mb-6">
            <a href="{{ route('home') }}" class="hover:text-brand-red transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-brand-white">Katalog</span>
        </nav>

        <div class="mb-10">
            <p class="section-label">Temukan</p>
            <h1 class="section-title">Katalog Kendaraan</h1>
            <p class="section-subtitle">Temukan mobil bekas impian Anda dengan filter canggih kami.</p>
        </div>

        @livewire('catalog-filter')
    </div>
</div>
@endsection
