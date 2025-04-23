<div class="border-b border-slate-200 text-base-text bg-base-card px-3">
    <button onclick="toggleAccordion({{ $id }})"
        class="w-full flex justify-between items-center py-5 text-white">
        <span>{{ $title }}</span>
        <span id="icon-{{ $id }}" class="transition-transform duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                <path
                    d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
            </svg>
        </span>
    </button>
    <div id="content-{{ $id }}" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out px-5">
        <div class="pb-5 text-sm text-base-text">
            {{ $content }}
        </div>
    </div>
</div>
