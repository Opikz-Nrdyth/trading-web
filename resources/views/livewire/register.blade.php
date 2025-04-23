<form wire:submit.prevent="regist">
    <div class="mb-4">
        <label class="block text-white mb-2" for="username">
            Username <span class="text-red-500">*</span>
        </label>
        <input wire:model="username" class="w-full px-2 py-3 rounded bg-white text-xs" id="username" name="username"
            type="text" placeholder="Username" />
        @error('username')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-4">
        <label class="block text-white mb-2" for="name">
            Full Name <span class="text-red-500">*</span>
        </label>
        <input wire:model="name" class="w-full px-2 py-3 rounded bg-white text-xs" id="name" name="name"
            type="text" placeholder="Name" />
        @error('name')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-4">
        <label class="block text-white mb-2" for="email">
            Email <span class="text-red-500">*</span>
        </label>
        <input wire:model="email" class="w-full px-2 py-3 rounded bg-white text-xs" id="email" name="email"
            type="text" placeholder="Email" />
        @error('email')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-4">
        <label class="block text-white mb-2" for="password">
            Password <span class="text-red-500">*</span>
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
    <div class="mb-4">
        <label class="block text-white mb-2" for="conf_pass">
            Confirm Password <span class="text-red-500">*</span>
        </label>
        <div class="relative">
            <input wire:model="confirm_password" class="w-full px-2 py-3 rounded bg-white text-xs" id="conf_pass"
                name="password" type={{ $showPassword ? 'text' : 'password' }} placeholder="Confirm Password" />
            @error('confirm_password')
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
    <div class="mb-4">
        <label class="block text-white mb-2" for="referals">
            Referals <span class="text-red-500">*</span>
        </label>
        <input wire:model="referals" class="w-full px-2 py-3 rounded bg-white text-xs" id="referals" name="username"
            type="text" placeholder="Username Referals" />
        @error('referals')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <button class="w-full bg-blue-600 text-white py-2 rounded" type="submit" wire:loading.attr="disabled">
        <i class="fa-solid fa-spinner animate-rotate" wire:loading></i>
        Register
    </button>
</form>
