<form wire:submit.prevent="submit" class="flex flex-col">
    <input type="file" wire:model="profile_image" class="my-5" name="User Profile">
    <div wire:loading wire:target="profile_image">Loading Images...</div>
    @error('profile_image')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    <button type="submit"
        class="bg-primary mt-3 px-4 py-2 rounded-md text-white w-[100px] flex items-center gap-2 justify-center"
        id="submit-btn" wire:loading.attr="disabled">
        <i class="fa-solid fa-spinner animate-rotate" wire:loading></i> <span>Submit</span>
    </button>
</form>

<!-- Flash Message -->
@if (session()->has('message'))
    <div class="mt-4 text-green-500">
        {{ session('message') }}
    </div>
@endif
