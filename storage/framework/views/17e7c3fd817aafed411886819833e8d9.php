<header
    class="flex lg:w-[80%] lg:absolute relative z-20 right-0 top-0 h-[70px] shadow-md justify-between px-3 items-center bg-primary text-white transition-all duration-200"
    id="header">
    <button class="text-2xl" id="bars">
        <i class="fa-solid fa-bars-staggered"></i>
    </button>
    <nav class="flex items-center sm:gap-1 lg:gap-4 relative">
        <button class="bg-base-card p-2 rounded">
            <p>
                <?php echo e($convert_currency_price); ?>

                <span class="bg-secondary px-2 py-1 rounded-md ml-3 font-bold">Real</span>
            </p>
        </button>
        <!--[if BLOCK]><![endif]--><?php if($currency_option): ?>
            <div class="absolute top-11 left-0 bg-base-card">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = \App\Models\currency::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="hover:bg-primary flex justify-center gap-1 py-2 px-2"
                        wire:click="currencySelected('<?php echo e($currency->currency_code); ?>')">
                        <img src="<?php echo e(asset(config('services.storage_public') . $currency->currency_logo)); ?>"
                            width="25px" alt="<?php echo e($currency->currency_code); ?>">
                        <p><?php echo e($currency->currency_name); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        
        <a href="/notification">
            <button class="hover:bg-base-card w-[40px] h-[40px] rounded-md transition-all duration-200 relative">
                <!--[if BLOCK]><![endif]--><?php if($notif): ?>
                    <div class="rounded-full w-[10px] h-[10px] bg-red-500 absolute right-1 top-1"></div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <i class="fa-solid fa-bell"></i>
            </button>
        </a>
        <a href="/profile">
            <button class="bg-base-card w-[40px] h-[40px] rounded-full transition-all duration-200">
                <img class="w-full h-full rounded-full"
                    src="<?php if(auth()->user()->userData->profile_image ?? '' != ''): ?> <?php echo e(asset(config('services.storage_public') . auth()->user()->userData->profile_image)); ?>

                <?php else: ?>
                    https://ui-avatars.com/api/?name=<?php echo e(implode('',array_map(function ($word) {return strtoupper($word[0]);}, explode(' ', auth()->user()->name ?? '')))); ?>&color=FFFFFF&background=1f1f1f <?php endif; ?>"
                    alt="<?php echo e(implode('',array_map(function ($word) {return strtoupper($word[0]);}, explode(' ', auth()->user()->name ?? '')))); ?>">
            </button>
        </a>
    </nav>
</header>
<?php /**PATH H:\Bank Project\2025\trading web jadi\resources\views/livewire/header.blade.php ENDPATH**/ ?>