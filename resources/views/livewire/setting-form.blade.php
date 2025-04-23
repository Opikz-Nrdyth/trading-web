<form wire:submit.prevent="submit">
    @if ($username != '')
        <x-input label="Username" placeholder="Jhon" name="username" value="{{ $username }}" model="username"
            disabled="true" />
    @else
        <x-input label="Username" placeholder="Jhon" name="username" value="{{ $username }}" model="username" />
    @endif
    @error('username')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    <x-input label="Referals" placeholder="" name="refferals" value="{{ $refferals }} Members" disabled="true" />
    @error('refferals')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    <x-input label="Full Name" placeholder="Full Name" name="full_name" value="{{ $full_name }}" model="full_name" />
    @error('full_name')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    <x-input label="Address" placeholder="e.g., 123 Main St, City, Country" name="address" model="address"
        value="{{ $address }}" />
    @error('address')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    <x-select label="Country" name="country" :options="['Indonesia', 'Thailand', 'Singapore']" model="country" value="{{ $country }}" />
    @error('country')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    <x-input label="Email" placeholder="Jhon@email.com" name="email" type="email" value="{{ $email }}"
        disabled="true" />
    @error('email')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    <x-input label="Phone Number" placeholder="+6281119875" name="phone" model="phone"
        value="{{ $phone }}" />
    @error('phone')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    <x-input label="Bitcoin Address" placeholder="your bitcoin address" name="bitcoin_address" model="bitcoin_address"
        value="{{ $bitcoin_address }}" />
    @error('bitcoin_address')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    <x-input label="Bank" placeholder="your bank number" name="bank" model="bank" value="{{ $bank }}" />
    @error('bank')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    <button type="submit"
        class="bg-primary mt-3 px-5 py-2 rounded-md text-white flex items-center gap-2 justify-center"
        id="submit-btn" wire:loading.attr="disabled">
        <i class="fa-solid fa-spinner animate-rotate" wire:loading></i> <span>Submit</span>
    </button>

    @if (session()->has('message'))
        <div class="p-4 mt-3 text-green-700 bg-green-100 rounded-md">
            {{ session('message') }}
        </div>
    @endif
</form>
