<div class="group mt-3">
    <label for="{{ $name }}"
        class="ml-[2.5%] mb-2 block group-focus-within:text-white peer-focus:text-white">{{ $label }}</label>

    @if ($type == 'text-area')
        <textarea id="{{ $name }}" name="{{ $name }}" @if ($disabled) disabled @endif
            placeholder="{{ $placeholder }}" @if ($model) wire:model.defer="{{ $model }}" @endif
            class="peer w-[95%] ml-[2.5%] py-3 px-2 @if ($disabled) bg-base-input-disabled @else bg-base-input @endif text-white outline-primary border-none rounded-md">{{ $value }}</textarea>
    @else
        <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
            placeholder="{{ $placeholder }}" @if ($disabled) disabled @endif
            value="{{ $value }}"
            @if ($model) wire:model.defer="{{ $model }}" @endif
            class="peer w-[95%] ml-[2.5%] py-3 px-2 @if ($disabled) bg-base-input-disabled @else bg-base-input @endif text-white outline-primary border-none rounded-md">
    @endif
</div>
