<div class="bg-blue-600/20 rounded-md pb-3">
    <img class="w-full rounded-t-md" src="{{ $thumbnail }}" alt="img">
    <div class="flex justify-around my-3">
        <p><i class="fa-solid fa-user"></i> {{ $author }}</p>
        <p><i class="fa-solid fa-calendar-days"></i> {{ $date }}</p>
    </div>
    <div class="px-3">
        <p class="text-2xl font-bold hover:text-blue-600 mb-1">
            {{ $title }}
        </p>
        <p class="text-gray-300">
            {{ $description }}
        </p>
    </div>
</div>
