@props(['action', 'pokemonName'])

<form action="{{ $action }}" method="POST" x-data="{ loading: false }" @submit="loading = true">
    @csrf
    <input type="hidden" name="name" value="{{ $pokemonName }}">

    <x-tooltip text="Resincronizar">
        <button type="submit" x-bind:disabled="loading"
            {{ $attributes->merge(['class' => 'p-2 text-blue-500 hover:text-blue-700 transition-colors disabled:opacity-50']) }}
            title="Resincronizar dados">
            <x-icons.refresh-icon x-show="!loading" />
            <x-icons.spinner-icon x-show="loading" style="display: none;" class="text-blue-500" />
        </button>
    </x-tooltip>
</form>
