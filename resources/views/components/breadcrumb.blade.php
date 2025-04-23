<section
    class="w-full bg-base-card lg:flex items-center justify-between text-base-text p-5 rounded-md shadow-sm shadow-base-side">
    <div class="text-white text-2xl">{{ $title }}</div>

    <!-- Breadcrumb -->
    <div class="flex gap-3 sm:bg-base-side lg:bg-transparent px-2 py-1 rounded-sm text-sm">
        <a href="/" class="text-white"><i class="fa-solid fa-house"></i> Home</a>


        @foreach ($route as $key => $segment)
            @if ($key < count($route))
                <p><i class="fa-solid fa-angle-right"></i></p>
            @endif
            <a href="{{ url(implode('/', array_slice($route, 0, $key + 1))) }}"
                class="{{ $key == count($route) - 1 ? 'text-gray-400' : 'text-white' }}">
                {{ ucfirst($segment) }}
            </a>
        @endforeach
    </div>
</section>
