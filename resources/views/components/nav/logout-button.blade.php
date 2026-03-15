@props(['responsive' => false])

<form method="POST" action="{{ route('logout') }}" x-data>
    @csrf
    @if ($responsive)
        <x-responsive-nav-link :href="route('logout')" @click.prevent="$root.submit()">
            {{ __('Sair do Sistema') }}
        </x-responsive-nav-link>
    @else
        <x-dropdown-link :href="route('logout')" @click.prevent="$root.submit()">
            {{ __('Sair do Sistema') }}
        </x-dropdown-link>
    @endif
</form>
