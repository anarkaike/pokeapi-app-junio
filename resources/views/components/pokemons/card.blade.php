@props(['pokemon', 'local', 'isSincronizado', 'isFavorite', 'imageUrl', 'selectionUrl', 'isSelected' => false])

@php
    $statusClasses = $isSincronizado ? 'border-green-200 bg-green-50/20' : 'border-gray-100 bg-white';
    $imageOpacity = $isSincronizado ? '' : 'grayscale opacity-50';
    $selectedClasses = $isSelected ? 'border-blue-500 bg-gray-100 shadow-lg scale-[1.01] z-10' : 'hover:shadow-md';
@endphp

<div
    {{ $attributes->merge([
        'class' => "group relative flex flex-col items-center rounded-xl border p-4 transition-all duration-200 
                    $statusClasses $selectedClasses",
    ]) }}>

    <a href="{{ $selectionUrl }}" class="flex w-full flex-col items-center transition-opacity hover:opacity-80">
        <div class="mb-3 size-28">
            <img src="{{ $imageUrl }}" alt="{{ $pokemon['name'] }}" loading="lazy"
                class="size-full object-contain drop-shadow transition-transform group-hover:scale-105 {{ $imageOpacity }}">
        </div>

        <h3 class="text-lg font-black tracking-tight capitalize text-gray-900">
            {{ $pokemon['name'] }}
        </h3>
    </a>

    <x-pokemons.actions :pokemon="$pokemon" :local="$local" :isSincronizado="$isSincronizado" :isFavorite="$isFavorite" />
</div>
