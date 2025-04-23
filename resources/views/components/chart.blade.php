<div class="mt-3 grid sm: grid-cols-1 lg:grid-cols-4 gap-4 text-base-text">
    <div class="bg-base-card shadow-sm shadow-slate-400">
        <div class="flex items-center justify-evenly mt-3">
            <span class="text-primary text-5xl">
                <i class="fa-solid fa-users"></i>
            </span>
            <span>
                <p class="text-xl font-bold">Refferal</p>
                <p>totals refferal</p>
            </span>
        </div>
        <div class="justify-around flex mt-3 items-center">
            <p class="text-xl font-bold text-secondary">{{ $members || $members!=""? $members : 0  }} Members</p>
            <a href="#" class="text-xs text-primary font-bold">Details</a>
        </div>

        <div>
            <img src="{{ asset('images/referal-chart.png') }}" class="w-full" alt="Referal Chart">
        </div>
    </div>
    <div class="bg-base-card shadow-sm shadow-slate-400">
        <div class="flex items-center justify-evenly mt-3">
            <span class="text-primary text-5xl">
                <i class="fa-solid fa-money-bill-1-wave"></i>
            </span>
            <span>
                <p class="text-xl font-bold">Bonus</p>
                <p>totals bonus</p>
            </span>
        </div>
        <div class="justify-around flex mt-3 items-center">
            <p class="text-xl font-bold text-secondary">{{ session('currency') }} {{ $bonus }}</p>
            <a href="#" class="text-xs text-primary font-bold">Details</a>
        </div>

        <div>
            <img src="{{ asset('images/bonus-chart.png') }}" class="w-full" alt="Referal Chart">
        </div>
    </div>
    <div class="bg-base-card shadow-sm shadow-slate-400">
        <div class="flex items-center justify-evenly mt-3">
            <span class="text-primary text-5xl">
                <i class="fa-solid fa-chart-area"></i>
            </span>
            <span>
                <p class="text-xl font-bold">Profits</p>
                <p>totals profit</p>
            </span>
        </div>
        <div class="justify-around flex mt-3 items-center">
            <p class="text-xl font-bold text-secondary">{{ session('currency') }} {{ $profits }}</p>
            <a href="#" class="text-xs text-primary font-bold">Details</a>
        </div>

        <div>
            <img src="{{ asset('images/profits-chart.png') }}" class="w-full" alt="Referal Chart">
        </div>
    </div>
    <div class="bg-base-card shadow-sm shadow-slate-400">
        <div class="flex items-center justify-evenly mt-3">
            <span class="text-primary text-5xl">
                <i class="fa-solid fa-wallet"></i>
            </span>
            <span>
                <p class="text-xl font-bold">{{ session('currency') }} Wallet</p>
                <p>your balance</p>
            </span>
        </div>
        <div class="justify-around flex mt-3 items-center">
            <p class="text-xl font-bold text-secondary">{{ session('currency') }} {{ $wallet }}</p>
            <a href="#" class="text-xs text-primary font-bold">Details</a>
        </div>

        <div>
            <img src="{{ asset('images/wallet-chart.png') }}" class="w-full" alt="Referal Chart">
        </div>
    </div>
</div>
