<?php $__env->startSection('title', 'Notification'); ?>
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
            Notification
        </div>

        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="py-2 px-3 hover:bg-white flex justify-start gap-3 items-center group">
                <div
                    class="w-[30px] text-white <?php if($notif['type'] == 'info'): ?> bg-blue-300 <?php elseif($notif['type'] == 'warning'): ?> bg-yellow-300 <?php elseif($notif['type'] == 'error'): ?> bg-red-300 <?php else: ?> bg-gray-300 <?php endif; ?> w-[30px] h-[30px] rounded-md flex justify-center items-center">
                    <i
                        class="fa-solid <?php if($notif['type'] == 'info'): ?> fa-circle-info <?php elseif($notif['type'] == 'warning'): ?> fa-triangle-exclamation <?php elseif($notif['type'] == 'error'): ?> fa-circle-exclamation <?php else: ?> fa-bell <?php endif; ?>">
                    </i>
                </div>

                <div class="w-[80%] text-justify">
                    <p class="text-primary font-bold"><?php echo e($notif['title'] ?? ''); ?></p>
                    <p class="text-white group-hover:text-black"><?php echo e($notif['message'] ?? ''); ?></p>
                    <p class="text-xs"><?php echo e(\Carbon\Carbon::parse($notif['created_at'])->format('d-M-Y, H:i:s')); ?></p>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\Bank Project\2025\trading web jadi\resources\views/notification.blade.php ENDPATH**/ ?>