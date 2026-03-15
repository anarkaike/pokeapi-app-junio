<?php
namespace App\DTOs;

use Illuminate\Support\Carbon;

readonly class PokemonData
{
    public function __construct(
        public int      $apiId,
        public string   $name,
        public int      $height,
        public int      $weight,
        public string   $spriteUrl,
        public array    $types,
        public array    $abilities,
        public array    $moves,
        public ?Carbon  $syncedAt = null,
    ) {}

    /**
     * Create a PokemonData instance from the API response data.
     */
    public static function fromApi(array $data): self
    {
        return new self(
            apiId:      $data['id'],
            name:       $data['name'],
            height:     $data['height'],
            weight:     $data['weight'],
            spriteUrl:  data_get($data, 'sprites.other.official-artwork.front_default') ?? 'https://ipe.digital/wp-content/themes/bootscore-child-main/img/logo/logo.svg?t=' . fake()->numberBetween(1, 151),
            types:      collect($data['types'])     ->pluck('type.name')            ->toArray(),
            abilities:  collect($data['abilities']) ->pluck('ability.name')         ->toArray(),
            moves:      collect($data['moves'])     ->take(5)->pluck('move.name')   ->toArray(),
            syncedAt:   null
        );
    }

    /**
     * Create a PokemonData instance from a local Pokemon model.
     */
    public static function fromModel(\App\Models\Pokemon $model): self
    {
        return new self(
            name:       $model->name,
            apiId:      $model->api_id,
            spriteUrl:  $model->sprite_url,
            types:      $model->types->pluck('name')->toArray() ?? [],
            abilities:  $model->abilities->pluck('name')->toArray() ?? [],
            moves:      $model->moves->pluck('name')->toArray() ?? [],
            height:     $model->height ?? 0,
            weight:     $model->weight ?? 0,
            syncedAt:   $model->synced_at
        );
    }
}
