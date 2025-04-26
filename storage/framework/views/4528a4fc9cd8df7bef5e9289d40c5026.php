<div class="group mt-3">
    <label for="<?php echo e($name); ?>"
        class="ml-[2.5%] mb-2 block group-focus-within:text-white peer-focus:text-white"><?php echo e($label); ?></label>

    <!--[if BLOCK]><![endif]--><?php if($type == 'text-area'): ?>
        <textarea id="<?php echo e($name); ?>" name="<?php echo e($name); ?>" <?php if($disabled): ?> disabled <?php endif; ?>
            placeholder="<?php echo e($placeholder); ?>" <?php if($model): ?> wire:model.defer="<?php echo e($model); ?>" <?php endif; ?>
            class="peer w-[95%] ml-[2.5%] py-3 px-2 <?php if($disabled): ?> bg-base-input-disabled <?php else: ?> bg-base-input <?php endif; ?> text-white outline-primary border-none rounded-md"><?php echo e($value); ?></textarea>
    <?php else: ?>
        <input type="<?php echo e($type); ?>" id="<?php echo e($name); ?>" name="<?php echo e($name); ?>"
            placeholder="<?php echo e($placeholder); ?>" <?php if($disabled): ?> disabled <?php endif; ?>
            value="<?php echo e($value); ?>"
            <?php if($model): ?> wire:model.defer="<?php echo e($model); ?>" <?php endif; ?>
            class="peer w-[95%] ml-[2.5%] py-3 px-2 <?php if($disabled): ?> bg-base-input-disabled <?php else: ?> bg-base-input <?php endif; ?> text-white outline-primary border-none rounded-md">
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH H:\Bank Project\2025\trading web jadi\resources\views/components/input.blade.php ENDPATH**/ ?>