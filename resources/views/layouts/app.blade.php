<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    {!! SEO::generate() !!}

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

    {{-- Canonical --}}
    <link rel="canonical" href="{{ url()->current() }}">
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