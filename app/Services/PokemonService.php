<?php

namespace App\Services;

use Illuminate\Support\Facades\{ Auth, Cache, Queue };
use App\Models\Pokemon;
use App\Contracts\PokeApiInterface;

class PokemonService
{
    public function __construct(protected PokeApiInterface $apiClient) {}

    public function getSyncProgress(): array
    {
        $totalLocal = Pokemon::count();
        
        $totalApi = Cache::remember('api_pokemon_total', 3600, function () {
            return $this->apiClient->fetchList(1, 0)['count'];
        });
        
        $pendingJobs = Queue::size();

        return [
            'total_local'  => $totalLocal,
            'total_api'    => $totalApi,
            'pending_jobs' => $pendingJobs,
            'is_syncing'   => $pendingJobs > 0,
        ];
    }

    public function getList(string $search = '', bool $showFavorites = false, string $syncStatus = 'all', int $page = 1, int $limit = 12): array
    {
        if ($showFavorites) {
            if ($syncStatus === 'unsynced') {
                return ['results' => [], 'count' => 0, 'totalPages' => 1];
            }
            return $this->getLocalPokemons($search, true, $page, $limit);
        }

        if ($syncStatus === 'synced') {
            return $this->getLocalPokemons($search, false, $page, $limit);
        }

        if ($syncStatus === 'unsynced' || $search) {
            return $this->getFilteredApiPokemons($search, $syncStatus === 'unsynced', $page, $limit);
        }

        return $this->getDefaultList($page, $limit);
    }

    public function getLocalPokemonsByNames(array $names)
    {
        return Pokemon::with('favoritedBy')
            ->whereIn('name', $names)
            ->get()
            ->keyBy(fn($item) => strtolower($item->name));
    }

    private function getLocalPokemons(string $search, bool $onlyFavorites, int $page, int $limit): array
    {
        $query = $onlyFavorites ? Auth::user()->favorites() : Pokemon::query();
        
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $paginator = $query->paginate($limit, ['*'], 'page', $page);
        
        $results = $paginator->map(function($poke) {
            return [
                'name' => strtolower($poke->name),
                'url'  => "https://pokeapi.co/api/v2/pokemon/{$poke->api_id}/"
            ];
        });

        return [
            'results'    => $results->toArray(),
            'count'      => $paginator->total(),
            'totalPages' => $paginator->lastPage() ?: 1,
        ];
    }

    private function getFilteredApiPokemons(string $search, bool $onlyUnsynced, int $page, int $limit): array
    {
        $allData = Cache::remember('api_pokemon_full_list', 3600, function () {
            return $this->apiClient->fetchList(2000, 0);
        });
        
        $collection = collect($allData['results']);

        if ($search) {
            $collection = $collection->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['name']), $search);
            });
        }

        if ($onlyUnsynced) {
            $syncedNamesMap = Pokemon::pluck('name')
                                ->map(fn($n) => strtolower($n))
                                ->flip()
                                ->toArray();
            
            $collection = $collection->reject(function ($item) use ($syncedNamesMap) {
                return isset($syncedNamesMap[strtolower($item['name'])]);
            });
        }

        $collection = $collection->values();
        $count = $collection->count();

        return [
            'results'    => $collection->slice(($page - 1) * $limit, $limit)->toArray(),
            'count'      => $count,
            'totalPages' => (int) ceil($count / $limit) ?: 1,
        ];
    }

    private function getDefaultList(int $page, int $limit): array
    {
        $offset  = ($page - 1) * $limit;
        $apiData = $this->apiClient->fetchList($limit, $offset);
        
        return [
            'results'    => $apiData['results'],
            'count'      => $apiData['count'],
            'totalPages' => (int) ceil($apiData['count'] / $limit) ?: 1,
        ];
    }
}