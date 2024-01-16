<x-app-layout>
    <x-slot name="title">
        {{ __('site.home') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('site.home') }}
        </h2>
    </x-slot>

    <div>
        <x-home />
    </div>
</x-app-layout>
