<?php $__env->startSection('seo_title', $post->getSeoTitle()); ?>
<?php $__env->startSection('seo_description', $post->getSeoDescription()); ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->getSeoKeywords()): ?>
<?php $__env->startSection('seo_keywords', $post->getSeoKeywords()); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->getMetaImageUrl()): ?>
<?php $__env->startSection('og_image', $post->getMetaImageUrl()); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php $__env->startPush('meta'); ?>
<meta property="og:type" content="article">
<meta property="og:title" content="<?php echo e($post->getSeoTitle()); ?>">
<meta property="og:description" content="<?php echo e($post->getSeoDescription()); ?>">
<meta property="og:url" content="<?php echo e(route('artikel.show', $post->slug)); ?>">
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->getMetaImageUrl()): ?>
<meta property="og:image" content="<?php echo e($post->getMetaImageUrl()); ?>">
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": <?php echo e(json_encode($post->title)); ?>,
  "description": <?php echo e(json_encode($post->getSeoDescription())); ?>,
  "url": "<?php echo e(route('artikel.show', $post->slug)); ?>",
  <?php if($post->getThumbnailUrl()): ?>
  "image": "<?php echo e($post->getThumbnailUrl()); ?>",
  <?php endif; ?>
  "datePublished": "<?php echo e($post->published_at?->toIso8601String()); ?>",
  "dateModified": "<?php echo e($post->updated_at->toIso8601String()); ?>",
  "author": {"@type": "Organization", "name": "Kerinci Motor"},
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
.prose-blog h2 { font-family: var(--font-heading, sans-serif); font-weight: 700; font-size: 1.5rem; color: #fff; margin: 2rem 0 0.75rem; }
.prose-blog h3 { font-family: var(--font-heading, sans-serif); font-weight: 600; font-size: 1.2rem; color: #e5e7eb; margin: 1.5rem 0 0.5rem; }
.prose-blog p { color: #9ca3af; line-height: 1.85; margin-bottom: 1.25rem; }
.prose-blog ul, .prose-blog ol { color: #9ca3af; margin-bottom: 1.25rem; padding-left: 1.5rem; }
.prose-blog li { margin-bottom: 0.4rem; line-height: 1.75; }
.prose-blog ul li { list-style-type: disc; }
.prose-blog ol li { list-style-type: decimal; }
.prose-blog a { color: #ef4444; text-decoration: underline; }
.prose-blog blockquote { border-left: 3px solid #ef4444; padding-left: 1rem; color: #9ca3af; font-style: italic; margin: 1.5rem 0; }
.prose-blog code { background: rgba(255,255,255,0.08); padding: 2px 6px; border-radius: 4px; font-size: 0.85em; }
.prose-blog strong { color: #e5e7eb; }
</style>


<div class="pt-28 pb-0 px-4 bg-brand-dark-gray">
    <div class="max-w-3xl mx-auto">
        <nav class="flex items-center gap-2 text-xs text-brand-text-gray mb-6">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-brand-white transition-colors">Beranda</a>
            <span>/</span>
            <a href="<?php echo e(route('artikel.index')); ?>" class="hover:text-brand-white transition-colors">Artikel</a>
            <span>/</span>
            <span class="text-brand-silver truncate max-w-xs"><?php echo e($post->title); ?></span>
        </nav>
    </div>
</div>


<article class="py-8 px-4 bg-brand-dark-gray">
    <div class="max-w-3xl mx-auto">
        
        <header class="mb-8">
            <span class="inline-block bg-brand-red/20 text-brand-red text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4">
                <?php echo e($post->category); ?>

            </span>
            <h1 class="font-heading font-extrabold text-3xl md:text-4xl text-brand-white leading-tight mb-4">
                <?php echo e($post->title); ?>

            </h1>
            <p class="text-brand-text-gray text-lg mb-6"><?php echo e($post->excerpt); ?></p>
            <div class="flex flex-wrap items-center gap-4 text-xs text-brand-text-gray border-t border-white/5 pt-4">
                <span>
                    <svg class="w-3.5 h-3.5 inline-block mr-1 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <?php echo e($post->published_at?->locale('id')->isoFormat('D MMMM YYYY')); ?>

                </span>
                <span>·</span>
                <span>
                    <svg class="w-3.5 h-3.5 inline-block mr-1 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <?php echo e($post->read_time); ?> menit baca
                </span>
            </div>
        </header>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->getThumbnailUrl()): ?>
        <div class="rounded-2xl overflow-hidden mb-8 aspect-video">
            <img src="<?php echo e($post->getThumbnailUrl()); ?>"
                 alt="<?php echo e($post->title); ?>"
                 class="w-full h-full object-cover">
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div class="prose-blog">
            <?php echo $post->content; ?>

        </div>

        
        <div class="mt-12 pt-8 border-t border-white/5">
            <a href="<?php echo e(route('artikel.index')); ?>"
               class="inline-flex items-center gap-2 text-brand-text-gray hover:text-brand-white transition-colors text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                Kembali ke Artikel
            </a>
        </div>
    </div>
</article>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\= vscode\Kerinci Motor\resources\views\artikel\show.blade.php ENDPATH**/ ?>