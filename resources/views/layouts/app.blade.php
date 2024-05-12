<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Laravel' }}</title>

    {{-- Fonts EN --}}
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

    {{-- Fonts AR --}}

    @stack('styles')

    @livewireStyles

    @vite('resources/js/app.js')
</head>

<body>

    <div class="font-sans antialiased min-h-screen bg-gray-100">
        @auth
            <livewire:navigate-menu />
            {{-- <livewire:chat.group-chat /> --}}
        @else
            <livewire:home-menu />
        @endauth

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow border-b border-gray-100">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between">
                    <div>{{ $header }}</div>
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            <x-notify />

            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @stack('scriptPage')

    @livewireScripts
</body>

</html>
