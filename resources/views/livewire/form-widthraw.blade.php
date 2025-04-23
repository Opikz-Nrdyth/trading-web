<form wire:submit.prevent="submit">
    <x-input label="Available Balance" placeholder="Available Balance" name="ava_balace" value="{{ $amount }}"
        disabled />

    <x-select model="currency_type" placeholder="Withdrawal Currency" name="currency" options="{{ $list_currency }}" />
    @error('currency_type')
        <span class="text-red-500">{{ $message }}</span>
    @enderror

    <x-input model="pass_bank" label="Bank Name" placeholder="Enter Bank Name" name="pass_bank" />
    @error('pass_bank')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    <x-input model="bank_number" label="Bank Number" placeholder="Enter Number" name="tujuan" />
    @error('bank_number')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    <x-input model="user_bank" label="Username Bank" placeholder="Enter Username Bank" name="user_bank" />
    @error('user_bank')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    <x-input model="amount_withdaraw" label="Amount Withdrawal" placeholder="Amount Withdrawal" name="amount" />
    @error('amount_withdaraw')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    <button type="submit"
        class="bg-primary mt-3 px-5 py-2 rounded-md text-white flex items-center gap-2 justify-center" id="submit-btn"
        wire:loading.attr="disabled">
        <i class="fa-solid fa-spinner animate-rotate" wire:loading></i> <span>Withdraw</span>
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
