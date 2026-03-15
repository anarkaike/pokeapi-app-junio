<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <x-nav.logo /> <x-nav.menu />
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent rounded-md bg-white hover:text-gray-700 transition">
                            <x-nav.user-info :user="Auth::user()" />
                            <x-icons.chevron-down class="ms-1 size-4" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Meu Perfil') }}</x-dropdown-link>
                        <x-nav.logout-button />
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <x-nav.hamburger />
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden border-t border-gray-100 bg-gray-50">
        <x-nav.menu mobile />
        <div class="pt-4 pb-1 border-t border-gray-200 px-4 flex justify-between items-center">
            <x-nav.user-info :user="Auth::user()" mobile />
            <x-nav.logout-button responsive />
        </div>
    </div>
</nav>
