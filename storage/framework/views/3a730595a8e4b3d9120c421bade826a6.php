<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if($company_logo): ?>
        <link rel="shortcut icon" href="<?php echo e(asset(config('services.storage_public') . $company_logo)); ?>"
            type="image/x-icon">
    <?php endif; ?>
    
    <title><?php echo e($company_name); ?></title>

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

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"
        integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    
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

    
    <section id="section-header" class="w-screen fixed top-0 z-50 px-5">
        <div class="flex justify-between items-center h-[70px]">
            
            <div class="flex gap-3 items-center">
                <?php if($company_logo): ?>
                    <img class="w-[40px]" src="<?php echo e(asset(config('services.storage_public') . $company_logo)); ?>"
                        alt="Logo">
                <?php endif; ?>
                <?php if($company_name): ?>
                    <p class="text-xl font-bold text-white"><?php echo e($company_name); ?></p>
                <?php endif; ?>
            </div>

            
            <nav class="hidden md:flex gap-3">
                <a href="/" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">Home</a>
                <a href="/" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">About</a>
                <a href="/" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">Support</a>
                <a href="/" class="px-4 py-2 rounded-md text-gray-300 hover:text-white font-semibold">Blog</a>
            </nav>

            
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

            
            <button id="menu-toggle" class="md:hidden text-white text-2xl focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        
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

    
    <section class="h-screen w-full relative pt-[70px] overflow-hidden bg-gradient-to-t from-[#090e34] to-[#162173]">
        <div class="overflow-hidden w-full h-full">
            
            <img src="<?php echo e(asset('images/hero-shape-1.svg')); ?>" class="absolute left-0 top-0 opacity-30"
                alt="hero-section">
            <img src="<?php echo e(asset('images/hero-shape-4.svg')); ?>"
                class="absolute -right-40 -top-32 md:right-0 md:top-0 opacity-30" alt="hero-section">
            <img src="<?php echo e(asset('images/hero-shape-3.svg')); ?>" class="absolute left-0 bottom-0 opacity-30"
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
                        src="<?php echo e(asset('images/bitcoin-btc-logo.svg')); ?>" alt="bitcoin">
                </div>
                <div class="w-[35px] h-[35px] rounded-full bg-white flex justify-center items-center group">
                    <img class="w-[25px] h-[25px] group-hover:-translate-y-0.5 group-hover:shadow-sm"
                        src="<?php echo e(asset('images/ethereum-eth-logo.svg')); ?>" alt="ethereum">
                </div>
                <div class="w-[35px] h-[35px] rounded-full bg-white flex justify-center items-center group">
                    <img class="w-[25px] h-[25px] group-hover:-translate-y-0.5 group-hover:shadow-sm"
                        src="<?php echo e(asset('images/tron-trx-logo.svg')); ?>" alt="tron">
                </div>
                <div class="w-[35px] h-[35px] rounded-full bg-white flex justify-center items-center group">
                    <img class="w-[25px] h-[25px] group-hover:-translate-y-0.5 group-hover:shadow-sm"
                        src="<?php echo e(asset('images/solana-sol-logo.svg')); ?>" alt="solana">
                </div>
                <div class="w-[35px] h-[35px] rounded-full bg-white flex justify-center items-center group">
                    <img class="w-[25px] h-[25px] group-hover:-translate-y-0.5 group-hover:shadow-sm"
                        src="<?php echo e(asset('images/xrp-xrp-logo.svg')); ?>" alt="xrp">
                </div>
            </div>

            <a href="">
                <button
                    class="bg-blue-600 hover:bg-blue-700 rounded-md font-bold w-[120px] translate-y-5 text-center py-2 mt-5">Get
                    Started</button>
            </a>
        </div>

    </section>

    <?php if (isset($component)) { $__componentOriginal95671968024176a006034f37841d0580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal95671968024176a006034f37841d0580 = $attributes; } ?>
<?php $component = App\View\Components\Line::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('line'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Line::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal95671968024176a006034f37841d0580)): ?>
<?php $attributes = $__attributesOriginal95671968024176a006034f37841d0580; ?>
<?php unset($__attributesOriginal95671968024176a006034f37841d0580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal95671968024176a006034f37841d0580)): ?>
<?php $component = $__componentOriginal95671968024176a006034f37841d0580; ?>
<?php unset($__componentOriginal95671968024176a006034f37841d0580); ?>
<?php endif; ?>

    
    <section class="flex flex-col items-center w-full text-center pb-5">
        <p class="title text-2xl md:text-4xl font-bold">Best Features</p>
        <p class="text-gray-300 md:max-w-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
            sed congue
            arcu, In et
            dignissim quam
            condimentum vel.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 px-10 gap-5 gap-y-10 mt-16">
            <?php if (isset($component)) { $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $attributes; } ?>
<?php $component = App\View\Components\Card::resolve(['src' => '/images/shield-svgrepo-com.svg','title' => 'Safe & Secure','description' => 'Lorem ipsum dolor sit amet consectetur elit, sed do eiusmod tempor labore labore labore et dolor'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Card::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64)): ?>
<?php $attributes = $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64; ?>
<?php unset($__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64)): ?>
<?php $component = $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64; ?>
<?php unset($__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $attributes; } ?>
<?php $component = App\View\Components\Card::resolve(['src' => '/images/gift-svgrepo-com.svg','title' => 'Early Bonus','description' => 'Lorem ipsum dolor sit amet consectetur elit, sed do eiusmod tempor labore labore labore et dolor'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Card::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64)): ?>
<?php $attributes = $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64; ?>
<?php unset($__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64)): ?>
<?php $component = $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64; ?>
<?php unset($__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $attributes; } ?>
<?php $component = App\View\Components\Card::resolve(['src' => '/images/access-internet-online-svgrepo-com.svg','title' => 'Universal Access','description' => 'Lorem ipsum dolor sit amet consectetur elit, sed do eiusmod tempor labore labore labore et dolor'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Card::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64)): ?>
<?php $attributes = $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64; ?>
<?php unset($__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64)): ?>
<?php $component = $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64; ?>
<?php unset($__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $attributes; } ?>
<?php $component = App\View\Components\Card::resolve(['src' => '/images/data-storage-lock-solid-svgrepo-com.svg','title' => 'Secure Storage','description' => 'Lorem ipsum dolor sit amet consectetur elit, sed do eiusmod tempor labore labore labore et dolor'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Card::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64)): ?>
<?php $attributes = $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64; ?>
<?php unset($__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64)): ?>
<?php $component = $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64; ?>
<?php unset($__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $attributes; } ?>
<?php $component = App\View\Components\Card::resolve(['src' => '/images/wallet-svgrepo-com.svg','title' => 'Low Cost','description' => 'Lorem ipsum dolor sit amet consectetur elit, sed do eiusmod tempor labore labore labore et dolor'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Card::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64)): ?>
<?php $attributes = $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64; ?>
<?php unset($__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64)): ?>
<?php $component = $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64; ?>
<?php unset($__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $attributes; } ?>
<?php $component = App\View\Components\Card::resolve(['src' => '/images/focus-svgrepo-com.svg','title' => 'Several Profit','description' => 'Lorem ipsum dolor sit amet consectetur elit, sed do eiusmod tempor labore labore labore et dolor'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Card::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64)): ?>
<?php $attributes = $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64; ?>
<?php unset($__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64)): ?>
<?php $component = $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64; ?>
<?php unset($__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64); ?>
<?php endif; ?>
        </div>
    </section>

    <?php if (isset($component)) { $__componentOriginal95671968024176a006034f37841d0580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal95671968024176a006034f37841d0580 = $attributes; } ?>
<?php $component = App\View\Components\Line::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('line'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Line::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal95671968024176a006034f37841d0580)): ?>
<?php $attributes = $__attributesOriginal95671968024176a006034f37841d0580; ?>
<?php unset($__attributesOriginal95671968024176a006034f37841d0580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal95671968024176a006034f37841d0580)): ?>
<?php $component = $__componentOriginal95671968024176a006034f37841d0580; ?>
<?php unset($__componentOriginal95671968024176a006034f37841d0580); ?>
<?php endif; ?>

    
    <section class="flex items-center justify-around w-full text-start pb-5">
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

        <div>
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
    </section>

    <?php if (isset($component)) { $__componentOriginal95671968024176a006034f37841d0580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal95671968024176a006034f37841d0580 = $attributes; } ?>
<?php $component = App\View\Components\Line::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('line'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Line::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal95671968024176a006034f37841d0580)): ?>
<?php $attributes = $__attributesOriginal95671968024176a006034f37841d0580; ?>
<?php unset($__attributesOriginal95671968024176a006034f37841d0580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal95671968024176a006034f37841d0580)): ?>
<?php $component = $__componentOriginal95671968024176a006034f37841d0580; ?>
<?php unset($__componentOriginal95671968024176a006034f37841d0580); ?>
<?php endif; ?>

    
    <section class="flex flex-col items-center w-full text-start pb-5">
        <p class="title text-2xl md:text-4xl font-bold">What Our Client Say's</p>
        <p class="text-gray-300 md:max-w-lg text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
            sed congue
            arcu, In et
            dignissim quam
            condimentum vel.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 px-20 gap-5 mt-16">
            <?php if (isset($component)) { $__componentOriginal3003b491bda606c7c51a1c47faee259f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3003b491bda606c7c51a1c47faee259f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card_testimonial','data' => ['profile' => 'https://crypto-tailwind.preview.uideck.com/src/images/testimonials/image-01.jpg','name' => 'Json Keys','position' => 'CEO & Founder @ Dreampeet','testimonials' => 'I believe in lifelong learning and Learn. is a great place to learn from experts. I\'ve learned a lot and recommend it to all my friends and familys.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card_testimonial'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['profile' => 'https://crypto-tailwind.preview.uideck.com/src/images/testimonials/image-01.jpg','name' => 'Json Keys','position' => 'CEO & Founder @ Dreampeet','testimonials' => 'I believe in lifelong learning and Learn. is a great place to learn from experts. I\'ve learned a lot and recommend it to all my friends and familys.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3003b491bda606c7c51a1c47faee259f)): ?>
<?php $attributes = $__attributesOriginal3003b491bda606c7c51a1c47faee259f; ?>
<?php unset($__attributesOriginal3003b491bda606c7c51a1c47faee259f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3003b491bda606c7c51a1c47faee259f)): ?>
<?php $component = $__componentOriginal3003b491bda606c7c51a1c47faee259f; ?>
<?php unset($__componentOriginal3003b491bda606c7c51a1c47faee259f); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal3003b491bda606c7c51a1c47faee259f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3003b491bda606c7c51a1c47faee259f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card_testimonial','data' => ['profile' => 'https://crypto-tailwind.preview.uideck.com/src/images/testimonials/image-01.jpg','name' => 'Json Keys','position' => 'CEO & Founder @ Dreampeet','testimonials' => 'I believe in lifelong learning and Learn. is a great place to learn from experts. I\'ve learned a lot and recommend it to all my friends and familys.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card_testimonial'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['profile' => 'https://crypto-tailwind.preview.uideck.com/src/images/testimonials/image-01.jpg','name' => 'Json Keys','position' => 'CEO & Founder @ Dreampeet','testimonials' => 'I believe in lifelong learning and Learn. is a great place to learn from experts. I\'ve learned a lot and recommend it to all my friends and familys.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3003b491bda606c7c51a1c47faee259f)): ?>
<?php $attributes = $__attributesOriginal3003b491bda606c7c51a1c47faee259f; ?>
<?php unset($__attributesOriginal3003b491bda606c7c51a1c47faee259f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3003b491bda606c7c51a1c47faee259f)): ?>
<?php $component = $__componentOriginal3003b491bda606c7c51a1c47faee259f; ?>
<?php unset($__componentOriginal3003b491bda606c7c51a1c47faee259f); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal3003b491bda606c7c51a1c47faee259f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3003b491bda606c7c51a1c47faee259f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card_testimonial','data' => ['profile' => 'https://crypto-tailwind.preview.uideck.com/src/images/testimonials/image-01.jpg','name' => 'Json Keys','position' => 'CEO & Founder @ Dreampeet','testimonials' => 'I believe in lifelong learning and Learn. is a great place to learn from experts. I\'ve learned a lot and recommend it to all my friends and familys.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card_testimonial'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['profile' => 'https://crypto-tailwind.preview.uideck.com/src/images/testimonials/image-01.jpg','name' => 'Json Keys','position' => 'CEO & Founder @ Dreampeet','testimonials' => 'I believe in lifelong learning and Learn. is a great place to learn from experts. I\'ve learned a lot and recommend it to all my friends and familys.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3003b491bda606c7c51a1c47faee259f)): ?>
<?php $attributes = $__attributesOriginal3003b491bda606c7c51a1c47faee259f; ?>
<?php unset($__attributesOriginal3003b491bda606c7c51a1c47faee259f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3003b491bda606c7c51a1c47faee259f)): ?>
<?php $component = $__componentOriginal3003b491bda606c7c51a1c47faee259f; ?>
<?php unset($__componentOriginal3003b491bda606c7c51a1c47faee259f); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal3003b491bda606c7c51a1c47faee259f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3003b491bda606c7c51a1c47faee259f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card_testimonial','data' => ['profile' => 'https://crypto-tailwind.preview.uideck.com/src/images/testimonials/image-01.jpg','name' => 'Json Keys','position' => 'CEO & Founder @ Dreampeet','testimonials' => 'I believe in lifelong learning and Learn. is a great place to learn from experts. I\'ve learned a lot and recommend it to all my friends and familys.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card_testimonial'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['profile' => 'https://crypto-tailwind.preview.uideck.com/src/images/testimonials/image-01.jpg','name' => 'Json Keys','position' => 'CEO & Founder @ Dreampeet','testimonials' => 'I believe in lifelong learning and Learn. is a great place to learn from experts. I\'ve learned a lot and recommend it to all my friends and familys.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3003b491bda606c7c51a1c47faee259f)): ?>
<?php $attributes = $__attributesOriginal3003b491bda606c7c51a1c47faee259f; ?>
<?php unset($__attributesOriginal3003b491bda606c7c51a1c47faee259f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3003b491bda606c7c51a1c47faee259f)): ?>
<?php $component = $__componentOriginal3003b491bda606c7c51a1c47faee259f; ?>
<?php unset($__componentOriginal3003b491bda606c7c51a1c47faee259f); ?>
<?php endif; ?>
        </div>
    </section>

    <?php if (isset($component)) { $__componentOriginal95671968024176a006034f37841d0580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal95671968024176a006034f37841d0580 = $attributes; } ?>
<?php $component = App\View\Components\Line::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('line'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Line::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal95671968024176a006034f37841d0580)): ?>
<?php $attributes = $__attributesOriginal95671968024176a006034f37841d0580; ?>
<?php unset($__attributesOriginal95671968024176a006034f37841d0580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal95671968024176a006034f37841d0580)): ?>
<?php $component = $__componentOriginal95671968024176a006034f37841d0580; ?>
<?php unset($__componentOriginal95671968024176a006034f37841d0580); ?>
<?php endif; ?>


    
    <section class="flex flex-col items-center w-full text-start pb-5">
        <p class="title text-2xl md:text-4xl font-bold">Frequently Asked Questions</p>
        <p class="text-gray-300 md:max-w-lg text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
            sed congue
            arcu, In et
            dignissim quam
            condimentum vel.</p>

        <div id="accordion-open" data-accordion="open" class="w-[50%] mt-10">
            <h2 id="accordion-open-heading-1">
                <button type="button"
                    class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-300 focus:ring-gray-200 gap-3"
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
                    <p class="mb-2 text-gray-500">The main difference is that the core components
                        from Flowbite are open source under the MIT license, whereas Tailwind UI is a paid product.
                        Another difference is that Flowbite relies on smaller and standalone components, whereas
                        Tailwind UI offers sections of pages.</p>
                </div>
            </div>

            <h2 id="accordion-open-heading-2">
                <button type="button"
                    class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-300 focus:ring-gray-200 gap-3"
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
                    <p class="mb-2 text-gray-500">The main difference is that the core components
                        from Flowbite are open source under the MIT license, whereas Tailwind UI is a paid product.
                        Another difference is that Flowbite relies on smaller and standalone components, whereas
                        Tailwind UI offers sections of pages.</p>
                </div>
            </div>
        </div>
    </section>

    <?php if (isset($component)) { $__componentOriginal95671968024176a006034f37841d0580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal95671968024176a006034f37841d0580 = $attributes; } ?>
<?php $component = App\View\Components\Line::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('line'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Line::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal95671968024176a006034f37841d0580)): ?>
<?php $attributes = $__attributesOriginal95671968024176a006034f37841d0580; ?>
<?php unset($__attributesOriginal95671968024176a006034f37841d0580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal95671968024176a006034f37841d0580)): ?>
<?php $component = $__componentOriginal95671968024176a006034f37841d0580; ?>
<?php unset($__componentOriginal95671968024176a006034f37841d0580); ?>
<?php endif; ?>

    
    <section class="flex flex-col items-center w-full text-start pb-5">
        <p class="title text-2xl md:text-4xl font-bold">Recent News & Blogs</p>
        <p class="text-gray-300 md:max-w-lg text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
            sed congue
            arcu, In et
            dignissim quam
            condimentum vel.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 px-10 gap-5 mt-16">
            <?php if (isset($component)) { $__componentOriginal16ddd09d163603effd72a0ac018acbfb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal16ddd09d163603effd72a0ac018acbfb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card_news','data' => ['thumbnail' => 'https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg','author' => 'Admin','date' => '27 April 2025','title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card_news'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['thumbnail' => 'https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg','author' => 'Admin','date' => '27 April 2025','title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal16ddd09d163603effd72a0ac018acbfb)): ?>
<?php $attributes = $__attributesOriginal16ddd09d163603effd72a0ac018acbfb; ?>
<?php unset($__attributesOriginal16ddd09d163603effd72a0ac018acbfb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal16ddd09d163603effd72a0ac018acbfb)): ?>
<?php $component = $__componentOriginal16ddd09d163603effd72a0ac018acbfb; ?>
<?php unset($__componentOriginal16ddd09d163603effd72a0ac018acbfb); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal16ddd09d163603effd72a0ac018acbfb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal16ddd09d163603effd72a0ac018acbfb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card_news','data' => ['thumbnail' => 'https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg','author' => 'Admin','date' => '27 April 2025','title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card_news'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['thumbnail' => 'https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg','author' => 'Admin','date' => '27 April 2025','title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal16ddd09d163603effd72a0ac018acbfb)): ?>
<?php $attributes = $__attributesOriginal16ddd09d163603effd72a0ac018acbfb; ?>
<?php unset($__attributesOriginal16ddd09d163603effd72a0ac018acbfb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal16ddd09d163603effd72a0ac018acbfb)): ?>
<?php $component = $__componentOriginal16ddd09d163603effd72a0ac018acbfb; ?>
<?php unset($__componentOriginal16ddd09d163603effd72a0ac018acbfb); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal16ddd09d163603effd72a0ac018acbfb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal16ddd09d163603effd72a0ac018acbfb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card_news','data' => ['thumbnail' => 'https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg','author' => 'Admin','date' => '27 April 2025','title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card_news'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['thumbnail' => 'https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg','author' => 'Admin','date' => '27 April 2025','title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal16ddd09d163603effd72a0ac018acbfb)): ?>
<?php $attributes = $__attributesOriginal16ddd09d163603effd72a0ac018acbfb; ?>
<?php unset($__attributesOriginal16ddd09d163603effd72a0ac018acbfb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal16ddd09d163603effd72a0ac018acbfb)): ?>
<?php $component = $__componentOriginal16ddd09d163603effd72a0ac018acbfb; ?>
<?php unset($__componentOriginal16ddd09d163603effd72a0ac018acbfb); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal16ddd09d163603effd72a0ac018acbfb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal16ddd09d163603effd72a0ac018acbfb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card_news','data' => ['thumbnail' => 'https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg','author' => 'Admin','date' => '27 April 2025','title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card_news'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['thumbnail' => 'https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg','author' => 'Admin','date' => '27 April 2025','title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal16ddd09d163603effd72a0ac018acbfb)): ?>
<?php $attributes = $__attributesOriginal16ddd09d163603effd72a0ac018acbfb; ?>
<?php unset($__attributesOriginal16ddd09d163603effd72a0ac018acbfb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal16ddd09d163603effd72a0ac018acbfb)): ?>
<?php $component = $__componentOriginal16ddd09d163603effd72a0ac018acbfb; ?>
<?php unset($__componentOriginal16ddd09d163603effd72a0ac018acbfb); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal16ddd09d163603effd72a0ac018acbfb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal16ddd09d163603effd72a0ac018acbfb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card_news','data' => ['thumbnail' => 'https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg','author' => 'Admin','date' => '27 April 2025','title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card_news'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['thumbnail' => 'https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg','author' => 'Admin','date' => '27 April 2025','title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal16ddd09d163603effd72a0ac018acbfb)): ?>
<?php $attributes = $__attributesOriginal16ddd09d163603effd72a0ac018acbfb; ?>
<?php unset($__attributesOriginal16ddd09d163603effd72a0ac018acbfb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal16ddd09d163603effd72a0ac018acbfb)): ?>
<?php $component = $__componentOriginal16ddd09d163603effd72a0ac018acbfb; ?>
<?php unset($__componentOriginal16ddd09d163603effd72a0ac018acbfb); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal16ddd09d163603effd72a0ac018acbfb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal16ddd09d163603effd72a0ac018acbfb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card_news','data' => ['thumbnail' => 'https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg','author' => 'Admin','date' => '27 April 2025','title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card_news'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['thumbnail' => 'https://crypto-tailwind.preview.uideck.com/src/images/blogs/image-01.jpg','author' => 'Admin','date' => '27 April 2025','title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed congue arcu, In et dignissim quam condimentum vel.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal16ddd09d163603effd72a0ac018acbfb)): ?>
<?php $attributes = $__attributesOriginal16ddd09d163603effd72a0ac018acbfb; ?>
<?php unset($__attributesOriginal16ddd09d163603effd72a0ac018acbfb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal16ddd09d163603effd72a0ac018acbfb)): ?>
<?php $component = $__componentOriginal16ddd09d163603effd72a0ac018acbfb; ?>
<?php unset($__componentOriginal16ddd09d163603effd72a0ac018acbfb); ?>
<?php endif; ?>
        </div>
    </section>

    <?php if (isset($component)) { $__componentOriginal95671968024176a006034f37841d0580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal95671968024176a006034f37841d0580 = $attributes; } ?>
<?php $component = App\View\Components\Line::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('line'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Line::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal95671968024176a006034f37841d0580)): ?>
<?php $attributes = $__attributesOriginal95671968024176a006034f37841d0580; ?>
<?php unset($__attributesOriginal95671968024176a006034f37841d0580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal95671968024176a006034f37841d0580)): ?>
<?php $component = $__componentOriginal95671968024176a006034f37841d0580; ?>
<?php unset($__componentOriginal95671968024176a006034f37841d0580); ?>
<?php endif; ?>

    <script src="<?php echo e(asset('js/landing.js')); ?>"></script>

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
<?php /**PATH H:\Bank Project\2025\trading web jadi\resources\views/Landing.blade.php ENDPATH**/ ?>