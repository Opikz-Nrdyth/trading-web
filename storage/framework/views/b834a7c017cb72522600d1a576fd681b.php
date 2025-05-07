<div class="bg-blue-600/20 backdrop-blur-sm p-10 rounded-md relative overflow-hidden">
    <img src="/images/hero-shape-2.svg" alt="hero-shape" class="absolute top-0 right-0 opacity-30 z-0">
    <div class="flex items-center gap-4 w-[90%]">
        <img src="<?php echo e($profile); ?>" class="rounded-lg" alt="profile">
        <div>
            <p class="font-extrabold text-2xl"><?php echo e($name); ?></p>
            <p class="text-gray-400"><?php echo e($position); ?>.</p>
        </div>
    </div>
    <p class="w-[90%] text-justify mt-5 text-gray-300">“<?php echo e($testimonials); ?>”</p>
</div>
<?php /**PATH H:\Bank Project\2025\trading web jadi\resources\views/components/card_testimonial.blade.php ENDPATH**/ ?>