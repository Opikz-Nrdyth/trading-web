<form wire:submit.prevent="submit">
    <x-input model="message" label="Testimonials (max 350 chareacter)" name="message" type="text-area" />
    @error('message')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    <button type="submit" class="bg-primary mt-3 px-4 py-2 rounded-md text-white flex items-center gap-2 justify-center"
        id="submit-btn" wire:loading.attr="disabled">
        <i class="fa-solid fa-spinner animate-rotate" wire:loading></i> <span>Add Testimonial</span>
    </button>

    @if (session()->has('message'))
        <div class="p-4 mt-3 text-green-700 bg-green-100 rounded-md">
            {{ session('message') }}
        </div>
    @endif
</form>
