@props(['currentPage', 'totalPages', 'routeName'])

<nav class="flex items-center justify-between text-sm text-gray-500">
    <a href="{{ $currentPage > 1 ? request()->fullUrlWithQuery(['page' => $currentPage - 1]) : '#' }}"
        class="p-2 transition-colors hover:text-gray-900 {{ $currentPage <= 1 ? 'pointer-events-none opacity-30' : '' }}">
        &larr; Anterior
    </a>

    <span>
        <strong class="text-gray-900">{{ $currentPage }}</strong> / {{ $totalPages }}
    </span>

    <a href="{{ $currentPage < $totalPages ? request()->fullUrlWithQuery(['page' => $currentPage + 1]) : '#' }}"
        class="p-2 transition-colors hover:text-gray-900 {{ $currentPage >= $totalPages ? 'pointer-events-none opacity-30' : '' }}">
        Próximo &rarr;
    </a>
</nav>
