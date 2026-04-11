<?php $__env->startPush('meta'); ?>
<meta property="og:type" content="product">
<meta property="og:title" content="<?php echo e($car->make_model); ?> <?php echo e($car->year); ?> — Kerinci Motor">
<meta property="og:description" content="<?php echo e($car->formatted_price); ?> · <?php echo e($car->formatted_mileage); ?> · <?php echo e(ucfirst($car->transmission)); ?>">
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->getFirstMediaUrl('car_images', 'medium')): ?>
<meta property="og:image" content="<?php echo e($car->getFirstMediaUrl('car_images', 'medium')); ?>">
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $waNumber = $globalSettings['wa_number']->value ?? '6287776700009';
    $photos   = $car->getMedia('car_images');

    $pdpMsg   = "Halo Kerinci Motor, saya tertarik dengan:\n\n"
              . "🚗 *{$car->make_model}*\n"
              . "📅 Tahun: {$car->year}\n"
              . "💰 Harga: {$car->formatted_price}\n"
              . "🛣️ Kilometer: {$car->formatted_mileage}\n"
              . "⚙️ Transmisi: " . ucfirst($car->transmission) . "\n"
              . "🎨 Warna: {$car->color}\n\n"
              . "Apakah unit ini masih tersedia? Mohon informasinya. Terima kasih!";
    $waUrl    = "https://wa.me/{$waNumber}?text=" . urlencode($pdpMsg);
?>


<div id="sticky-cta"
     class="fixed bottom-0 left-0 right-0 z-30 bg-brand-dark-gray/95 backdrop-blur-md
            border-t border-white/10 py-3 px-4 translate-y-full opacity-0 transition-all duration-300">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
        <div class="hidden sm:block">
            <div class="font-heading font-bold text-brand-white"><?php echo e($car->make_model); ?> <?php echo e($car->year); ?></div>
            <div class="text-brand-red font-heading font-bold text-lg"><?php echo e($car->formatted_price); ?></div>
        </div>
        <a href="<?php echo e($waUrl); ?>" target="_blank" rel="noopener"
           onclick="trackWA('pdp', '<?php echo e(addslashes($car->make_model)); ?>', <?php echo e($car->price); ?>)"
           class="btn-wa ml-auto">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            Tanya Harga
        </a>
    </div>
</div>

<div class="pt-24 pb-28 bg-brand-black">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        
        <nav class="flex items-center gap-2 text-xs text-brand-text-gray mb-8 flex-wrap">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-brand-red transition-colors">Beranda</a>
            <span>/</span>
            <a href="<?php echo e(route('catalog.index')); ?>" class="hover:text-brand-red transition-colors">Katalog</a>
            <span>/</span>
            <span class="text-brand-white"><?php echo e($car->make_model); ?> <?php echo e($car->year); ?></span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">

            
            <div class="lg:col-span-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($photos->count()): ?>
                
                <div class="swiper pdp-swiper rounded-2xl overflow-hidden bg-brand-dark-gray mb-3">
                    <div class="swiper-wrapper">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide">
                            <a href="<?php echo e($photo->hasGeneratedConversion('large') ? $photo->getUrl('large') : $photo->getUrl()); ?>"
                               class="glightbox block aspect-video"
                               data-gallery="car-gallery"
                               data-title="<?php echo e($car->make_model); ?> <?php echo e($car->year); ?>">
                                <img src="<?php echo e($photo->hasGeneratedConversion('medium') ? $photo->getUrl('medium') : $photo->getUrl()); ?>"
                                     alt="<?php echo e($car->make_model); ?> <?php echo e($car->year); ?> <?php echo e($car->color); ?> — Kerinci Motor"
                                     loading="lazy"
                                     class="w-full h-full object-cover">
                            </a>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($photos->count() > 1): ?>
                <div class="swiper pdp-thumbs">
                    <div class="swiper-wrapper">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide cursor-pointer">
                            <img src="<?php echo e($photo->hasGeneratedConversion('thumb') ? $photo->getUrl('thumb') : $photo->getUrl()); ?>"
                                 alt="Thumbnail"
                                 class="w-full aspect-video object-cover rounded-lg border-2 border-transparent
                                        hover:border-brand-red transition-colors">
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php else: ?>
                
                <div class="aspect-video bg-brand-dark-gray rounded-2xl flex items-center justify-center border border-white/5">
                    <div class="text-center text-brand-text-gray">
                        <svg class="w-16 h-16 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm">Foto tidak tersedia</p>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="lg:col-span-2 flex flex-col gap-5">

                
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->is_available): ?>
                        <span class="badge-available">TERSEDIA</span>
                        <?php else: ?>
                        <span class="badge-sold">TERJUAL</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->is_featured): ?>
                        <span class="bg-yellow-500/20 text-yellow-400 border border-yellow-500/30
                                     rounded-full px-3 py-1 text-xs font-heading font-bold">★ Unggulan</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <h1 class="font-heading font-extrabold text-2xl md:text-3xl text-brand-white leading-tight">
                        <?php echo e($car->make_model); ?>

                    </h1>
                    <p class="text-brand-text-gray text-sm mt-1"><?php echo e($car->year); ?> · <?php echo e(ucfirst(str_replace('_',' ',$car->body_type))); ?></p>
                </div>

                
                <div class="bg-brand-dark-gray border border-white/5 rounded-xl p-5">
                    <div class="text-brand-text-gray text-sm mb-1">Harga</div>
                    <div class="font-heading font-extrabold text-3xl text-brand-white"><?php echo e($car->formatted_price); ?></div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->tax_status): ?>
                    <div class="text-xs text-green-400 mt-1">✓ Pajak <?php echo e($car->tax_status); ?></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div class="bg-brand-dark-gray border border-white/5 rounded-xl p-5">
                    <h3 class="font-heading font-bold text-brand-silver text-xs uppercase tracking-wider mb-4">Spesifikasi</h3>
                    <div class="grid grid-cols-2 gap-y-3 gap-x-4 text-sm">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = [
                            ['label' => 'Kilometer',  'value' => $car->formatted_mileage],
                            ['label' => 'Transmisi',  'value' => ucfirst($car->transmission)],
                            ['label' => 'Bahan Bakar','value' => ucfirst($car->fuel_type)],
                            ['label' => 'Warna',      'value' => $car->color],
                            ['label' => 'Tipe Bodi',  'value' => ucfirst(str_replace('_',' ',$car->body_type))],
                            ['label' => 'Tahun',      'value' => $car->year],
                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <div class="text-brand-text-gray text-xs mb-0.5"><?php echo e($spec['label']); ?></div>
                            <div class="text-brand-white font-semibold"><?php echo e($spec['value']); ?></div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->is_available): ?>
                <a href="<?php echo e($waUrl); ?>" target="_blank" rel="noopener"
                   onclick="trackWA('pdp', '<?php echo e(addslashes($car->make_model)); ?>', <?php echo e($car->price); ?>)"
                   class="btn-wa w-full justify-center text-base py-4">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Tanya Harga via WhatsApp
                </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <a href="<?php echo e(route('catalog.index')); ?>" class="btn-outline w-full justify-center text-sm">
                    ← Kembali ke Katalog
                </a>
            </div>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->description || $car->condition_notes): ?>
        <div class="mt-12 grid grid-cols-1 lg:grid-cols-2 gap-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->description): ?>
            <div class="bg-brand-dark-gray border border-white/5 rounded-2xl p-7">
                <h2 class="font-heading font-bold text-xl text-brand-white mb-5">Deskripsi Kendaraan</h2>
                <div class="prose prose-invert prose-sm max-w-none text-brand-text-gray">
                    <?php echo $car->description; ?>

                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->condition_notes): ?>
            <div class="bg-brand-dark-gray border border-white/5 rounded-2xl p-7">
                <h2 class="font-heading font-bold text-xl text-brand-white mb-5">Catatan Kondisi</h2>
                <p class="text-brand-text-gray text-sm leading-relaxed"><?php echo e($car->condition_notes); ?></p>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedCars->count()): ?>
        <div class="mt-16">
            <h2 class="font-heading font-bold text-2xl text-brand-white mb-6">Kendaraan Serupa</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $relatedCars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('components.car-card', ['car' => $car], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    if (typeof gtag !== 'undefined') {
        gtag('event', 'pdp_view', {
            car_slug: '<?php echo e($car->slug); ?>',
            car_price: <?php echo e($car->price); ?>

        });
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\= vscode\Kerinci Motor\resources\views\catalog\show.blade.php ENDPATH**/ ?>