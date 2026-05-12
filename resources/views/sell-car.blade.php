@extends('layouts.app')

@section('seo_title', 'Jual Mobil Anda — Kerinci Motor Bekasi')
@section('seo_description', 'Jual mobil Anda ke Kerinci Motor. Proses cepat, harga terbaik, pembayaran langsung. Isi formulir dan kami hubungi via WhatsApp.')

@section('content')

{{-- Hero Section --}}
<section class="relative pt-32 pb-16 bg-brand-black overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-brand-black via-[#1a0000] to-brand-black opacity-80"></div>
    <div class="absolute top-1/2 left-0 -translate-y-1/2 w-[500px] h-[500px] rounded-full bg-brand-red/5 blur-3xl pointer-events-none"></div>
    <div class="relative max-w-7xl mx-auto px-4 md:px-8 text-center">
        <p class="section-label mb-4">Ingin Menjual Mobil Anda?</p>
        <h1 class="font-heading font-extrabold text-4xl md:text-5xl text-brand-white leading-tight mb-4">
            Jual Mobil Anda<br class="hidden md:block"> ke Kerinci Motor
        </h1>
        <p class="text-brand-text-gray text-lg max-w-xl mx-auto mb-0">
            Proses cepat, harga kompetitif, pembayaran langsung. Isi formulir dan tim kami akan menghubungi Anda via WhatsApp.
        </p>
    </div>
</section>

{{-- Why Sell to Us --}}
<section class="py-16 bg-brand-dark-gray">
    <div class="max-w-5xl mx-auto px-4 md:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
            @foreach([
                ['icon' => '⚡', 'title' => 'Proses Cepat', 'desc' => 'Estimasi harga dalam 1x24 jam'],
                ['icon' => '💰', 'title' => 'Harga Terbaik', 'desc' => 'Penawaran kompetitif sesuai kondisi unit'],
                ['icon' => '✅', 'title' => 'Pembayaran Langsung', 'desc' => 'Transfer tunai segera setelah deal'],
            ] as $item)
            <div class="bg-brand-mid-gray border border-white/5 rounded-xl p-6">
                <div class="text-4xl mb-3">{{ $item['icon'] }}</div>
                <h3 class="font-heading font-bold text-brand-white mb-1">{{ $item['title'] }}</h3>
                <p class="text-brand-text-gray text-sm">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Form Section --}}
<section class="py-20 bg-brand-black">
    <div class="max-w-4xl mx-auto px-4 md:px-8">
        <div class="text-center mb-10">
            <p class="section-label">Formulir Penjualan</p>
            <h2 class="section-title">Isi Data Kendaraan Anda</h2>
            <p class="section-subtitle mx-auto">
                Isi formulir di bawah ini. Setelah submit, WhatsApp kami akan terbuka otomatis untuk melanjutkan prosesnya.
            </p>
        </div>

        @livewire('sell-your-car-form')
    </div>
</section>

{{-- How It Works --}}
<section class="py-20 bg-brand-dark-gray">
    <div class="max-w-5xl mx-auto px-4 md:px-8 text-center">
        <p class="section-label">Alur Proses</p>
        <h2 class="section-title">Cara Jual Mobil ke Kami</h2>
        <div class="divider-red mx-auto mb-12"></div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['step' => '01', 'title' => 'Isi Formulir', 'desc' => 'Data lengkap tentang kendaraan Anda'],
                ['step' => '02', 'title' => 'Kami Hubungi', 'desc' => 'Tim kami menghubungi via WhatsApp'],
                ['step' => '03', 'title' => 'Survey Unit', 'desc' => 'Inspeksi kendaraan di showroom atau lokasi'],
                ['step' => '04', 'title' => 'Deal & Bayar', 'desc' => 'Harga disepakati, pembayaran langsung'],
            ] as $s)
            <div class="bg-brand-mid-gray border border-white/5 rounded-xl p-6 text-left">
                <div class="font-heading font-extrabold text-4xl text-brand-red/30 mb-3">{{ $s['step'] }}</div>
                <h3 class="font-heading font-bold text-brand-white mb-1">{{ $s['title'] }}</h3>
                <p class="text-brand-text-gray text-sm">{{ $s['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
