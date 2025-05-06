<a href="/news/<?php echo e($id); ?>">
    <div class="flex justify-start items-center gap-3 p-2 bg-base-card hover:bg-base-text group-odd:">
        <div class="w-[150px] h-[150px]">
            <img src="<?php echo e($thubmnail); ?>" alt="<?php echo e($title); ?>" class="w-full h-full">
        </div>
        <div class="text-gray-200 w-[80%] text-xs text-justify hover:text-black">
            <?php echo Str::limit(strip_tags($description), 1000); ?>

            <p class="text-primary mt-3 text-xs">
                <?php echo e($updated_at); ?>

            </p>
        </div>
    </div>

</a>
<?php /**PATH H:\Bank Project\2025\trading web jadi\resources\views/components/news.blade.php ENDPATH**/ ?>