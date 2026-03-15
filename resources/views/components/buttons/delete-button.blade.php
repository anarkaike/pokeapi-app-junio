@props([
    'action',
    'title' => 'Excluir item?',
    'description' => 'Tem certeza que deseja excluir este registro?',
    'confirmText' => 'Sim, excluir',
])

<x-confirm-modal :action="$action" method="DELETE" :title="$title" :description="$description" :confirmText="$confirmText">
    <x-slot name="trigger">
        <x-tooltip text="Excluir">
            <button type="button"
                {{ $attributes->merge(['class' => 'p-1 text-gray-300 transition-colors hover:text-red-500']) }}
                title="Excluir">
                <x-icons.trash />
            </button>
        </x-tooltip>
    </x-slot>
</x-confirm-modal>
