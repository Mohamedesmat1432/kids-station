@props(['pageName'])

<div>
    <x-slot name="title"> 
        {{ $pageName }} 
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $pageName }}
        </h2>
    </x-slot>

    <div class="bg-gray-50 overflow-hidden shadow-xl p-8">
        {{ $slot }}
    </div>
</div>
