<?php $__env->startSection('content'); ?>
<?php
    $waNumber   = $globalSettings['wa_number']->value ?? '6287776700009';
    $tagline    = $globalSettings['hero_tagline']->value ?? 'Mobil Bekas Terpercaya, Harga Terbaik';
    $subtagline = $globalSettings['hero_subtagline']->value ?? 'Mobil bekas berkualitas, inspeksi ketat, dan kilometer jujur.';
    $address    = $globalSettings['address']->value ?? 'Bekasi, Jawa Barat';
    $hours      = $globalSettings['operating_hours']->value ?? 'Every Day, 08:00 – 20:00 WIB';
    $mapsUrl    = $globalSettings['google_maps_url']->value ?? '#';
    $mapsEmbed  = $globalSettings['google_maps_embed']->value ?? '';

    $waHeroMsg  = urlencode('Halo Kerinci Motor, saya ingin mengetahui unit mobil bekas yang tersedia.');
    $waHeroUrl  = "https://wa.me/{$waNumber}?text={$waHeroMsg}";
    $waLocMsg   = urlencode('Halo Kerinci Motor, saya ingin bertanya.');
    $waLocUrl   = "https://wa.me/{$waNumber}?text={$waLocMsg}";
?>




<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-brand-black">
    
    <div class="absolute inset-0 bg-gradient-to-br from-brand-black via-[#1a0000] to-brand-black"></div>
    <div class="absolute inset-0 opacity-20"
         style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23CC0000\' fill-opacity=\'0.08\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
    </div>

    
    <div class="absolute top-1/2 right-0 -translate-y-1/2 w-[600px] h-[600px] rounded-full
                bg-brand-red/5 blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 md:px-8 pt-32 pb-20 text-center">
        <p class="section-label mb-4" x-data x-intersect="$el.classList.add('animate-fade-in')">
            🏆 Showroom Mobil Bekas #1 Terpercaya di Bekasi
        </p>

        <h1 class="font-heading font-extrabold text-4xl md:text-6xl lg:text-7xl text-brand-white leading-tight mb-6">
            <?php echo e($tagline); ?>

        </h1>

        <p class="text-brand-text-gray text-lg md:text-xl max-w-2xl mx-auto mb-10">
            <?php echo e($subtagline); ?>

        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="<?php echo e($waHeroUrl); ?>" target="_blank" rel="noopener"
               onclick="trackWA('hero')"
               class="btn-wa text-base px-8 py-4">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Hubungi via WhatsApp
            </a>
            <a href="<?php echo e(route('catalog.index')); ?>" class="btn-outline text-base px-8 py-4">
                Lihat Katalog
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        
        <div class="mt-16 grid grid-cols-3 gap-4 max-w-2xl mx-auto">
            <div class="text-center">
                <div class="font-heading font-extrabold text-3xl text-brand-red"><?php echo e($totalCars); ?>+</div>
                <div class="text-brand-text-gray text-sm mt-1">Unit Tersedia</div>
            </div>
            <div class="text-center border-x border-white/10">
                <div class="font-heading font-extrabold text-3xl text-brand-red">150+</div>
                <div class="text-brand-text-gray text-sm mt-1">Poin Inspeksi</div>
            </div>
            <div class="text-center">
                <div class="font-heading font-extrabold text-3xl text-brand-red">100%</div>
                <div class="text-brand-text-gray text-sm mt-1">Harga Transparan</div>
            </div>
        </div>
    </div>

    
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-brand-text-gray text-xs animate-bounce">
        <span>Scroll</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>




<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredCars->count()): ?>
<section id="catalog-preview" class="py-20 bg-brand-black">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="flex items-end justify-between mb-10">
            <div>
                <p class="section-label">Inventaris Kami</p>
                <h2 class="section-title mb-0">Mobil Tersedia</h2>
            </div>
            <a href="<?php echo e(route('catalog.index')); ?>" class="btn-outline hidden md:inline-flex text-sm">
                Lihat Semua Kendaraan
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $featuredCars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('components.car-card', ['car' => $car], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="text-center mt-10 md:hidden">
            <a href="<?php echo e(route('catalog.index')); ?>" class="btn-primary">Lihat Semua Kendaraan</a>
        </div>
    </div>
</section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>




<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($latestPosts) && $latestPosts->count()): ?>
<section class="py-20 bg-brand-dark-gray">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="text-center mb-12">
            <p class="section-label">Tips & Panduan</p>
            <h2 class="section-title">Artikel Terbaru</h2>
            <p class="section-subtitle mx-auto">Tips dan panduan beli mobil bekas dari praktisi</p>
            <div class="divider-red mx-auto mt-4"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $latestPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('artikel.show', $post->slug)); ?>"
               class="group block bg-brand-mid-gray border border-white/5 rounded-2xl overflow-hidden
                      hover:border-brand-red/30 transition-all duration-300 hover:-translate-y-1">
                <div class="aspect-video overflow-hidden bg-brand-dark-gray">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->thumbnail_url && $post->thumbnail): ?>
                    <img src="<?php echo e($post->thumbnail_url); ?>"
                         alt="<?php echo e($post->title); ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         onerror="this.parentElement.innerHTML='<div class=\'flex items-center justify-center h-full text-5xl\'>📰</div>'">
                    <?php else: ?>
                    <div class="flex items-center justify-center h-full text-5xl">📰</div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="p-6">
                    <span class="inline-block bg-brand-red/20 text-brand-red text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full mb-3">
                        <?php echo e($post->category); ?>

                    </span>
                    <h3 class="font-heading font-bold text-base text-brand-white mb-2 group-hover:text-brand-red transition-colors line-clamp-2">
                        <?php echo e($post->title); ?>

                    </h3>
                    <p class="text-brand-text-gray text-sm leading-relaxed mb-4 line-clamp-3">
                        <?php echo e(Str::limit($post->excerpt, 120)); ?>

                    </p>
                    <div class="flex items-center justify-between text-xs text-brand-text-gray">
                        <span><?php echo e($post->published_at?->locale('id')->isoFormat('D MMM YYYY')); ?></span>
                        <span class="flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <?php echo e($post->read_time); ?> mnt
                        </span>
                    </div>
                    <div class="mt-4 text-brand-red text-sm font-semibold group-hover:underline">
                        Baca Selengkapnya →
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-3 text-center py-10 text-brand-text-gray">
                Belum ada artikel tersedia.
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="text-center mt-10">
            <a href="<?php echo e(route('artikel.index')); ?>" class="btn-outline">
                Lihat Semua Artikel →
            </a>
        </div>
    </div>
</section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>




<section id="why-us" class="py-20 bg-brand-dark-gray">
    <div class="max-w-7xl mx-auto px-4 md:px-8 text-center">
        <p class="section-label">Komitmen Kami</p>
        <h2 class="section-title">Kenapa Pilih Kerinci Motor?</h2>
        <div class="divider-red mx-auto mb-12"></div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = [
                ['icon' => '🔍', 'title' => 'Harga Transparan', 'desc' => 'Harga yang Anda lihat adalah harga final. Tidak ada biaya tersembunyi atau negosiasi yang menekan.'],
                ['icon' => '🔧', 'title' => 'Kondisi Terawat', 'desc' => 'Setiap unit melewati inspeksi 150+ poin untuk memastikan kondisi terbaik sebelum dijual.'],
                ['icon' => '⚡', 'title' => 'Proses Cepat', 'desc' => 'Proses pembelian yang cepat dan mudah. Dokumen lengkap, STNK atas nama Anda.'],
                ['icon' => '📊', 'title' => 'Kilometer Jujur', 'desc' => 'Kilometer asli, tidak direkayasa. Didukung riwayat servis dan dokumentasi lengkap.'],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-brand-mid-gray border border-white/5 rounded-xl p-7 hover:border-brand-red/30
                        transition-all duration-300 hover:-translate-y-1 group text-left">
                <div class="text-4xl mb-4"><?php echo e($usp['icon']); ?></div>
                <h3 class="font-heading font-bold text-lg text-brand-white mb-2 group-hover:text-brand-red transition-colors">
                    <?php echo e($usp['title']); ?>

                </h3>
                <p class="text-brand-text-gray text-sm leading-relaxed"><?php echo e($usp['desc']); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</section>




<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testimonials->count() >= 3): ?>
<section id="testimonials" class="py-20 bg-brand-dark-gray">
    <div class="max-w-7xl mx-auto px-4 md:px-8 text-center">
        <p class="section-label">Kata Pelanggan</p>
        <h2 class="section-title">Ulasan Pelanggan</h2>
        <div class="divider-red mx-auto mb-12"></div>

        <div class="swiper testimonial-swiper pb-12">
            <div class="swiper-wrapper">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                    <div class="testi-card text-left h-full">
                        
                        <div class="flex gap-1 text-yellow-400 mb-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?>
                            <svg class="w-4 h-4 <?php echo e($i <= $testi->rating ? 'fill-current' : 'fill-none'); ?>" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2"
                                      d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                            <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <p class="text-brand-text-gray text-sm leading-relaxed mb-4 italic">
                            "<?php echo e($testi->content); ?>"
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-brand-red/20 flex items-center justify-center
                                        font-heading font-bold text-brand-red text-sm">
                                <?php echo e(strtoupper(substr($testi->name, 0, 1))); ?>

                            </div>
                            <div>
                                <div class="font-heading font-semibold text-brand-white text-sm"><?php echo e($testi->name); ?></div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testi->location): ?>
                                <div class="text-brand-text-gray text-xs"><?php echo e($testi->location); ?></div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>




<section id="sell-car" class="py-20 bg-brand-black">
    <div class="max-w-4xl mx-auto px-4 md:px-8">
        <div class="text-center mb-10">
            <p class="section-label">Ingin Menjual?</p>
            <h2 class="section-title">Jual Mobil ke Kami</h2>
            <p class="section-subtitle mx-auto">
                Isi formulir berikut dan kami akan segera menghubungi Anda via WhatsApp untuk melanjutkan prosesnya.
            </p>
        </div>

        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('sell-your-car-form');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1436415697-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
</section>




<section id="location" class="py-20 bg-brand-dark-gray">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="text-center mb-12">
            <p class="section-label">Temukan Kami</p>
            <h2 class="section-title">Lokasi Kami</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            
            <div class="rounded-2xl overflow-hidden border border-white/5 h-80 bg-brand-mid-gray">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($mapsEmbed): ?>
                <iframe src="<?php echo e($mapsEmbed); ?>"
                        width="100%" height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full h-full">
                </iframe>
                <?php else: ?>
                <div class="flex items-center justify-center h-full text-brand-text-gray">
                    <a href="<?php echo e($mapsUrl); ?>" target="_blank" rel="noopener"
                       class="flex flex-col items-center gap-3 text-center p-8 hover:text-brand-red transition-colors">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Buka di Google Maps</span>
                    </a>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div>
                <h3 class="font-heading font-bold text-2xl text-brand-white mb-6">Kerinci Motor Showroom</h3>
                <div class="flex flex-col gap-5">
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 rounded-lg bg-brand-red/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-brand-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-heading font-semibold text-brand-white mb-1">Alamat</div>
                            <p class="text-brand-text-gray text-sm"><?php echo e($address); ?></p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 rounded-lg bg-brand-red/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-brand-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-heading font-semibold text-brand-white mb-1">Jam Operasional</div>
                            <p class="text-brand-text-gray text-sm"><?php echo e($hours); ?></p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 mt-8">
                    <a href="<?php echo e($waLocUrl); ?>" target="_blank" rel="noopener"
                       onclick="trackWA('footer')"
                       class="btn-wa flex-1 justify-center">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Chat Sekarang
                    </a>
                    <a href="<?php echo e($mapsUrl); ?>" target="_blank" rel="noopener" class="btn-outline flex-1 justify-center">
                        Petunjuk Arah
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\= vscode\Kerinci Motor\resources\views\home.blade.php ENDPATH**/ ?>