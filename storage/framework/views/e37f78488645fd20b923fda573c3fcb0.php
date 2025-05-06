<?php $__env->startSection('title', 'Last News'); ?>
<?php $__env->startSection('route', end($route)); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal269900abaed345884ce342681cdc99f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269900abaed345884ce342681cdc99f6 = $attributes; } ?>
<?php $component = App\View\Components\Breadcrumb::resolve(['route' => $route,'title' => ''.e($title).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Breadcrumb::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal269900abaed345884ce342681cdc99f6)): ?>
<?php $attributes = $__attributesOriginal269900abaed345884ce342681cdc99f6; ?>
<?php unset($__attributesOriginal269900abaed345884ce342681cdc99f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal269900abaed345884ce342681cdc99f6)): ?>
<?php $component = $__componentOriginal269900abaed345884ce342681cdc99f6; ?>
<?php unset($__componentOriginal269900abaed345884ce342681cdc99f6); ?>
<?php endif; ?>
    <div class="bg-base-card py-3 px-3 text-base-text mt-5">
        <div class="border-b-2 border-b-base-text p-5">
            Recent posts
        </div>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if (isset($component)) { $__componentOriginal3d452745d4a5eb38b6bef38907945e76 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3d452745d4a5eb38b6bef38907945e76 = $attributes; } ?>
<?php $component = App\View\Components\News::resolve(['id' => ''.e($d['id']).'','title' => ''.e($d['title']).'','thubmnail' => ''.e($d['thumbnail']).'','description' => ''.$d['content'].'','updatedat' => ''.e($d['updated_at']).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('news'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\News::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3d452745d4a5eb38b6bef38907945e76)): ?>
<?php $attributes = $__attributesOriginal3d452745d4a5eb38b6bef38907945e76; ?>
<?php unset($__attributesOriginal3d452745d4a5eb38b6bef38907945e76); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3d452745d4a5eb38b6bef38907945e76)): ?>
<?php $component = $__componentOriginal3d452745d4a5eb38b6bef38907945e76; ?>
<?php unset($__componentOriginal3d452745d4a5eb38b6bef38907945e76); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\Bank Project\2025\trading web jadi\resources\views/LastNews.blade.php ENDPATH**/ ?>