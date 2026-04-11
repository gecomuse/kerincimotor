<?php $__env->startSection('content'); ?>
<div class="pt-24 pb-20 bg-brand-black min-h-screen">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        
        <nav class="flex items-center gap-2 text-xs text-brand-text-gray mb-6">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-brand-red transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-brand-white">Katalog</span>
        </nav>

        <div class="mb-10">
            <p class="section-label">Temukan</p>
            <h1 class="section-title">Katalog Kendaraan</h1>
            <p class="section-subtitle">Temukan mobil bekas impian Anda dengan filter canggih kami.</p>
        </div>

        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('catalog-filter');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3519220093-0', $__key);

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
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\= vscode\Kerinci Motor\resources\views\catalog\index.blade.php ENDPATH**/ ?>