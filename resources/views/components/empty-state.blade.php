@props([
    'title'       => __('Nenhum registro encontrado'),
    'description' => __('Não encontramos resultados para os filtros aplicados.'),
    'resetRoute'  => null,
    'resetText'   => __('Limpar todos os filtros'),
    'fields'      => ['search'],
])

<div
    {{ $attributes->merge(['class' => 'col-span-full py-20 flex flex-col items-center justify-center text-gray-500']) }}>

    <x-icons.search class="size-16 mb-4 text-gray-300" />

    <p class="text-xl font-bold text-gray-400">{{ $title }}</p>

    @if ($description)
        <p class="text-sm text-gray-400 mt-1">{{ $description }}</p>
    @endif

    @if ($resetRoute && request()->anyFilled($fields))
        <a href="{{ $resetRoute }}"
            class="mt-6 text-red-500 hover:text-red-700 font-semibold text-sm underline transition-colors">
            {{ $resetText }}
        </a>
    @endif
</div>
