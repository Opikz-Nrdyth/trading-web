<div class="w-[20%] ml-0 bg-base-side text-white min-h-screen pb-3 transition-all duration-200 relative z-10"
    id="sidebar">
    <div class="flex flex-col items-center py-8 border-b-2 gap-5 border-base-text">
        <p class="text-primary text-xl main-link"><b>Welcome</b> {{ auth()->user()->role ?? '' }}</p>
        <div class="w-[50px] h-[50px] rounded-full bg-primary flex justify-center items-center">
            <img class="w-full h-full rounded-full"
                src="@if (auth()->user()->userData->profile_image ?? '') {{ asset('public/storage/' . auth()->user()->userData->profile_image) }}
                @else
                    https://ui-avatars.com/api/?name={{ implode('',array_map(function ($word) {return strtoupper($word[0]);}, explode(' ', auth()->user()->name ?? ''))) }}&color=FFFFFF&background=00a8e8 @endif"
                alt="{{ implode('',array_map(function ($word) {return strtoupper($word[0]);}, explode(' ', auth()->user()->name ?? ''))) }}">
        </div>
        <div class="text-center text-base-text main-link">
            <p>{{ auth()->user()->name ?? '' }}
            </p>

            <p>({{ auth()->user()->userData->username ?? '' }})</p>
        </div>
    </div>

    <div class="text-base-text flex flex-col container-link">
        <a href="/">
            <nav
                class="py-2 px-4 flex gap-5 items-center border-l-2 {{ $route == '' ? 'border-l-primary' : 'border-l-base-side' }} hover:text-white">
                <span class="w-[40px] h-[40px] flex justify-center items-center bg-base-button rounded-full">
                    <i class="fa-solid fa-house"></i>
                </span>
                <span class="main-link">Dashboard</span>
            </nav>

        </a>

        <div class="nav-group">
            <nav class="py-2 px-4 flex justify-between hover:text-white group border-l-2 {{ $route == 'profile' || $route == 'profile-images' ? 'border-l-primary' : 'border-l-base-side' }}"
                onclick="sideMenu('settings')">
                <span class="flex gap-5 items-center"> <span
                        class="w-[40px] h-[40px] flex justify-center items-center bg-base-button rounded-full"><i
                            class="fa-solid fa-gear"></i></span> <span class="main-link">Settings</span>
                </span>
                <button class="transform transition-transform duration-300 group-hover:rotate-90 main-link"><i
                        class="fa-solid fa-angle-right"></i></button>
            </nav>

            <div id="link-grup-settings" style="display: none" class="flex flex-col gap-2">
                <a href="/profile">
                    <nav class="ml-14 py-2 px-3 hover:text-white w-fit rounded-md bg-base-side">
                        Profile
                    </nav>
                </a>
                <a href="/profile-images">
                    <nav class="ml-14 py-2 px-3 hover:text-white w-fit rounded-md bg-base-side">
                        Profile Images
                    </nav>
                </a>
            </div>

        </div>

        <a href="/security">
            <nav
                class="py-2 px-4 flex gap-5 items-center border-l-2 {{ $route == 'security' ? 'border-l-primary' : 'border-l-base-side' }} hover:text-white">
                <span class="w-[40px] h-[40px] flex justify-center items-center bg-base-button rounded-full">
                    <i class="fa-solid fa-shield-halved"></i>
                </span>
                <span class="main-link">Security</span>
            </nav>
        </a>

        <a href="/kyc">
            <nav
                class="py-2 px-4 flex gap-5 items-center border-l-2 {{ $route == 'kyc' ? 'border-l-primary' : 'border-l-base-side' }} hover:text-white">
                <span class="w-[40px] h-[40px] flex justify-center items-center bg-base-button rounded-full">
                    <i class="fa-solid fa-address-card"></i>
                </span>
                <span class="main-link">KYC</span>
            </nav>
        </a>

        <a href="/investment">
            <nav
                class="py-2 px-4 flex gap-5 items-center border-l-2 {{ $route == 'investment' ? 'border-l-primary' : 'border-l-base-side' }} hover:text-white">
                <span class="w-[40px] h-[40px] flex justify-center items-center bg-base-button rounded-full">
                    <i class="fa-regular fa-circle-check"></i>
                </span>
                <span class="main-link">Investment</span>
            </nav>
        </a>

        <div class="nav-group">
            <nav class="py-2 px-4 flex justify-between hover:text-white group border-l-2 {{ $route == 'trade' || $route == 'history' || $route == 'profits' ? 'border-l-primary' : 'border-l-base-side' }}"
                onclick="sideMenu('trade')">
                <span class="flex gap-5 items-center">
                    <span class="w-[40px] h-[40px] flex justify-center items-center bg-base-button rounded-full">
                        <i class="fa-solid fa-chart-area"></i>
                    </span>
                    <span class="main-link">Trade</span>
                </span>
                <button class="transform transition-transform duration-300 group-hover:rotate-90 main-link"><i
                        class="fa-solid fa-angle-right"></i></button>
            </nav>

            <div id="link-grup-trade" style="display: none" class="flex flex-col gap-2">

                <a href="/trade">
                    <nav class="ml-14 py-2 px-3 hover:text-white w-fit rounded-md bg-base-side">
                        Trade
                    </nav>
                </a>

                <a href="/trade/history">
                    <nav class="ml-14 py-2 px-3 hover:text-white w-fit rounded-md bg-base-side">
                        History
                    </nav>
                </a>

                <a href="/trade/profits">
                    <nav class="ml-14 py-2 px-3 hover:text-white w-fit rounded-md bg-base-side">
                        Profits
                    </nav>
                </a>
            </div>

        </div>

        <div class="nav-group">
            <nav class="py-2 px-4 flex justify-between hover:text-white group" onclick="sideMenu('funds')">
                <span class="flex gap-5 items-center">
                    <span class="w-[40px] h-[40px] flex justify-center items-center bg-base-button rounded-full">
                        <i class="fa-solid fa-money-bill-1-wave"></i>
                    </span>
                    <span class="main-link">Funds</span>
                </span>
                <button class="transform transition-transform duration-300 group-hover:rotate-90 main-link"><i
                        class="fa-solid fa-angle-right"></i></button>
            </nav>


            <div id="link-grup-funds" style="display: none" class="flex flex-col gap-2">
                <a href="/bonus">
                    <nav class="ml-14 py-2 px-3 hover:text-white w-fit rounded-md bg-base-side">
                        Bonus
                    </nav>
                </a>
                <a href="/trade/profits">
                    <nav class="ml-14 py-2 px-3 hover:text-white w-fit rounded-md bg-base-side">
                        Profits
                    </nav>
                </a>
            </div>

        </div>

        <div class="nav-group">
            <nav class="py-2 px-4 flex justify-between hover:text-white group" onclick="sideMenu('wallet')">
                <span class="flex gap-5 items-center">
                    <span class="w-[40px] h-[40px] flex justify-center items-center bg-base-button rounded-full">
                        <i class="fa-solid fa-wallet"></i>
                    </span>
                    <span class="main-link">Wallet</span>
                </span>
                <button class="transform transition-transform duration-300 group-hover:rotate-90 main-link"><i
                        class="fa-solid fa-angle-right"></i></button>
            </nav>


            <div id="link-grup-wallet" style="display: none" class="flex flex-col gap-2">
                <a href="/balance">
                    <nav class="ml-14 py-2 px-3 hover:text-white w-fit rounded-md bg-base-side">
                        Balance
                    </nav>
                </a>
                <a href="/balance/virtual-balance">
                    <nav class="ml-14 py-2 px-3 hover:text-white w-fit rounded-md bg-base-side">
                        Virtual Balance
                    </nav>
                </a>
                <a href="/balance/add">
                    <nav class="ml-14 py-2 px-3 hover:text-white w-fit rounded-md bg-base-side">
                        Add Balance
                    </nav>
                </a>
                <a href="/balance/transfer">
                    <nav class="ml-14 py-2 px-3 hover:text-white w-fit rounded-md bg-base-side">
                        Transfer
                    </nav>
                </a>
                <a href="/balance/withdrawal">
                    <nav class="ml-14 py-2 px-3 hover:text-white w-fit rounded-md bg-base-side">
                        Withdrawal
                    </nav>
                </a>

            </div>

        </div>

        <!--<a href="/referals">-->
        <!--    <nav-->
        <!--        class="py-2 px-4 flex gap-5 items-center border-l-2 {{ $route == 'referals' ? 'border-l-primary' : 'border-l-base-side' }} hover:text-white">-->
        <!--        <span class="w-[40px] h-[40px] flex justify-center items-center bg-base-button rounded-full">-->
        <!--            <i class="fa-solid fa-network-wired"></i>-->
        <!--        </span>-->
        <!--        <span class="main-link">Referals</span>-->
        <!--    </nav>-->
        <!--</a>-->

        <!--<a href="/auth/registrasion">-->
        <!--    <nav class="py-2 px-4 flex gap-5 items-center border-l-2 border-l-base-side hover:text-white">-->
        <!--        <span class="w-[40px] h-[40px] flex justify-center items-center bg-base-button rounded-full">-->
        <!--            <i class="fa-solid fa-pen-to-square"></i>-->
        <!--        </span>-->
        <!--        <span class="main-link">Register</span>-->
        <!--    </nav>-->
        <!--</a>-->

        <a href="/faq">
            <nav class="py-2 px-4 flex gap-5 items-center border-l-2 border-l-base-side hover:text-white">
                <span class="w-[40px] h-[40px] flex justify-center items-center bg-base-button rounded-full">
                    <i class="fa-solid fa-circle-question"></i>
                </span>
                <span class="main-link">FAQ</span>
            </nav>
        </a>

        <a href="/last-news">
            <nav class="py-2 px-4 flex gap-5 items-center border-l-2 border-l-base-side hover:text-white">
                <span class="w-[40px] h-[40px] flex justify-center items-center bg-base-button rounded-full">
                    <i class="fa-solid fa-newspaper"></i>
                </span>
                <span class="main-link">Last News</span>
            </nav>
        </a>

        <!--<div class="nav-group">-->
        <!--    <nav class="py-2 px-4 flex justify-between hover:text-white group" onclick="sideMenu('testimonials')">-->
        <!--        <span class="flex gap-5 items-center">-->
        <!--            <span class="w-[40px] h-[40px] flex justify-center items-center bg-base-button rounded-full">-->
        <!--                <i class="fa-solid fa-comments"></i>-->
        <!--            </span>-->
        <!--            <span class="main-link">Testimonials</span>-->
        <!--        </span>-->
        <!--        <button class="transform transition-transform duration-300 group-hover:rotate-90 main-link"><i-->
        <!--                class="fa-solid fa-angle-right"></i></button>-->
        <!--    </nav>-->

        <!--    <div id="link-grup-testimonials" style="display: none" class="flex flex-col gap-2">-->

        <!--        <a href="/testimonials">-->
        <!--            <nav class="ml-14 py-2 px-3 hover:text-white w-fit rounded-md bg-base-side">-->
        <!--                Testimonials-->
        <!--            </nav>-->
        <!--        </a>-->
        <!--        <a href="/testimonials/add">-->
        <!--            <nav class="ml-14 py-2 px-3 hover:text-white w-fit rounded-md bg-base-side">-->
        <!--                Add Testimonials-->
        <!--            </nav>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--</div>-->

        <a href="/logout">
            <nav class="py-2 px-4 flex gap-5 items-center border-l-2 border-l-base-side hover:text-white">
                <span class="w-[40px] h-[40px] flex justify-center items-center bg-base-button rounded-full">
                    <i class="fa-solid fa-power-off"></i>
                </span>
                <span class="main-link">Log Out</span>
            </nav>
        </a>
    </div>
</div>
