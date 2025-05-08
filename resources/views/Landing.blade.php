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

    <style>
        .orbit-container {
            position: relative;
            width: 500px;
            height: 500px;
            margin: 0 auto;
        }

        .central-object {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .orbiting-object {
            position: absolute;
            transform-origin: center;
            will-change: transform;
        }

        .orbit-path {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px dashed rgba(0, 0, 0, 0.2);
            border-radius: 50%;
        }

        .object-image {
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .object-image:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        }
    </style>


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
                <a href="/" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">About</a>
                <a href="/" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">Support</a>
                <a href="/" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">Blog</a>
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
            <a href="/" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">About</a>
            <a href="/" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">Support</a>
            <a href="/" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">Blog</a>
            <a href="/login">
                <button class="px-4 py-2 rounded-md font-bold text-gray-300 hover:text-white">Sign In</button>
            </a>
            <a href="/register">
                <button class="bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700 hover:shadow-sm text-white">Sign
                    Up</button>
            </a>
        </div>
    </section>

    {{-- landing --}}
    <section class="h-screen w-full relative pt-[70px] overflow-hidden bg-gradient-to-t from-[#090e34] to-[#162173]">
        <div class="overflow-hidden w-full h-full">
            {{-- hero section --}}
            <img src="{{ asset('images/hero-shape-1.svg') }}" class="absolute left-0 top-0 opacity-30"
                alt="hero-section">
            <img src="{{ asset('images/hero-shape-4.svg') }}"
                class="absolute -right-40 -top-32 md:right-0 md:top-0 opacity-30" alt="hero-section">
            <img src="{{ asset('images/hero-shape-3.svg') }}" class="absolute left-0 bottom-0 opacity-30"
                alt="hero-section">
        </div>

        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-center w-full md:max-w-xl md:px-4">
            <p class="text-3xl md:text-4xl font-bold mb-2 text-white">Tailwind CSS Template for Crypto, ICO and Web3</p>
            <p class="text-gray-300 mt-3">
                Crypto Currency, Blockchain, ICO, Web3 related website template crafted with Tailwind CSS. Comes with
                all
                essential UI components and pages to launch complete website or landing page for anything that related
                to Crypto, Blockchain and Web3.
            </p>

            <div class="flex gap-3 justify-center mt-5">
                <div class="w-[35px] h-[35px] rounded-full bg-white flex justify-center items-center group">
                    <img class="w-[25px] h-[25px] group-hover:-translate-y-0.5 group-hover:shadow-sm"
                        src="{{ asset('images/bitcoin-btc-logo.svg') }}" alt="bitcoin">
                </div>
                <div class="w-[35px] h-[35px] rounded-full bg-white flex justify-center items-center group">
                    <img class="w-[25px] h-[25px] group-hover:-translate-y-0.5 group-hover:shadow-sm"
                        src="{{ asset('images/ethereum-eth-logo.svg') }}" alt="ethereum">
                </div>
                <div class="w-[35px] h-[35px] rounded-full bg-white flex justify-center items-center group">
                    <img class="w-[25px] h-[25px] group-hover:-translate-y-0.5 group-hover:shadow-sm"
                        src="{{ asset('images/tron-trx-logo.svg') }}" alt="tron">
                </div>
                <div class="w-[35px] h-[35px] rounded-full bg-white flex justify-center items-center group">
                    <img class="w-[25px] h-[25px] group-hover:-translate-y-0.5 group-hover:shadow-sm"
                        src="{{ asset('images/solana-sol-logo.svg') }}" alt="solana">
                </div>
                <div class="w-[35px] h-[35px] rounded-full bg-white flex justify-center items-center group">
                    <img class="w-[25px] h-[25px] group-hover:-translate-y-0.5 group-hover:shadow-sm"
                        src="{{ asset('images/xrp-xrp-logo.svg') }}" alt="xrp">
                </div>
            </div>

            <a href="">
                <button
                    class="bg-blue-600 hover:bg-blue-700 rounded-md font-bold w-[120px] translate-y-5 text-center py-2 mt-5">Get
                    Started</button>
            </a>
        </div>

    </section>

    <x-line />

    {{-- Feature --}}
    <section class="flex flex-col items-center w-full text-center pb-5">
        <p class="title text-2xl md:text-4xl font-bold">Best Features</p>
        <p class="text-gray-300 md:max-w-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
            sed congue
            arcu, In et
            dignissim quam
            condimentum vel.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 px-10 gap-5 gap-y-10 mt-16">
            <x-card src="/images/shield-svgrepo-com.svg" title="Safe & Secure"
                description="Lorem ipsum dolor sit amet consectetur elit, sed do eiusmod tempor labore labore labore et dolor" />
            <x-card src="/images/gift-svgrepo-com.svg" title="Early Bonus"
                description="Lorem ipsum dolor sit amet consectetur elit, sed do eiusmod tempor labore labore labore et dolor" />
            <x-card src="/images/access-internet-online-svgrepo-com.svg" title="Universal Access"
                description="Lorem ipsum dolor sit amet consectetur elit, sed do eiusmod tempor labore labore labore et dolor" />
            <x-card src="/images/data-storage-lock-solid-svgrepo-com.svg" title="Secure Storage"
                description="Lorem ipsum dolor sit amet consectetur elit, sed do eiusmod tempor labore labore labore et dolor" />
            <x-card src="/images/wallet-svgrepo-com.svg" title="Low Cost"
                description="Lorem ipsum dolor sit amet consectetur elit, sed do eiusmod tempor labore labore labore et dolor" />
            <x-card src="/images/focus-svgrepo-com.svg" title="Several Profit"
                description="Lorem ipsum dolor sit amet consectetur elit, sed do eiusmod tempor labore labore labore et dolor" />
        </div>
    </section>

    {{-- Crypto trading at its best --}}
    <section class="flex flex-col md:flex-row items-center justify-around w-full text-start pb-5 relative">
        <div class="orbit-container rounded-xl">
            <!-- Central Object -->
            <div class="central-object">
                <img src="/images/crypto2x.png" alt="Central Object" class="object-image w-36 h-36">
            </div>

            <!-- Visual orbit path -->
            <div class="orbit-path w-80 h-80"></div>

            <!-- Orbiting Objects Container -->
            <div id="orbiting-objects" class="w-full h-full"></div>
        </div>

        <div class="px-5 md:px-0">
            <p class="title text-2xl md:text-4xl font-bold">Crypto trading at its best</p>
            <p class="text-gray-300 md:max-w-lg">Trade and manage 70+ cryptoassets on a trusted global platform that
                offers top-tier security, powerful tools, user-friendly features, and fixed transparent fees.</p>
            <p class="mt-5">*Other fees apply</p>
            <a href="/login">
                <button
                    class="mt-10 border border-blue-600 hover:bg-blue-700 px-4 py-3 rounded-md font-bold text-blue-600 hover:text-white transition-all duration-200 ease-in-out">Invest
                    in
                    Crypto</button>
            </a>
        </div>

        <div>
            <img src="/images/hero-shape-5.svg" alt="hero shape" class="w-[350px] absolute right-0 bottom-24">
        </div>
    </section>

    <x-line />

    {{-- Testimonials --}}
    <section class="flex flex-col items-center w-full text-start pb-5">
        <p class="title text-2xl md:text-4xl font-bold">What Our Client Say's</p>
        <p class="text-gray-300 md:max-w-lg text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
            sed congue
            arcu, In et
            dignissim quam
            condimentum vel.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 px-20 gap-5 mt-16">
            <x-card_testimonial
                profile="https://crypto-tailwind.preview.uideck.com/src/images/testimonials/image-01.jpg"
                name="Json Keys" position="CEO & Founder @ Dreampeet"
                testimonials="I believe in lifelong learning and Learn. is a great place to learn from experts. I've learned a lot and recommend it to all my friends and familys." />
            <x-card_testimonial
                profile="https://crypto-tailwind.preview.uideck.com/src/images/testimonials/image-01.jpg"
                name="Json Keys" position="CEO & Founder @ Dreampeet"
                testimonials="I believe in lifelong learning and Learn. is a great place to learn from experts. I've learned a lot and recommend it to all my friends and familys." />
            <x-card_testimonial
                profile="https://crypto-tailwind.preview.uideck.com/src/images/testimonials/image-01.jpg"
                name="Json Keys" position="CEO & Founder @ Dreampeet"
                testimonials="I believe in lifelong learning and Learn. is a great place to learn from experts. I've learned a lot and recommend it to all my friends and familys." />
            <x-card_testimonial
                profile="https://crypto-tailwind.preview.uideck.com/src/images/testimonials/image-01.jpg"
                name="Json Keys" position="CEO & Founder @ Dreampeet"
                testimonials="I believe in lifelong learning and Learn. is a great place to learn from experts. I've learned a lot and recommend it to all my friends and familys." />
        </div>
    </section>

    <x-line />

    {{-- Last News --}}
    <section class="flex flex-col items-center w-full text-start pb-5">
        <p class="title text-2xl md:text-4xl font-bold">Recent News & Blogs</p>
        <p class="text-gray-300 md:max-w-lg text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
            sed congue
            arcu, In et
            dignissim quam
            condimentum vel.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 px-10 gap-5 mt-16">
            <x-card_news thumbnail="https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg"
                author="Admin" date="27 April 2025" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit."
                description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel." />
            <x-card_news thumbnail="https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg"
                author="Admin" date="27 April 2025" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit."
                description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel." />
            <x-card_news thumbnail="https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg"
                author="Admin" date="27 April 2025" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit."
                description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel." />
            <x-card_news thumbnail="https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg"
                author="Admin" date="27 April 2025" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit."
                description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel." />
            <x-card_news thumbnail="https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg"
                author="Admin" date="27 April 2025" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit."
                description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel." />
            <x-card_news thumbnail="https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg"
                author="Admin" date="27 April 2025" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit."
                description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel." />
        </div>
    </section>

    <x-line />

    {{-- FAQ --}}
    <section class="flex flex-col items-center w-full text-start pb-5">
        <p class="title text-2xl md:text-4xl font-bold">Frequently Asked Questions</p>
        <p class="text-gray-300 md:max-w-lg text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
            sed congue
            arcu, In et
            dignissim quam
            condimentum vel.</p>

        <div id="accordion-open" data-accordion="open" class="w-[90%] md:w-[50%] mt-10">
            <h2 id="accordion-open-heading-1">
                <button type="button"
                    class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-300 border border-gray-300 focus:ring-gray-200 gap-3"
                    data-accordion-target="#accordion-open-body-1" aria-expanded="false"
                    aria-controls="accordion-open-body-1">
                    <span class="flex items-center gap-1">
                        <i class="fa-solid fa-circle-question"></i>
                        What are the differences between Flowbite and Tailwind UI?
                    </span>
                    <i class="fa-solid fa-caret-down"></i>
                </button>
            </h2>
            <div id="accordion-open-body-1" class="hidden" aria-labelledby="accordion-open-heading-1">
                <div class="p-5 border border-t-0 border-gray-200">
                    <p class="mb-2 text-gray-300">The main difference is that the core components
                        from Flowbite are open source under the MIT license, whereas Tailwind UI is a paid product.
                        Another difference is that Flowbite relies on smaller and standalone components, whereas
                        Tailwind UI offers sections of pages.</p>
                </div>
            </div>

            <h2 id="accordion-open-heading-2">
                <button type="button"
                    class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-300 border border-gray-300 focus:ring-gray-200 gap-3"
                    data-accordion-target="#accordion-open-body-2" aria-expanded="false"
                    aria-controls="accordion-open-body-2">
                    <span class="flex items-center gap-1">
                        <i class="fa-solid fa-circle-question"></i>
                        What are the differences between Flowbite and Tailwind UI?
                    </span>
                    <i class="fa-solid fa-caret-down"></i>
                </button>
            </h2>
            <div id="accordion-open-body-2" class="hidden" aria-labelledby="accordion-open-heading-2">
                <div class="p-5 border border-t-0 border-gray-200">
                    <p class="mb-2 text-gray-300">The main difference is that the core components
                        from Flowbite are open source under the MIT license, whereas Tailwind UI is a paid product.
                        Another difference is that Flowbite relies on smaller and standalone components, whereas
                        Tailwind UI offers sections of pages.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Contack us --}}
    <section
        class="flex flex-col md:flex-row justify-around items-center w-full text-start px-16 pb-5 relative overflow-hidden">
        <div>
            <p class="title text-2xl md:text-4xl font-bold">Let's talk about your problem.</p>
            <p class="text-gray-300 md:max-w-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Nunc sed congue arcu, In et dignissim quam condimentum vel.</p>
            <div class="grid grid-cols-2 gap-5 mt-5">
                <div>
                    <p class="font-bold text-xl">Our Location</p>
                    <p class="text-gray-300">401 Broadway, 24th Floor, Orchard Cloud View, London</p>
                </div>
                <div>
                    <p class="font-bold text-xl">Email Address</p>
                    <p class="text-gray-300">info@yourdomain.com</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-5 mt-5">
                <div>
                    <p class="font-bold text-xl">Phone Number</p>
                    <p class="text-gray-300">+990 846 73644</p>
                </div>
                <div>
                    <p class="font-bold text-xl">How Can We Help?</p>
                    <p class="text-gray-300">Tell us your problem we will get back to you ASAP.</p>
                </div>
            </div>
        </div>
        <div class="hidden md:block">
            <img class="w-[512px]" src="/images/animation-1.png" alt="animation-1">
        </div>

        <div>
            <img src="/images/hero-shape-3.svg" alt="hero shape" class="absolute left-0 top-5 opacity-30">
        </div>
    </section>

    <x-line />

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orbitContainer = document.querySelector('.orbit-container');
            const orbitingObjectsContainer = document.getElementById('orbiting-objects');
            const centerX = orbitContainer.offsetWidth / 2;
            const centerY = orbitContainer.offsetHeight / 2;
            const orbitRadius = 160; // Same radius for all objects

            // Orbiting objects data
            const objects = [{
                    speed: 0.005,
                    size: 16,
                    image: '/images/bitcoin-btc-logo.svg',
                    color: ''
                },
                {
                    speed: 0.005,
                    size: 16,
                    image: '/images/ethereum-eth-logo.svg',
                    color: ''
                },
                {
                    speed: 0.005,
                    size: 16,
                    image: '/images/solana-sol-logo.svg',
                    color: ''
                },
                {
                    speed: 0.005,
                    size: 16,
                    image: '/images/tron-trx-logo.svg',
                    color: ''
                },
                {
                    speed: 0.005,
                    size: 16,
                    image: '/images/tether-usdt-logo.svg',
                    color: ''
                },
                {
                    speed: 0.005,
                    size: 16,
                    image: '/images/bnb-bnb-logo.svg',
                    color: ''
                },
                {
                    speed: 0.005,
                    size: 16,
                    image: '/images/shiba-inu-shib-logo.svg',
                    color: ''
                },
                {
                    speed: 0.005,
                    size: 16,
                    image: '/images/bitcoin-cash-bch-logo.svg',
                    color: ''
                },
                {
                    speed: 0.005,
                    size: 16,
                    image: '/images/litecoin-ltc-logo.svg',
                    color: ''
                },
                {
                    speed: 0.005,
                    size: 16,
                    image: '/images/monero-xmr-logo.svg',
                    color: ''
                },
                {
                    speed: 0.005,
                    size: 16,
                    image: '/images/dash-dash-logo.svg',
                    color: ''
                }
            ];

            // Create orbiting objects with equal spacing
            objects.forEach((obj, index) => {
                const orbitingObj = document.createElement('div');
                orbitingObj.className = 'orbiting-object';
                orbitingObj.innerHTML = `
                    <img src="${obj.image}"
                         alt="Orbiting Object ${index + 1}"
                         class="object-image w-[45px]">
                `;
                orbitingObjectsContainer.appendChild(orbitingObj);

                // Initial position - equally spaced around the circle
                let angle = (index / objects.length) * Math.PI * 2;

                // Animation
                function animate() {
                    angle += obj.speed;
                    const x = centerX + Math.cos(angle) * orbitRadius - obj.size / 2;
                    const y = centerY + Math.sin(angle) * orbitRadius - obj.size / 2;

                    orbitingObj.style.left = `${x}px`;
                    orbitingObj.style.top = `${y}px`;

                    requestAnimationFrame(animate);
                }

                animate();
            });

            // Add click effect to all objects
            document.querySelectorAll('.object-image').forEach(img => {
                img.addEventListener('click', function() {
                    this.classList.toggle('border-4');
                    this.classList.toggle('border-yellow-400');
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
