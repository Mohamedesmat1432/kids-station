<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ config('app.direction') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Laravel' }}</title>
    {{-- Fonts EN --}}
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
    {{-- Fonts AR --}}
    @vite('resources/js/app.js')
    <link href="{{ asset('css/font-cairo.css') }}" rel="stylesheet">
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">


    <livewire:styles />
</head>

<body>

    <div class="font-sans antialiased min-h-screen bg-gray-100">
        @auth
            <livewire:navigate-menu />
            <livewire:chat.group-chat />
        @else
            @include('home-menu')
        @endauth

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
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

    <livewire:scripts />
</body>

</html>
