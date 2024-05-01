<div>
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a wire:navigate href="{{ route('dashboard') }}">
                            <x-application-mark class="block h-8 w-auto" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link class="flex" wire:navigate href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            <x-icon name="chart-bar-square" class="h-5 w-5" />
                            {{ __('site.dashboard') }}
                        </x-nav-link>

                        @foreach ($responsive_links as $link)
                            @can($link['role'])
                                <x-nav-link wire:navigate href="{{ route($link['name']) }}" :active="request()->routeIs($link['name'])">
                                    <x-icon name="{{ $link['icon'] }}" class="h-5 w-5" />
                                    {{ __($link['value']) }}
                                </x-nav-link>
                            @endcan
                        @endforeach

                        <!-- Lang Dropdown -->
                        <x-lang-dropdwon />
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        <x-dropdown align="{{ __('site.right') }}" width="56">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('site.manage_account') }}
                                </div>

                                @foreach ($dropdown_links as $link)
                                    @can($link['role'])
                                        <x-dropdown-link wire:navigate href="{{ route($link['name']) }}" :active="request()->routeIs($link['name'])">
                                            <x-icon name="{{ $link['icon'] }}" class="w-5 h-5 inline-block" />
                                            {{ __($link['value']) }}
                                        </x-dropdown-link>
                                    @endcan
                                @endforeach

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        <x-icon name="arrow-left-on-rectangle"
                                            class="h-5 w-5 float-{{ __('site.left') }}" />
                                        {{ __('site.logout') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
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
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover"
                                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-responsive-nav-link class="flex" wire:navigate href="{{ route('dashboard') }}"
                        :active="request()->routeIs('dashboard')">
                        <x-icon name="chart-bar-square" class="h-5 w-5" />
                        {{ __('site.dashboard') }}
                    </x-responsive-nav-link>

                    @foreach ($responsive_links as $link)
                        @can($link['role'])
                            <x-responsive-nav-link class="flex" wire:navigate href="{{ route($link['name']) }}"
                                :active="request()->routeIs($link['name'])">
                                <x-icon name="{{ $link['icon'] }}" class="h-5 w-5" />
                                {{ __($link['value']) }}
                            </x-responsive-nav-link>
                        @endcan
                    @endforeach

                    @foreach ($dropdown_links as $link)
                        @can($link['role'])
                            <x-responsive-nav-link class="flex" wire:navigate href="{{ route($link['name']) }}"
                                :active="request()->routeIs($link['name'])">
                                <x-icon name="{{ $link['icon'] }}" class="h-5 w-5" />
                                {{ __($link['value']) }}
                            </x-responsive-nav-link>
                        @endcan
                    @endforeach

                    <!-- Lang Dropdown Responsive -->
                    <x-lang-dropdwon-responsive />

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link class="flex" href="{{ route('logout') }}"
                            @click.prevent="$root.submit();">
                            <x-icon name="arrow-left-on-rectangle" class="h-5 w-5" />
                            {{ __('site.logout') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</div>
