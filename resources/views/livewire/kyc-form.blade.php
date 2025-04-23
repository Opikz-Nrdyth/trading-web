<form wire:submit.prevent="submit">
    <x-input label="Full Name" placeholder="Full Name" disabled="true" name="full_name" value="{{ $full_name }}" />
    @error('full_name')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    <x-input label="Address" placeholder="e.g., 123 Main St, City, Country" disabled="true" name="address"
        value="{{ $address }}" />
    @error('address')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    <x-input-image label="Upload Identity Card" name="identity_card" model="identity_card" />
    <div wire:loading wire:target="identity_card">Loading Images...</div>
    @error('identity_card')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    <x-input-image label="Upload Close Up Photo" name="close_up_photo" model="close_up_photo" />
    <div wire:loading wire:target="close_up_photo">Loading Images...</div>
    @error('close_up_photo')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    <br>
    <button type="submit"
        class="bg-primary mt-3 px-5 py-2 rounded-md text-white flex items-center gap-2 justify-center" id="submit-btn"
        wire:loading.attr="disabled">
        <i class="fa-solid fa-spinner animate-rotate" wire:loading></i> <span>Send Verification</span>
    </button>
</form>
