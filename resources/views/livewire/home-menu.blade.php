<div>
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="/">
                            <x-application-mark class="block h-9 w-auto" />
                        </a>
                    </div>
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        @auth
                            <x-nav-link wire:navigate href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                {{ __('site.dashboard') }}
                            </x-nav-link>
                        @else
                            <x-nav-link wire:navigate href="{{ route('login') }}" :active="request()->routeIs('login')">
                                {{ __('site.login') }}
                            </x-nav-link>
                            @if (Route::has('register'))
                                <x-nav-link wire:navigate href="{{ route('register') }}" :active="request()->routeIs('register')">
                                    {{ __('site.register') }}
                                </x-nav-link>
                            @endif
                        @endauth

                        <!-- Lang Dropdown -->
                        <x-lang-dropdwon />
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            <div class="pt-2 pb-1 border-t border-gray-200">

                <div class="mt-1 space-y-1">
                    <!-- Account Management -->
                    @if (Route::has('login'))
                        @auth
                            <x-responsive-nav-link class="flex" wire:navigate href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                {{ __('site.dashboard') }}
                            </x-responsive-nav-link>
                        @else
                            <x-responsive-nav-link class="flex" wire:navigate href="{{ route('login') }}" :active="request()->routeIs('login')">
                                <x-icon name="arrow-right-on-rectangle" class="h-6 w-5" />
                                {{ __('site.login') }}
                            </x-responsive-nav-link>

                            @if (Route::has('register'))
                                <x-responsive-nav-link class="flex" wire:navigate href="{{ route('register') }}" :active="request()->routeIs('register')">
                                    <x-icon name="plus" class="h-6 w-5" />
                                    {{ __('site.register') }}
                                </x-responsive-nav-link>
                            @endif

                            <!-- Lang Dropdown Responsive -->
                            <x-lang-dropdwon-responsive />
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>
</div>
