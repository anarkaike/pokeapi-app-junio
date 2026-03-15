@props(['pokemon'])

<div {{ $attributes->merge(['class' => 'relative flex flex-col md:flex-row items-center gap-2 pb-5 md:pb-0']) }}>

    <a href="{{ request()->fullUrlWithQuery(['selected' => null]) }}"
        class="absolute top-2 right-2 text-gray-400 hover:text-red-500 transition-colors p-1" title="Fechar">

        <x-tooltip text="Fechar Pokémon selecionado">
            <x-icons.close class="size-6" />
        </x-tooltip>
    </a>

    <div class="mr-5">
        <img src="{{ $pokemon->spriteUrl }}" alt="{{ $pokemon->name }}" class="size-28 object-contain drop-shadow">
    </div>

    <div class="flex flex-col justify-center text-center md:text-left">
        <div class="text-sm">Pokémon Selecionado</div>
        <h2 class="text-3xl font-black capitalize text-gray-800 leading-none mb-2">
            {{ $pokemon->name }}
        </h2>
        <x-tooltip text="Tipo{{ $pokemon->types > 1 ? 's' : '' }} deste pokemón">
            <div class="flex flex-wrap gap-2 md:justify-start justify-center">
                @foreach ($pokemon->types as $type)
                    <span
                        class="px-3 py-1 bg-gray-100 text-[10px] font-bold rounded uppercase text-gray-600 border border-gray-200 tracking-wider">
                        {{ $type }}
                    </span>
                @endforeach
            </div>
        </x-tooltip>
    </div>

    <div class="flex flex-col justify-center space-y-2 md:pl-8">
        <div>
            <h4 class="text-[12px] font-bold uppercase text-gray-400 text-center md:text-left">
                Informações Base
            </h4>
            <p class="text-[11px] text-gray-500">
                <span class="text-blue-700 py-1 rounded"><b>Altura:</b>
                    {{ $pokemon->height / 10 }}m</span>
                <span class="text-green-700 py-1 rounded"><b>Peso:</b>
                    {{ $pokemon->weight / 10 }}kg</span>
            </p>
        </div>
        <div>
            <h4 class="text-[12px] font-bold uppercase text-gray-400 text-center md:text-left">
                Habilidades
            </h4>
            <p class="text-[11px] text-gray-500">
                @foreach (array_slice($pokemon->abilities, 0, 3) as $ability)
                    <span class="text-gray-700 py-1 text-xs capitalize font-medium">
                        {{ str_replace('-', ' ', $ability) }}
                    </span>
                    @if (!$loop->last)
                        •
                    @endif
                @endforeach
            </p>
        </div>
    </div>

    <div class="flex flex-col justify-center space-y-2 md:pl-8">
        <div>
            <h4 class="text-[12px] font-bold uppercase text-gray-400 text-center md:text-left">
                Movimentos Principais
            </h4>
            <p class="text-[11px] text-gray-500">
                @foreach ($pokemon->moves as $move)
                    <span class="capitalize">{{ str_replace('-', ' ', $move) }}</span>
                    @if (!$loop->last)
                        •
                    @endif
                @endforeach
            </p>
        </div>
        <div>
            <h4 class="text-[12px] font-bold uppercase text-gray-400 text-center md:text-left">
                Sincronização
            </h4>
            <p class="text-[11px] text-gray-500">
                @if ($pokemon->syncedAt)
                    <p class="text-[10px] text-gray-400 mt-1 italic">
                        {{ __('Última atualização: :date', ['date' => $pokemon->syncedAt->diffForHumans()]) }}
                    </p>
                @endif
            </p>
        </div>
    </div>
</div>
