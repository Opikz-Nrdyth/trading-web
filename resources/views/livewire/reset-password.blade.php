<form wire:submit.prevent="submit">
    <x-input label="Current Password" name="current_password" type="password" model="current_password" />
    @error('current_password')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    <x-input label="New Password" name="new_password" type="password" model="new_password" />
    @error('new_password')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    <x-input label="Re-Type New Password" name="retype_password" type="password" model="retype_password" />
    @error('retype_password')
        <span class="text-red-500">{{ $message }}</span>
    @enderror

    <button type="submit"
        class="bg-primary mt-3 px-5 py-2 rounded-md text-white flex items-center gap-2 justify-center"
        id="submit-btn" wire:loading.attr="disabled">
        <i class="fa-solid fa-spinner animate-rotate" wire:loading></i> <span>Submit</span>
    </button>
    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="mt-4 text-green-500">
            {{ session('message') }}
        </div>
    @endif
</form>
