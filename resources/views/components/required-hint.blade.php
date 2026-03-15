@props(['tooltip' => 'Este campo é obrigatório'])

<x-tooltip :text="$tooltip">
    <span class="cursor-help font-bold text-red-500 px-0.5">*</span>
</x-tooltip>
