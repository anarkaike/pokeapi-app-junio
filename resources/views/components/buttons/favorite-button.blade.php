@props(['isFavorite', 'action'])

<x-tooltip :text="$isFavorite ? __('Desfavoritar') : __('Favoritar')">
    <form action="{{ $action }}" method="POST">
        @csrf
        <button type="submit"
            {{ $attributes->merge(['class' => 'p-1 transition-colors ' . ($isFavorite ? 'text-yellow-500' : 'text-gray-300 hover:text-gray-500')]) }}>
            <x-icons.star :filled="$isFavorite" />
        </button>
    </form>
</x-tooltip>
