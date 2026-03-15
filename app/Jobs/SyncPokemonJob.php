<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\{ Queue\Queueable, Bus\Dispatchable };
use Illuminate\Queue\{ InteractsWithQueue, SerializesModels };
use App\Contracts\PokeApiInterface;
use App\Services\PokemonImporter;

class SyncPokemonJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $pokemonName) {}

    public function handle(PokeApiInterface $apiClient, PokemonImporter $importer): void
    {
        try {
            $data = $apiClient->fetchPokemon($this->pokemonName);
            $importer->import($data);
        } catch (\Exception $e) {
            \Log::error("Falha ao sincronizar {$this->pokemonName}: " . $e->getMessage());
            throw $e;
        }
    }
}