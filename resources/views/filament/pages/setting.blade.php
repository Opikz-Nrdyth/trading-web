<x-filament-panels::page>
    @if ($images)
        <div class="mb-4">
            <img src="{{ asset('storage/' . $images) }}" width="120px" alt="company_logo"
                class="max-w-xs rounded-lg shadow-sm">
        </div>
    @endif
    <form wire:submit="save">
        {{ $this->form }}
        <div class="mt-6 flex items-center gap-x-3">
            @foreach ($this->getFormActions() as $action)
                {{ $action }}
            @endforeach
        </div>
    </form>
</x-filament-panels::page>
