<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
                Detalhes: {{ $pokemonData->name }}
            </h2>
            <a href="{{ route('pokemons.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Voltar para
                Listagem</a>
        </div>
    </x-slot>

    <x-box-container>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 flex flex-col md:flex-row gap-8">

                <div class="w-full md:w-1/3 flex flex-col items-center bg-gray-50 rounded-xl p-6 border border-gray-100">
                    <img src="{{ $pokemonData->spriteUrl ?? 'https://via.placeholder.com/150' }}"
                        alt="{{ $pokemonData->name }}" class="w-48 h-48 drop-shadow-md">
                    <h1 class="text-3xl font-black capitalize mt-4 mb-2">{{ $pokemonData->name }}</h1>

                    <div class="flex space-x-2 mt-2">
                        @foreach ($pokemonData->types as $type)
                            <span
                                class="px-3 py-1 bg-gray-200 text-gray-800 text-xs font-bold rounded-full uppercase">{{ $type }}</span>
                        @endforeach
                    </div>

                    <div class="mt-6 w-full space-y-2 text-sm text-gray-600">
                        <div class="flex justify-between border-b pb-1"><span>Altura:</span>
                            <strong>{{ $pokemonData->height / 10 }}m</strong>
                        </div>
                        <div class="flex justify-between border-b pb-1"><span>Peso:</span>
                            <strong>{{ $pokemonData->weight / 10 }}kg</strong>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-2/3 space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4">Habilidades (Abilities)</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($pokemonData->abilities as $ability)
                                <span
                                    class="bg-blue-50 text-blue-700 border border-blue-200 px-3 py-1 rounded-lg text-sm capitalize">{{ str_replace('-', ' ', $ability) }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4">Movimentos (Moves)</h3>
                        <div class="h-64 overflow-y-auto pr-4 flex flex-wrap gap-2 content-start">
                            @foreach ($pokemonData->moves as $move)
                                <span
                                    class="bg-gray-100 text-gray-600 border border-gray-200 px-2 py-1 rounded text-xs capitalize">{{ str_replace('-', ' ', $move) }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-box-container>
</x-app-layout>
