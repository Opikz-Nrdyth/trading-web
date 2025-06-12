<header
    class="flex lg:w-[80%] lg:absolute relative z-20 right-0 top-0 h-[70px] shadow-md justify-between px-3 items-center bg-primary text-white transition-all duration-200"
    id="header">
    <button class="text-2xl" id="bars">
        <i class="fa-solid fa-bars-staggered"></i>
    </button>
    <nav class="flex items-center sm:gap-1 lg:gap-4 relative">
        <button class="bg-base-card p-2 rounded">
            <p>
                {{ $convert_currency_price }}
                <span class="bg-secondary px-2 py-1 rounded-md ml-3 font-bold">Real</span>
            </p>
        </button>
        @if ($currency_option)
            <div class="absolute top-11 left-0 bg-base-card">
                @foreach (\App\Models\currency::all() as $currency)
                    <div class="hover:bg-primary flex justify-center gap-1 py-2 px-2"
                        wire:click="currencySelected('{{ $currency->currency_code }}')">
                        <img src="{{ asset(config('services.storage_public') . $currency->currency_logo) }}"
                            width="25px" alt="{{ $currency->currency_code }}">
                        <p>{{ $currency->currency_name }}</p>
                    </div>
                @endforeach
            </div>
        @endif
        {{-- <button class="hover:bg-base-card w-[40px] h-[40px] rounded-md transition-all duration-200">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button> --}}
        <a href="/auth/users/notification">
            <button class="hover:bg-base-card w-[40px] h-[40px] rounded-md transition-all duration-200 relative">
                @if ($notif)
                    <div class="rounded-full w-[10px] h-[10px] bg-red-500 absolute right-1 top-1"></div>
                @endif
                <i class="fa-solid fa-bell"></i>
            </button>
        </a>
        <a href="/auth/users/profile">
            <button class="bg-base-card w-[40px] h-[40px] rounded-full transition-all duration-200">
                <img class="w-full h-full rounded-full"
                    src="@if (auth()->user()->userData->profile_image ?? '' != '') {{ asset(config('services.storage_public') . auth()->user()->userData->profile_image) }}
                @else
                    https://ui-avatars.com/api/?name={{ implode('',array_map(function ($word) {return !empty($word) ? strtoupper($word[0]) : '';}, explode(' ', auth()->user()->name ?? ''))) }}&color=FFFFFF&background=1f1f1f @endif"
                    alt="{{ implode('',array_map(function ($word) {return !empty($word) ? strtoupper($word[0]) : '';}, explode(' ', auth()->user()->name ?? ''))) }}">
            </button>
        </a>
    </nav>
</header>
