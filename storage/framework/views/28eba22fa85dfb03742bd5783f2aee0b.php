<?php $__env->startSection('title', 'Setting - Profile'); ?>
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
    <div class="bg-base-card text-base-text py-3 px-3 mt-5">
        <div class="border-b-2 border-b-base-text p-5">
            Profile Images
        </div>
        <div>
            <p>This page allows you to upload your personal photo to your profile.</p>

            <p>Terms of photos</p>

            <ul class="list-disc ml-10">
                <li>Image file formats are allowed only: jpg, jpeg, png and gif.</li>
                <li>Image dimensions will automatically be resize max width 1024 pixel.</li>
                <li>Image file size should not be more than 1 MB</li>
            </ul>
            <img class="w-[70px] h-[70px] mt-3 rounded-full"
                src="<?php if(auth()->user()->userData->profile_image != ''): ?> <?php echo e(asset(config('services.storage_public') . auth()->user()->userData->profile_image)); ?>

            <?php else: ?>
                https://ui-avatars.com/api/?name=<?php echo e(implode('',array_map(function ($word) {return strtoupper($word[0]);}, explode(' ', auth()->user()->name ?? '')))); ?>&color=FFFFFF&background=00a8e8 <?php endif; ?>"
                alt="<?php echo e(implode('',array_map(function ($word) {return strtoupper($word[0]);}, explode(' ', auth()->user()->name ?? '')))); ?>">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('UploadProfile', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-4196777132-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\Bank Project\2025\trading web jadi\resources\views/SettingFotoProfile.blade.php ENDPATH**/ ?>