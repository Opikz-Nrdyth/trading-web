<?php $__env->startSection('title', 'KYC'); ?>
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
    <?php if($kycStatus == 'pending'): ?>
        <div class="w-full mx-auto my-4 bg-base-card border rounded-lg shadow-lg">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-white">Waiting for KYC Verification</h2>
                <p class="text-base-text mt-2">Your document is being processed. Please wait for the admin to verify.
                </p>
                <div class="flex items-center mt-4">
                    <div class="w-10 h-10 bg-yellow-500 text-white rounded-full flex items-center justify-center">
                        <i class="fas fa-clock"></i> <!-- Gunakan icon sesuai kebutuhan -->
                    </div>
                    <span class="ml-4 text-yellow-500 font-semibold">Status: Pending</span>
                </div>
            </div>
        </div>
    <?php elseif($kycStatus == 'success'): ?>
        <div class="w-full mx-auto my-4 bg-base-card border rounded-lg shadow-lg">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-white">KYC Accepted</h2>
                <p class="text-base-text mt-2">Your documents have been successfully verified by the admin. Thank you for
                    completing the KYC process.</p>
                <div class="flex items-center mt-4">
                    <div class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle"></i> <!-- Gunakan icon sesuai kebutuhan -->
                    </div>
                    <span class="ml-4 text-green-500 font-semibold">Status: Approved</span>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="bg-base-card py-3 w-full mt-5 px-3 text-base-text">
            <div class="border-b-2 border-b-base-text p-5">
                Send Verification
            </div>
            <?php if($kycStatus == 'failed'): ?>
                <p class="text-red-500">Your account verification request was rejected! Please resubmit</p>
            <?php else: ?>
                Please complete the verification form below and send it to get full access to your account.
            <?php endif; ?>

            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('KycForm', ['fullName' => ''.e($kycData->user->name ?? '').'','full_name' => ''.e($kycData->user->name ?? '').'','address' => ''.e($kycData->user->userData->address ?? '').'']);

$__html = app('livewire')->mount($__name, $__params, 'lw-229445260-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            <p class="text-xs mt-5">Upload only file jpg, png, gif. Max size upload 1 MB.</p>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\Bank Project\2025\trading web jadi\resources\views/kyc.blade.php ENDPATH**/ ?>