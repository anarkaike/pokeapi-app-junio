<x-guest-layout image="images/image3.png" imageAlt="Novo Cadastro" imageClass="!h-[480px]">

    <h2 class="text-3xl font-extrabold text-gray-900 -mb-2">
        Nova Conta
    </h2>
    <p>Registre para poder visualizar os dados dos Pokémons.</p>

    <form method="POST" action="{{ route('register') }}" class="pt-2">
        @csrf

        <div>
            <x-input-label for="name">
                {{ __('Nome') }}
                <x-required-hint tooltip="O nome é obrigatório." />
            </x-input-label>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email">
                {{ __('Email') }}
                <x-required-hint tooltip="O email é obrigatório." />
            </x-input-label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password">
                {{ __('Senha') }}
                <x-required-hint tooltip="A senha é obrigatório." />
            </x-input-label>

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation">
                {{ __('Repetir Senha') }}
                <x-required-hint tooltip="A confirmação da senha é obrigatória." />
            </x-input-label>

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-5 space-x-2">

            <x-buttons.secondary-button href="{{ route('home') }}" border=''>
                {{ __('← Voltar') }}
            </x-buttons.secondary-button>

            <x-buttons.secondary-button href="{{ route('login') }}" border=''>
                {{ __('Já tem conta? Entre!') }}
            </x-buttons.secondary-button>

            <x-buttons.primary-button class="ms-3">
                {{ __('Cadastrar') }}
            </x-buttons.primary-button>
        </div>
    </form>
</x-guest-layout>
