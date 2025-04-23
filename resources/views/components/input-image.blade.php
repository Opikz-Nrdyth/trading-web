<div class="mt-4">
    <label for="{{ $name }}" class="block mb-2 text-sm ">{{ $label }}</label>
    <div class="flex items-center border rounded-md bg-base-input text-white">
        <input type="text" id="{{ $name }}_text" readonly
            class="flex-grow py-2 px-3 bg-transparent placeholder-gray-600 focus:outline-none">
        <label for="{{ $name }}"
            class="px-3 py-3 bg-primary text-white text-sm font-medium cursor-pointer rounded-r-md">
            Select File
        </label>
        <input type="file" wire:model="{{ $model }}" id="{{ $name }}" name="{{ $name }}"
            class="hidden"
            onchange="document.getElementById('{{ $name }}_text').value = this.files[0]?.name || ''">
    </div>
</div>
