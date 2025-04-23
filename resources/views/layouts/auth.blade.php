<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/public/storage/{{ \App\Models\setting::first()->company_logo }}" type="image/x-icon">
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="{{ asset('css/partial.css') }}">
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
                        secondary: "#FFAA00", // warna oranye cerah
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

    @livewireStyles

    {{-- Chart JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
        integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"
        integrity="sha512-ZwR1/gSZM3ai6vCdI+LVF1zSq/5HznD3ZSTk7kajkaj4D292NLuduDCO1c/NT8Id+jE58KYLKT7hXnbtryGmMg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script async src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>

</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900 bg-opacity-35">

    <!-- particles.js container -->
    <div id="particles-js" style="height: 100vh" class="overflow-hidden">
    </div>
    <main
        class="flex flex-col justify-center items-center w-[90%] lg:w-[75%] lg:p-5 sm:p-3 transition-all duration-200">
        @yield('content')
    </main>

    <script src="{{ asset('js/particles.js') }}"></script>
    <script src="{{ asset('js/partial.js') }}"></script>

    <!-- stats.js -->
    <script src="{{ asset('js/lib/stats-partial.js') }}"></script>

    <script src="{{ asset('js/welcome.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>

    @yield('script')

    @livewireScripts


</body>

</html>
