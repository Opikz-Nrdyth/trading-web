<div class="bg-blue-600/20 backdrop-blur-sm p-10 rounded-md relative overflow-hidden">
    <img src="/images/hero-shape-2.svg" alt="hero-shape" class="absolute top-0 right-0 opacity-30 z-0">
    <div class="flex items-center gap-4 w-[90%]">
        <img src="{{ $profile }}" class="rounded-lg w-[75px]" alt="profile">
        <div>
            <p class="font-extrabold text-2xl">{{ $name }}</p>
            <p class="text-gray-400">{{ $position }}.</p>
        </div>
    </div>
    <p class="w-[90%] text-justify mt-5 text-gray-300">“{{ $testimonials }}”</p>
</div>
