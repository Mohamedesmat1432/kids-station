<x-guest-layout>
    <x-slot name="title">
        {{ __('site.login') }}
    </x-slot>

    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('site.email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="{{ __('site.email') }}" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div x-data="{ showPassword: false }" class="mt-4">
                <x-label for="password" value="{{ __('site.password') }}" />
                <div class="relative">
                    <x-input id="password" class="block mt-1 w-full" ::type="showPassword ? 'text' : 'password'" name="password" required
                        placeholder="{{ __('site.password') }}" autocomplete="current-password" />
                    <button class="absolute inset-y-0 rtl:left-0 ltr:right-0 px-3 flex items-center cursor-pointer"
                        x-on:click="showPassword = ! showPassword" type="button">
                        <x-icon name="eye" x-show="showPassword" />
                        <x-icon name="eye-slash" x-show="!showPassword" />
                    </button>
                </div>
            </div>

            <div class="mt-4 flex justify-between">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="mx-2 text-sm text-gray-600">{{ __('site.remember_me') }}</span>
                </label>

                @if (Route::has('register'))
                    <a wire:navigate
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('register') }}">
                        {{ __('site.i_dont_have_account') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a wire:navigate
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('site.forgot_your_password') }}
                    </a>
                @endif

                <x-auth-indigo-button>
                    {{ __('site.login') }}
                </x-auth-indigo-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
