<form wire:submit.prevent="authenticate" class="relative z-10">
    <div class="mb-4">
        <label class="block text-white mb-2" for="username">
            Email
        </label>
        <input wire:model="email" class="w-full px-2 py-3 rounded bg-white text-xs" id="username" name="username"
            type="text" placeholder="Email" />
        @error('email')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-4">
        <label class="block text-white mb-2" for="username">
            Password
        </label>
        <div class="relative">
            <input wire:model="password" class="w-full px-2 py-3 rounded bg-white text-xs" id="password"
                name="password" type={{ $showPassword ? 'text' : 'password' }} placeholder="Password" />
            @error('password')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <div class="cursor-pointer absolute right-2 top-3 flex items-center" wire:click="show_password">
                @if ($showPassword)
                    <i class="fa-solid fa-eye-slash"></i>
                @else
                    <i class="fa-solid fa-eye"></i>
                @endif
            </div>
        </div>
    </div>
    <div class="flex items-center mb-4">
        <input class="mr-2" wire:model="remember" id="keep-logged-in" name="keep-logged-in" type="checkbox" />
        <label class="text-white" for="keep-logged-in">
            Keep me logged in
        </label>
    </div>
    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded" type="submit"
        wire:loading.attr="disabled">
        <i class="fa-solid fa-spinner animate-rotate" wire:loading></i>
        Log in
    </button>
</form>
