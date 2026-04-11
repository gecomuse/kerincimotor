<?php $__env->startSection('seo_title', 'Artikel & Tips Mobil Bekas | Kerinci Motor'); ?>
<?php $__env->startSection('seo_description', 'Panduan lengkap beli mobil bekas: tips cek kondisi, harga terkini, dan pilihan unit terbaik. Kerinci Motor — dealer mobil bekas terpercaya.'); ?>
<?php $__env->startSection('seo_keywords', 'tips beli mobil bekas, harga mobil bekas, panduan mobil bekas, kerinci motor artikel'); ?>

<?php $__env->startPush('meta'); ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Blog",
  "name": "Artikel Kerinci Motor",
  "url": "<?php echo e(route('artikel.index')); ?>",
  "description": "Artikel tips otomotif dan panduan jual beli mobil bekas",
  "publisher": {
    "@type": "Organization",
    "name": "Kerinci Motor",
    "url": "<?php echo e(route('home')); ?>"
  }
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<style>
.blog-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
.blog-card:hover { transform: translateY(-4px); }
.blog-tag { display: inline-block; padding: 2px 10px; border-radius: 999px; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; }
.faq-item { border-bottom: 1px solid rgba(255,255,255,0.06); }
.faq-item:last-child { border-bottom: none; }
.faq-answer { display: none; }
.faq-item.open .faq-answer { display: block; }
.faq-item.open .faq-chevron { transform: rotate(180deg); }
.faq-chevron { transition: transform 0.25s ease; }
</style>


<section class="pt-32 pb-16 px-4 bg-brand-dark-gray">
    <div class="max-w-4xl mx-auto text-center">
        <span class="text-brand-red text-xs font-bold uppercase tracking-widest">Tips & Panduan</span>
        <h1 class="font-heading font-extrabold text-4xl md:text-5xl text-brand-white mt-3 mb-4">
            Artikel Kerinci Motor
        </h1>
        <p class="text-brand-text-gray text-lg max-w-2xl mx-auto">
            Artikel praktis seputar jual beli mobil bekas, tips perawatan, dan panduan pembelian cerdas.
        </p>
    </div>
</section>


<section class="py-16 px-4 bg-brand-black">
    <div class="max-w-7xl mx-auto">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loop->first): ?>
        
        <a href="<?php echo e(route('artikel.show', $post->slug)); ?>" class="blog-card block mb-12 group">
            <div class="grid md:grid-cols-2 gap-0 bg-brand-dark-gray rounded-2xl overflow-hidden border border-white/5">
                <div class="aspect-video md:aspect-auto overflow-hidden">
                    <img src="<?php echo e($post->thumbnail_url); ?>"
                         alt="<?php echo e($post->title); ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         onerror="this.style.display='none'">
                </div>
                <div class="p-8 md:p-10 flex flex-col justify-center">
                    <span class="blog-tag bg-brand-red/20 text-brand-red mb-4"><?php echo e($post->category); ?></span>
                    <h2 class="font-heading font-bold text-2xl md:text-3xl text-brand-white mb-3 group-hover:text-brand-red transition-colors">
                        <?php echo e($post->title); ?>

                    </h2>
                    <p class="text-brand-text-gray text-sm leading-relaxed mb-6"><?php echo e($post->excerpt); ?></p>
                    <div class="flex items-center gap-4 text-xs text-brand-text-gray">
                        <span><?php echo e($post->published_at?->locale('id')->isoFormat('D MMMM YYYY')); ?></span>
                        <span>·</span>
                        <span><?php echo e($post->read_time); ?> menit baca</span>
                    </div>
                </div>
            </div>
        </a>
        <?php else: ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loop->iteration === 2): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        <a href="<?php echo e(route('artikel.show', $post->slug)); ?>" class="blog-card block bg-brand-dark-gray rounded-2xl overflow-hidden border border-white/5 group">
            <div class="aspect-video overflow-hidden">
                <img src="<?php echo e($post->thumbnail_url); ?>"
                     alt="<?php echo e($post->title); ?>"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                     onerror="this.style.display='none'">
            </div>
            <div class="p-6">
                <span class="blog-tag bg-brand-red/20 text-brand-red mb-3 block w-fit"><?php echo e($post->category); ?></span>
                <h3 class="font-heading font-bold text-lg text-brand-white mb-2 group-hover:text-brand-red transition-colors line-clamp-2">
                    <?php echo e($post->title); ?>

                </h3>
                <p class="text-brand-text-gray text-sm leading-relaxed mb-4 line-clamp-3"><?php echo e($post->excerpt); ?></p>
                <div class="flex items-center gap-3 text-xs text-brand-text-gray">
                    <span><?php echo e($post->published_at?->locale('id')->isoFormat('D MMM YYYY')); ?></span>
                    <span>·</span>
                    <span><?php echo e($post->read_time); ?> mnt baca</span>
                </div>
            </div>
        </a>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loop->last): ?>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="text-center py-20 text-brand-text-gray">
            <p class="text-lg">Belum ada artikel. Cek lagi nanti ya!</p>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($posts->hasPages()): ?>
        <div class="mt-12 flex justify-center">
            <?php echo e($posts->links()); ?>

        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</section>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($faqs->count()): ?>
<section class="py-16 px-4 bg-brand-dark-gray">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-10">
            <span class="text-brand-red text-xs font-bold uppercase tracking-widest">FAQ</span>
            <h2 class="font-heading font-bold text-3xl text-brand-white mt-2">Pertanyaan Umum</h2>
        </div>

        <div class="space-y-0">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="faq-item py-5 cursor-pointer" onclick="this.classList.toggle('open')">
                <div class="flex items-center justify-between gap-4">
                    <h3 class="font-heading font-semibold text-brand-white text-base"><?php echo e($faq->question); ?></h3>
                    <svg class="faq-chevron w-5 h-5 text-brand-red flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
                <div class="faq-answer mt-3 text-brand-text-gray text-sm leading-relaxed pr-8">
                    <?php echo e($faq->answer); ?>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</section>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    {
      "@type": "Question",
      "name": <?php echo e(json_encode($faq->question)); ?>,
      "acceptedAnswer": {
        "@type": "Answer",
        "text": <?php echo e(json_encode($faq->answer)); ?>

      }
    }<?php echo e(!$loop->last ? ',' : ''); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  ]
}
</script>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\= vscode\Kerinci Motor\resources\views\artikel\index.blade.php ENDPATH**/ ?>