<div class="bg-brand-dark-gray border border-white/5 rounded-xl p-5 space-y-6 sticky top-24">
    <h3 class="font-heading font-bold text-brand-white text-base">Filter Kendaraan</h3>

    
    <div>
        <label class="km-label">Ketersediaan</label>
        <div class="flex gap-3">
            <button wire:click="$set('onlyAvailable', true)"
                    class="filter-chip flex-1 text-center <?php echo e($onlyAvailable ? 'filter-chip-active' : ''); ?>">
                Tersedia
            </button>
            <button wire:click="$set('onlyAvailable', false)"
                    class="filter-chip flex-1 text-center <?php echo e(!$onlyAvailable ? 'filter-chip-active' : ''); ?>">
                Semua Unit
            </button>
        </div>
    </div>

    
    <div>
        <label class="km-label">Merek / Model</label>
        <div class="space-y-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['Toyota','Honda','Suzuki','Daihatsu','Mitsubishi','Nissan','Mazda','BMW','Mercedes-Benz','Hyundai','Kia','Ford']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="flex items-center gap-3 cursor-pointer group">
                <input type="checkbox"
                       wire:model.live="brands"
                       value="<?php echo e($brand); ?>"
                       class="w-4 h-4 rounded border-white/20 bg-brand-mid-gray text-brand-red
                              focus:ring-brand-red/30 focus:ring-offset-0">
                <span class="text-sm text-brand-text-gray group-hover:text-white transition-colors"><?php echo e($brand); ?></span>
            </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    
    <div>
        <label class="km-label">Tahun Produksi</label>
        <div class="grid grid-cols-2 gap-2">
            <select wire:model.live="yearMin" class="km-select text-sm">
                <option value="">Dari</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $availableYears->sortDesc(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($y); ?>"><?php echo e($y); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
            <select wire:model.live="yearMax" class="km-select text-sm">
                <option value="">Sampai</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $availableYears; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($y); ?>"><?php echo e($y); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
        </div>
    </div>

    
    <div>
        <label class="km-label">
            Harga
            <span class="text-brand-text-gray font-normal ml-2 text-xs">
                Rp <?php echo e(number_format($priceMin/1000000, 0)); ?>M – Rp <?php echo e($priceMax >= 1000000000 ? '1B+' : number_format($priceMax/1000000, 0).'M'); ?>

            </span>
        </label>
        <div class="space-y-2">
            <input type="range"
                   x-bind:value="$wire.priceMin"
                   x-on:input.debounce.300ms="$wire.set('priceMin', Number($event.target.value))"
                   min="0" max="1000000000" step="5000000"
                   class="w-full accent-brand-red">
            <input type="range"
                   x-bind:value="$wire.priceMax"
                   x-on:input.debounce.300ms="$wire.set('priceMax', Number($event.target.value))"
                   min="0" max="1000000000" step="5000000"
                   class="w-full accent-brand-red">
        </div>
        <div class="flex justify-between text-xs text-brand-text-gray mt-1">
            <span>Rp 0</span><span>Rp 1B+</span>
        </div>
    </div>

    
    <div>
        <label class="km-label">
            Maks. Kilometer
            <span class="text-brand-text-gray font-normal ml-2 text-xs">
                <?php echo e($mileageMax >= 300000 ? 'Semua' : number_format($mileageMax, 0, ',', '.') . ' KM'); ?>

            </span>
        </label>
        <input type="range"
               x-bind:value="$wire.mileageMax"
               x-on:input.debounce.300ms="$wire.set('mileageMax', Number($event.target.value))"
               min="0" max="300000" step="5000"
               class="w-full accent-brand-red">
        <div class="flex justify-between text-xs text-brand-text-gray mt-1">
            <span>0 KM</span><span>300K+ KM</span>
        </div>
    </div>

    
    <div>
        <label class="km-label">Transmisi</label>
        <div class="flex gap-2">
            <button wire:click="$set('transmission', '')"
                    class="filter-chip flex-1 text-center <?php echo e($transmission === '' ? 'filter-chip-active' : ''); ?>">
                Semua
            </button>
            <button wire:click="$set('transmission', 'manual')"
                    class="filter-chip flex-1 text-center <?php echo e($transmission === 'manual' ? 'filter-chip-active' : ''); ?>">
                Manual
            </button>
            <button wire:click="$set('transmission', 'automatic')"
                    class="filter-chip flex-1 text-center <?php echo e($transmission === 'automatic' ? 'filter-chip-active' : ''); ?>">
                Otomatis
            </button>
        </div>
    </div>

    
    <div>
        <label class="km-label">Tipe Kendaraan</label>
        <div class="flex flex-wrap gap-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['sedan' => 'Sedan','suv' => 'SUV','mpv' => 'MPV','city_car' => 'City Car','hatchback' => 'Hatchback','pickup' => 'Pickup','minibus' => 'Minibus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button wire:click="
                    <?php if(in_array('<?php echo e($val); ?>', $bodyTypes)): ?>
                        $set('bodyTypes', array_values(array_diff($bodyTypes, ['<?php echo e($val); ?>'])))
                    <?php else: ?>
                        $set('bodyTypes', array_merge($bodyTypes, ['<?php echo e($val); ?>']))
                    <?php endif; ?>
                    "
                    class="filter-chip text-xs <?php echo e(in_array($val, $bodyTypes) ? 'filter-chip-active' : ''); ?>">
                <?php echo e($label); ?>

            </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    
    <div>
        <label class="km-label">Bahan Bakar</label>
        <div class="space-y-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['petrol' => 'Bensin','diesel' => 'Solar','hybrid' => 'Hybrid','electric' => 'Listrik']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="flex items-center gap-3 cursor-pointer group">
                <input type="checkbox"
                       wire:model.live="fuelTypes"
                       value="<?php echo e($val); ?>"
                       class="w-4 h-4 rounded border-white/20 bg-brand-mid-gray text-brand-red
                              focus:ring-brand-red/30 focus:ring-offset-0">
                <span class="text-sm text-brand-text-gray group-hover:text-white transition-colors"><?php echo e($label); ?></span>
            </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($allColors->count()): ?>
    <div>
        <label class="km-label">Warna</label>
        <div class="flex flex-wrap gap-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $allColors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button wire:click="
                    <?php if(in_array('<?php echo e($color); ?>', $colors)): ?>
                        $set('colors', array_values(array_diff($colors, ['<?php echo e($color); ?>'])))
                    <?php else: ?>
                        $set('colors', array_merge($colors, ['<?php echo e($color); ?>']))
                    <?php endif; ?>
                    "
                    class="filter-chip text-xs <?php echo e(in_array($color, $colors) ? 'filter-chip-active' : ''); ?>">
                <?php echo e($color); ?>

            </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <button wire:click="resetFilters"
            class="w-full py-3 rounded-lg border border-brand-red/40 text-brand-red
                   font-heading font-semibold text-sm hover:bg-brand-red/10 transition-colors">
        Reset Semua Filter
    </button>
</div>
<?php /**PATH D:\= vscode\Kerinci Motor\resources\views\livewire\partials\filter-panel.blade.php ENDPATH**/ ?>