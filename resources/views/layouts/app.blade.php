<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="author" content="Kerinci Motor">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Dynamic SEO --}}
    @hasSection('seo_title')
        <title>@yield('seo_title')</title>
        <meta property="og:title" content="@yield('seo_title')">
        <meta name="twitter:title" content="@yield('seo_title')">
    @else
        <title>Kerinci Motor — Dealer Mobil Bekas Terpercaya di Bekasi</title>
        <meta property="og:title" content="Kerinci Motor — Dealer Mobil Bekas Terpercaya di Bekasi">
        <meta name="twitter:title" content="Kerinci Motor — Dealer Mobil Bekas Terpercaya di Bekasi">
    @endif

    @hasSection('seo_description')
        <meta name="description" content="@yield('seo_description')">
        <meta property="og:description" content="@yield('seo_description')">
        <meta name="twitter:description" content="@yield('seo_description')">
    @else
        <meta name="description" content="Kerinci Motor — dealer mobil bekas terpercaya di Bekasi. Stok lengkap, harga transparan, proses mudah. Honda, Toyota, Daihatsu, Suzuki, Mitsubishi.">
        <meta property="og:description" content="Kerinci Motor — dealer mobil bekas terpercaya di Bekasi. Stok lengkap, harga transparan, proses mudah.">
        <meta name="twitter:description" content="Kerinci Motor — dealer mobil bekas terpercaya di Bekasi.">
    @endif

    @hasSection('seo_keywords')
        <meta name="keywords" content="@yield('seo_keywords')">
    @else
        <meta name="keywords" content="mobil bekas bekasi, dealer mobil bekas, jual beli mobil bekas, kerinci motor, beli mobil bekas murah bekasi">
    @endif

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Kerinci Motor">
    @hasSection('og_image')
        <meta property="og:image" content="@yield('og_image')">
    @else
        <meta property="og:image" content="{{ asset('images/og-default.jpg') }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">

    {{-- Additional head content from child views --}}
    @stack('meta')

    {{-- VITE (WAJIB) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Livewire --}}
    @livewireStyles

    {{-- GA4 --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PVRX74XRPR"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-PVRX74XRPR');
    </script>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    {{-- LocalBusiness Schema --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "AutoDealer",
      "name": "Kerinci Motor",
      "description": "Dealer mobil bekas terpercaya di Bekasi",
      "url": "https://kerincimotor.com",
      "telephone": "+6287776700009",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Jl. Mustika Jaya RT.006/RW.012, Mustikajaya",
        "addressLocality": "Kota Bekasi",
        "addressRegion": "Jawa Barat",
        "postalCode": "17158",
        "addressCountry": "ID"
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
        "opens": "08:00",
        "closes": "20:00"
      },
      "sameAs": ["https://www.instagram.com/kerincimotor"]
    }
    </script>
</head>

<body class="bg-brand-black text-brand-white antialiased">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Floating WA --}}
    @include('components.floating-wa')

    {{-- Livewire --}}
    @livewireScripts

    @stack('scripts')

</body>
</html>
