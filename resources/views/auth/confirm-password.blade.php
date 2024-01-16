<x-guest-layout>
    <x-slot name="title">
        {{ __('site.confirm_password') }}
    </x-slot>

    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-label for="password" value="{{ __('site.password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-between mt-4">
                <x-auth-indigo-button>
                    {{ __('site.confirm') }}
                </x-auth-indigo-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
