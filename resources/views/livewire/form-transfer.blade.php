<form wire:submit.prevent="submit">
    <x-input label="Available Balance" placeholder="Available Balance" name="ava_balace" value="{{ $amount }}"
        disabled />
    <x-input label="Username Recipient" placeholder="Username Recipient" name="username" model="username" />
    @error('username')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    <x-input label="Amount Transfered" placeholder="Enter Amount" name="transfer_balance" model="amount_transfer" />
    @error('amount_transfer')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    <button type="submit"
        class="bg-primary mt-3 px-5 py-2 rounded-md text-white flex items-center gap-2 justify-center" id="submit-btn"
        wire:loading.attr="disabled">
        <i class="fa-solid fa-spinner animate-rotate" wire:loading></i> <span>Transfer</span>
    </button>

    @if (session()->has('message'))
        <div class="p-4 mt-3 text-green-700 bg-green-100 rounded-md">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="p-4 mt-3 text-red-700 bg-red-100 rounded-md">
            {{ session('error') }}
        </div>
    @endif
</form>
