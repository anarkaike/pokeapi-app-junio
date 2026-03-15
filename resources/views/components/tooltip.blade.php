@props(['text'])

<div x-data="{ open: false }" class="relative inline-flex items-center group" @mouseenter="open = true"
    @mouseleave="open = false">
    {{ $slot }}
    <div x-show="open" x-cloak 
        class="absolute bottom-full left-1/2 z-50 mb-2 -translate-x-1/2 transform pointer-events-none">

        <div class="relative rounded bg-gray-900 px-2 py-1 text-xs font-medium text-white shadow-lg whitespace-nowrap">
            {{ $text }}
            <div class="absolute top-full left-1/2 -mt-1 -ml-1 border-4 border-transparent border-t-gray-900"></div>
        </div>
    </div>
</div>
