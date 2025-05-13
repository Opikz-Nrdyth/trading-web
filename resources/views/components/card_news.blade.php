<a href="/news/{{ $id }}">
    <div class="bg-blue-600/20 rounded-md pb-3 hover:scale-[102%] cursor-pointer">
        <img class="w-full rounded-t-md" src="{{ $thumbnail }}" alt="img">
        <div class="flex justify-around my-3">
            <p><i class="fa-solid fa-user"></i> {{ $author }}</p>
            <p><i class="fa-solid fa-calendar-days"></i>
                {{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y H:i:s') }}</p>
        </div>
        <div class="px-3">
            <p class="text-2xl font-bold hover:text-blue-600 mb-1">
                {{ $title }}
            </p>
            @php
                $decodedText = html_entity_decode($description); // ubah dari &lt;p&gt; jadi <p>
                $cleanText = strip_tags($decodedText); // hapus tag HTML seperti <p>, <b>, dll.
            @endphp

            <p class="text-gray-300">
                {{ \Illuminate\Support\Str::words($cleanText, 20, '...') }}
            </p>

        </div>
    </div>
</a>
