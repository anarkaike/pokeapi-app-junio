<div x-data="{
    totalLocal: 0,
    totalApi: 0,
    isSyncing: false,
    interval: null,
    isLoaded: false,

    init() {
        this.checkProgress();
    },

    checkProgress() {
        fetch('{{ route('pokemons.sync-progress') }}')
            .then(res => res.json())
            .then(data => {
                this.totalLocal = data.total_local;
                this.totalApi = data.total_api;

                if (this.isLoaded && this.isSyncing && !data.is_syncing) {
                    window.location.reload();
                }

                this.isSyncing = data.is_syncing;
                this.isLoaded = true;

                if (this.isSyncing && !this.interval) {
                    this.interval = setInterval(() => this.checkProgress(), 2000);
                } else if (!this.isSyncing && this.interval) {
                    clearInterval(this.interval);
                    this.interval = null;
                }
            });
    }
}">
    <form action="{{ route('pokemons.sync-all') }}" method="POST" @submit="isSyncing = true">
        @csrf
        <button type="submit" x-bind:disabled="!isLoaded || isSyncing || (totalLocal >= totalApi && totalApi > 0)"
            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed shadow-md">

            <span x-show="!isLoaded" class="flex items-center">
                <x-icons.spinner-icon class="size-4 mr-2" />
                {{ __('Calculando fila...') }}
            </span>

            <template x-if="isLoaded && totalLocal >= totalApi && totalApi > 0">
                <span class="flex items-center">
                    <svg class="size-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('Sincronizado') }} (<span x-text="totalApi"></span>)
                </span>
            </template>

            <template x-if="isLoaded && totalLocal < totalApi && !isSyncing">
                <span class="flex items-center">
                    <x-icons.refresh-icon class="size-4 mr-2" />
                    {{ __('Sincronizar Todos') }} (<span x-text="totalLocal"></span> / <span x-text="totalApi"></span>)
                </span>
            </template>

            <template x-if="isLoaded && isSyncing && totalLocal < totalApi">
                <span class="flex items-center">
                    <x-icons.spinner-icon class="size-4 mr-2" />
                    {{ __('Sincronizando...') }} (<span x-text="totalLocal"></span> / <span x-text="totalApi"></span>)
                </span>
            </template>

        </button>
    </form>
</div>
