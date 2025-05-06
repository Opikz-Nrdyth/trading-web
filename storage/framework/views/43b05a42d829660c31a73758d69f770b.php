<section
    class="w-full bg-base-card lg:flex items-center justify-between text-base-text p-5 rounded-md shadow-sm shadow-base-side">
    <div class="text-white text-2xl"><?php echo e($title); ?></div>

    <!-- Breadcrumb -->
    <div class="flex gap-3 sm:bg-base-side lg:bg-transparent px-2 py-1 rounded-sm text-sm">
        <a href="/" class="text-white"><i class="fa-solid fa-house"></i> Home</a>


        <?php $__currentLoopData = $route; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $segment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($key < count($route)): ?>
                <p><i class="fa-solid fa-angle-right"></i></p>
            <?php endif; ?>
            <a href="<?php echo e(url(implode('/', array_slice($route, 0, $key + 1)))); ?>"
                class="<?php echo e($key == count($route) - 1 ? 'text-gray-400' : 'text-white'); ?>">
                <?php echo e(ucfirst($segment)); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php /**PATH H:\Bank Project\2025\trading web jadi\resources\views/components/breadcrumb.blade.php ENDPATH**/ ?>