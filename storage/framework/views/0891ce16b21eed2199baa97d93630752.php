<div class="group mt-3">
    <label for="<?php echo e($name); ?>"
        class="ml-[2.5%] mb-2 block group-focus-within:text-white peer-focus:text-white"><?php echo e($placeholder); ?></label>
    <select id="<?php echo e($name); ?>" name="<?php echo e($name); ?>"
        class="peer w-[95%] ml-[2.5%] py-3 px-2 <?php if($disabled): ?> bg-base-input-disabled <?php else: ?> bg-base-input <?php endif; ?> text-white outline-primary border-none rounded-md"
        value="<?php echo e($value); ?>" <?php if($model): ?> wire:model.defer="<?php echo e($model); ?>" <?php endif; ?>>
        <option value="" disabled selected hidden>Pilih <?php echo e($placeholder); ?></option>
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e(trim($option)); ?>" <?php echo e($value == trim($option) ? 'selected' : ''); ?>>
                <?php echo e(trim($option)); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </select>
</div>
<?php /**PATH H:\Bank Project\2025\trading web jadi\resources\views/components/select.blade.php ENDPATH**/ ?>