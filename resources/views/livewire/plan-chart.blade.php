<div class="bg-base-card p-6 rounded-lg shadow-lg text-base-text">
    <h2 class="text-xl font-bold text-primary mb-4 text-center">{{ $plan }}</h2>
    <ul class="mb-4">
        <li>Min. Amount {{ $min }}</li>
        <li>Max. Amount {{ $max }}</li>
        <li>Contract {{ $minContract }} - {{ $maxContract }} Hours</li>
    </ul>
    <form wire:submit.prevent="invest">
        <div class="mb-4 flex">
            <input type="text" disabled placeholder="{{ session('currency') ?? 'IDR' }}"
                class="bg-base-input-disabled text-white p-2 rounded-l w-1/4">
            <input type="text" placeholder="Amount" wire:model="amount"
                class="bg-base-input text-white p-2 rounded-r w-3/4">
        </div>
        @error('amount')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
        <button class="bg-primary text-white py-2 px-4 rounded w-full flex items-center justify-center gap-2"
            wire:loading.attr="disabled"><i class="fa-solid fa-spinner animate-rotate" wire:loading></i>
            INVEST NOW</button>
        @error('alert')
            <span class="text-red-500">{{ $message }}</span>
        @enderror

        @error('message')
            <span class="text-green-500">{{ $message }}</span>
        @enderror
    </form>
</div>
