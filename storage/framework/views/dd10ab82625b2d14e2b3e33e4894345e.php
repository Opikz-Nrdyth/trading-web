<form wire:submit.prevent="authenticate">
    <div class="mb-4">
        <label class="block text-white mb-2" for="username">
            Email
        </label>
        <input wire:model="email" class="w-full px-2 py-3 rounded bg-white text-xs" id="username" name="username"
            type="text" placeholder="Email" />
        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-red-500"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
    </div>
    <div class="mb-4">
        <label class="block text-white mb-2" for="username">
            Password
        </label>
        <div class="relative">
            <input wire:model="password" class="w-full px-2 py-3 rounded bg-white text-xs" id="password"
                name="password" type=<?php echo e($showPassword ? 'text' : 'password'); ?> placeholder="Password" />
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

            <div class="cursor-pointer absolute right-2 top-3 flex items-center" wire:click="show_password">
                <!--[if BLOCK]><![endif]--><?php if($showPassword): ?>
                    <i class="fa-solid fa-eye-slash"></i>
                <?php else: ?>
                    <i class="fa-solid fa-eye"></i>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>
    <div class="flex items-center mb-4">
        <input class="mr-2" wire:model="remember" id="keep-logged-in" name="keep-logged-in" type="checkbox" />
        <label class="text-white" for="keep-logged-in">
            Keep me logged in
        </label>
    </div>
    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded" type="submit" wire:loading.attr="disabled">
        <i class="fa-solid fa-spinner animate-rotate" wire:loading></i>
        Log in
    </button>
</form>
<?php /**PATH H:\Bank Project\2025\trading web jadi\resources\views/livewire/login.blade.php ENDPATH**/ ?>