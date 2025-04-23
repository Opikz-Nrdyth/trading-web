<div class="flex justify-start items-center gap-3 p-2 bg-base-card hover:bg-base-text group-odd:">
    <div class="w-[35px] h-[35px]">
        <img src="{{ $profile }}" alt="{{ $user }}" class="w-full h-full">
    </div>
    <div class="text-gray-200 w-[80%] text-xs text-justify hover:text-black">
        {!! Str::limit(strip_tags($comment), 255) !!}
        <p class="text-primary mt-3 text-xs">
            {{ $updatedAt }}
        </p>
    </div>
</div>
