<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if ($company_logo)
        <link rel="shortcut icon" href="{{ asset(config('services.storage_public') . $company_logo) }}"
            type="image/x-icon">
    @endif
    {{--
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}"> --}}
    <title>{{ $company_name }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"
        integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#00A8E8", // warna biru cerah (misalnya dari header atau tombol)
                        secondary: "#03ba00", // warna oranye cerah
                        base: "#2f2f2f", // warna gelap untuk latar belakang dashboard
                        "base-text": "#8A8A8F", // warna abu-abu teks
                        "base-card": "#1f1f1f", // warna latar belakang kartu
                        "base-side": "#242a33",
                        "base-button": "#20262e",
                        "base-input": "#252525",
                        "base-input-disabled": "#111111",
                        accent: "#00FF7F", // warna hijau terang untuk elemen interaktif
                    },
                    animation: {
                        rotate: "rotate 2s linear infinite", // Nama animasi 'rotate', durasi 2 detik, rotasi terus menerus
                    },
                    keyframes: {
                        rotate: {
                            "0%": {
                                transform: "rotate(0deg)"
                            }, // Mulai dari 0 derajat
                            "100%": {
                                transform: "rotate(360deg)"
                            }, // Akhirnya 360 derajat
                        },
                    },
                }
            }
        }
    </script>

    <script async src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>
</head>

<body class="bg-[#090e34] min-h-screen text-white font-sans pb-3">

    {{-- Navbar section --}}
    <section id="section-header" class="w-full fixed top-0 z-50 px-5">
        <div class="flex justify-between items-center h-[70px]">
            {{-- Logo & Company --}}
            <div class="flex gap-3 items-center">
                @if ($company_logo)
                    <img class="w-[40px]" src="{{ asset(config('services.storage_public') . $company_logo) }}"
                        alt="Logo">
                @endif
                @if ($company_name)
                    <p class="text-xl font-bold text-white">{{ $company_name }}</p>
                @endif
            </div>

            {{-- Desktop Menu --}}
            <nav class="hidden md:flex gap-3">
                <a href="/" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">Home</a>
                <a href="/about" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">About</a>
                <a href="/#support"
                    class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">Support</a>
                <a href="/news" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">Blog</a>
            </nav>

            {{-- Desktop Auth Buttons --}}
            <div class="hidden md:flex gap-2">
                <a href="/login">
                    <button class="px-4 py-2 rounded-md font-bold text-gray-300 hover:text-white">Sign
                        In</button>
                </a>
                <a href="/register">
                    <button class="bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700 hover:shadow-sm text-white">Sign
                        Up</button>
                </a>
            </div>

            {{-- Mobile Toggle Button --}}
            <button id="menu-toggle" class="md:hidden text-white text-2xl focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        {{-- Mobile Menu (hidden by default) --}}
        <div id="mobile-menu" class="md:hidden hidden flex-col gap-2 pb-4 transition-all duration-200 ease-in-out">
            <a href="/" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">Home</a>
            <a href="/about" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">About</a>
            <a href="/#support" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">Support</a>
            <a href="/news" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">Blog</a>
            <a href="/login">
                <button class="px-4 py-2 rounded-md font-bold text-gray-300 hover:text-white">Sign In</button>
            </a>
            <a href="/register">
                <button class="bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700 hover:shadow-sm text-white">Sign
                    Up</button>
            </a>
        </div>
    </section>

    {{-- main content --}}
    @if ($id)
        <main class="mt-[70px] px-5 flex gap-20 lg:gap-0 flex-col lg:flex-row">
            <div class="{{ count($news) == 0 ? 'w-[100%]' : 'w-[100%] lg:w-[75%]' }}">
                <div class="flex items-center justify-center">
                    <img src="{{ asset(config('services.storage_public') . $newsSearch->thumbnail) }}" class="w-[512px]"
                        alt="news">
                </div>

                <p class="text-4xl font-bold">{{ $newsSearch->title }}</p>

                <div class="flex gap-10">
                    <p>
                        <i class="fa-solid fa-user"></i>
                        <span>{{ $newsSearch->user->name }}</span>
                    </p>
                    <p>
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>{{ $newsSearch->created_at }}</span>
                    </p>
                </div>

                <div class="mt-5">
                    {!! $newsSearch->content !!}
                </div>
            </div>
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 {{ count($news) > 0 ? 'w-[100%] lg:w-[25%]' : 'w-[0%]' }}">
                @foreach ($news as $news)
                    <div class="hover:bg-[#16206b] cursor-pointer p-2">
                        <img src="{{ asset(config('services.storage_public') . $news->thumbnail) }}" alt="thumbnail">
                        <div class="flex gap-3">
                            <p class="text-xs opacity-60">
                                <i class="fa-solid fa-user"></i>
                                <span>{{ $news->user->name }}</span>
                            </p>
                            <p class="text-xs opacity-60">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span>{{ $news->created_at }}</span>
                            </p>
                        </div>
                        <p class="text-xl font-bold hover:text-blue-600">{{ $news->title }}</p>
                        <p class="text-gray-300 text-sm">{!! \Illuminate\Support\Str::words(strip_tags($news->content), 20, '...') !!}</p>
                    </div>
                @endforeach
            </div>
        </main>
    @endif

    @if (!$id)
        <main class="mt-[70px] px-5">
            <div class="grid grid-cols-1 md:grid-cols-3 px-10 gap-5 mt-16">
                @foreach ($news as $news)
                    <x-card_news id="{{ $news->id }}"
                        thumbnail="{{ asset(config('services.storage_public') . $news->thumbnail) }}"
                        author="{{ $news->user->name }}" date="{{ $news->created_at }}" title="{{ $news->title }}"
                        description="{{ $news->content }}" />
                @endforeach
            </div>
        </main>
    @endif

    <!-- Foooter -->
    <section>
        <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
            <nav class="flex flex-wrap justify-center -mx-5 -my-2">
                <div class="px-5 py-2">
                    <a href="#" class="text-base leading-6 text-gray-300 hover:text-gray-500">
                        About
                    </a>
                </div>
                <div class="px-5 py-2">
                    <a href="#" class="text-base leading-6 text-gray-300 hover:text-gray-500">
                        Blog
                    </a>
                </div>
                <div class="px-5 py-2">
                    <a href="#" class="text-base leading-6 text-gray-300 hover:text-gray-500">
                        Team
                    </a>
                </div>
                <div class="px-5 py-2">
                    <a href="#" class="text-base leading-6 text-gray-300 hover:text-gray-500">
                        Pricing
                    </a>
                </div>
                <div class="px-5 py-2">
                    <a href="#" class="text-base leading-6 text-gray-300 hover:text-gray-500">
                        Contact
                    </a>
                </div>
                <div class="px-5 py-2">
                    <a href="#" class="text-base leading-6 text-gray-300 hover:text-gray-500">
                        Terms
                    </a>
                </div>
            </nav>
            <div class="flex justify-center mt-8 space-x-6">
                <a href="#" class="text-gray-400 hover:text-gray-300">
                    <span class="sr-only">Facebook</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-300">
                    <span class="sr-only">Instagram</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-300">
                    <span class="sr-only">Twitter</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                        </path>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-300">
                    <span class="sr-only">GitHub</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-300">
                    <span class="sr-only">Dribbble</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
            <p class="mt-8 text-base leading-6 text-center text-gray-400">
                © {{ date('Y') }} Opik Studio, Inc. All rights reserved.
            </p>
        </div>
    </section>

    <script src="{{ asset('js/landing.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
