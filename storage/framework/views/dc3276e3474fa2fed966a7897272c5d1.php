<?php $__env->startSection('title', 'Dashboard'); ?>
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
    <?php if (isset($component)) { $__componentOriginal898edd420ecb575a9afea6befcff09ce = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal898edd420ecb575a9afea6befcff09ce = $attributes; } ?>
<?php $component = App\View\Components\Chart::resolve(['bonus' => ''.e($bonus).'','profits' => ''.e($profits).'','members' => ''.e($members).'','wallet' => ''.e($wallet).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('chart'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Chart::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal898edd420ecb575a9afea6befcff09ce)): ?>
<?php $attributes = $__attributesOriginal898edd420ecb575a9afea6befcff09ce; ?>
<?php unset($__attributesOriginal898edd420ecb575a9afea6befcff09ce); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal898edd420ecb575a9afea6befcff09ce)): ?>
<?php $component = $__componentOriginal898edd420ecb575a9afea6befcff09ce; ?>
<?php unset($__componentOriginal898edd420ecb575a9afea6befcff09ce); ?>
<?php endif; ?>

    <div class="bg-base-card text-base-text mt-3">
        <div class="px-3 py-3 border-b-2 border-b-base-text text-2xl font-bold">
            Welcome
        </div>
        <div class="p-3">
            <p class="text-sm">Welcome to <?php echo e(\App\Models\setting::first()->company_name); ?> Member Panel.</p>
            <p class="text-sm mt-3">Your Refferal Link:</p>
            <p class="text-2xl mt-3 text-gray-100"><?php echo e(env('APP_URL')); ?>?reff=<?php echo e(auth()->user()->userData->username ?? ''); ?>

            </p>
        </div>
    </div>

    <div class="grid sm:grid-cols-1 lg:grid-cols-2 gap-2">
        <div class="bg-base-card text-base-text mt-3">
            <div class="px-3 py-3 border-b-2 border-b-base-text text-2xl font-bold">
                Latest News
            </div>
            <div class="py-3">

                <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="#">
                        <div class="py-2 px-3 hover:bg-white flex justify-start gap-3 items-center">
                            <div
                                class="text-white bg-secondary w-[30px] h-[30px] rounded-md flex justify-center items-center">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                            <div>
                                <p class="text-primary"><?php echo e($news['title']); ?></p>
                                <p><?php echo e(\Carbon\Carbon::parse($news['created_at'])->format('d-M-Y, H:i:s')); ?></p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="bg-base-card text-base-text mt-3">
            <div class="px-3 py-3 border-b-2 border-b-base-text text-2xl font-bold">
                Latest Notification
            </div>
            <div class="py-3">
                <?php $__currentLoopData = $notification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="py-2 px-3 hover:bg-white flex justify-start gap-3 items-center">
                        <div
                            class="text-white <?php if($notif['type'] == 'info'): ?> bg-blue-300 <?php elseif($notif['type'] == 'warning'): ?> bg-yellow-300 <?php elseif($notif['type'] == 'error'): ?> bg-red-300 <?php else: ?> bg-gray-300 <?php endif; ?> w-[30px] h-[30px] rounded-md flex justify-center items-center">
                            <i
                                class="fa-solid <?php if($notif['type'] == 'info'): ?> fa-circle-info <?php elseif($notif['type'] == 'warning'): ?> fa-triangle-exclamation <?php elseif($notif['type'] == 'error'): ?> fa-circle-exclamation <?php else: ?> fa-bell <?php endif; ?>">
                            </i>
                        </div>

                        <div>
                            <p class="text-primary"><?php echo e($notif['title'] ?? ''); ?></p>
                            <p><?php echo e(\Carbon\Carbon::parse($notif['created_at'])->format('d-M-Y, H:i:s')); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\Bank Project\2025\trading web jadi\resources\views/welcome.blade.php ENDPATH**/ ?>