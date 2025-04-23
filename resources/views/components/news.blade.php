<a href="/news/{{ $id }}">
    <div class="flex justify-start items-center gap-3 p-2 bg-base-card hover:bg-base-text group-odd:">
        <div class="w-[150px] h-[150px]">
            <img src="{{ $thubmnail }}" alt="{{ $title }}" class="w-full h-full">
        </div>
        <div class="text-gray-200 w-[80%] text-xs text-justify hover:text-black">
            {!! Str::limit(strip_tags($description), 1000) !!}
            <p class="text-primary mt-3 text-xs">
                {{ $updated_at }}
            </p>
        </div>
    </div>

</a>
