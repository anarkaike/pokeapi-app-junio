@props(['label' => 'Sincronizar', 'loadingLabel' => 'Sincronizando...'])

<button type="submit" :disabled="loading"
    {{ $attributes->merge(['class' => 'w-full flex justify-center items-center gap-2 rounded border border-gray-200 bg-white py-1 text-xs font-semibold text-gray-600 transition-all hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed']) }}>

    <x-icons.refresh-icon x-show="!loading" />
    <x-icons.spinner-icon x-show="loading" style="display: none;" class="text-blue-500" />

    <span x-text="loading ? '{{ $loadingLabel }}' : '{{ $label }}'"></span>
</button>
