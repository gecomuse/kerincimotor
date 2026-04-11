<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="author" content="Kerinci Motor">
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">

    
    <?php if (! empty(trim($__env->yieldContent('seo_title')))): ?>
        <title><?php echo $__env->yieldContent('seo_title'); ?></title>
        <meta property="og:title" content="<?php echo $__env->yieldContent('seo_title'); ?>">
        <meta name="twitter:title" content="<?php echo $__env->yieldContent('seo_title'); ?>">
    <?php else: ?>
        <title>Kerinci Motor — Dealer Mobil Bekas Terpercaya di Bekasi</title>
        <meta property="og:title" content="Kerinci Motor — Dealer Mobil Bekas Terpercaya di Bekasi">
        <meta name="twitter:title" content="Kerinci Motor — Dealer Mobil Bekas Terpercaya di Bekasi">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if (! empty(trim($__env->yieldContent('seo_description')))): ?>
        <meta name="description" content="<?php echo $__env->yieldContent('seo_description'); ?>">
        <meta property="og:description" content="<?php echo $__env->yieldContent('seo_description'); ?>">
        <meta name="twitter:description" content="<?php echo $__env->yieldContent('seo_description'); ?>">
    <?php else: ?>
        <meta name="description" content="Kerinci Motor — dealer mobil bekas terpercaya di Bekasi. Stok lengkap, harga transparan, proses mudah. Honda, Toyota, Daihatsu, Suzuki, Mitsubishi.">
        <meta property="og:description" content="Kerinci Motor — dealer mobil bekas terpercaya di Bekasi. Stok lengkap, harga transparan, proses mudah.">
        <meta name="twitter:description" content="Kerinci Motor — dealer mobil bekas terpercaya di Bekasi.">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if (! empty(trim($__env->yieldContent('seo_keywords')))): ?>
        <meta name="keywords" content="<?php echo $__env->yieldContent('seo_keywords'); ?>">
    <?php else: ?>
        <meta name="keywords" content="mobil bekas bekasi, dealer mobil bekas, jual beli mobil bekas, kerinci motor, beli mobil bekas murah bekasi">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Kerinci Motor">
    <?php if (! empty(trim($__env->yieldContent('og_image')))): ?>
        <meta property="og:image" content="<?php echo $__env->yieldContent('og_image'); ?>">
    <?php else: ?>
        <meta property="og:image" content="<?php echo e(asset('images/og-default.jpg')); ?>">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <meta name="twitter:card" content="summary_large_image">

    
    <?php echo $__env->yieldPushContent('meta'); ?>

    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


    
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PVRX74XRPR"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-PVRX74XRPR');
    </script>

    
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon.png')); ?>">

    
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

    
    <?php echo $__env->make('components.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('components.floating-wa', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html>
<?php /**PATH D:\= vscode\Kerinci Motor\resources\views\layouts\app.blade.php ENDPATH**/ ?>