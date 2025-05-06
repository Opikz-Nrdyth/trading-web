<form wire:submit.prevent="submit" class="flex flex-col">
    <input type="file" wire:model="profile_image" class="my-5" name="User Profile">
    <div wire:loading wire:target="profile_image">Loading Images...</div>
    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['profile_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-red-500"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
    <button type="submit"
        class="bg-primary mt-3 px-4 py-2 rounded-md text-white w-[100px] flex items-center gap-2 justify-center"
        id="submit-btn" wire:loading.attr="disabled">
        <i class="fa-solid fa-spinner animate-rotate" wire:loading></i> <span>Submit</span>
    </button>
</form>

<!-- Flash Message -->
<!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
    <div class="mt-4 text-green-500">
        <?php echo e(session('message')); ?>

    </div>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
<?php /**PATH H:\Bank Project\2025\trading web jadi\resources\views/livewire/upload-profile.blade.php ENDPATH**/ ?>