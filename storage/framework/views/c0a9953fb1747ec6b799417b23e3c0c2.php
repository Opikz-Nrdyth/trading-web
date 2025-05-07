<div class="bg-blue-600/20 rounded-md pb-3">
    <img class="w-full rounded-t-md" src="<?php echo e($thumbnail); ?>" alt="img">
    <div class="flex justify-around my-3">
        <p><i class="fa-solid fa-user"></i> <?php echo e($author); ?></p>
        <p><i class="fa-solid fa-calendar-days"></i> <?php echo e($date); ?></p>
    </div>
    <div class="px-3">
        <p class="text-2xl font-bold hover:text-blue-600 mb-1">
            <?php echo e($title); ?>

        </p>
        <p class="text-gray-300">
            <?php echo e($description); ?>

        </p>
    </div>
</div>
<?php /**PATH H:\Bank Project\2025\trading web jadi\resources\views/components/card_news.blade.php ENDPATH**/ ?>