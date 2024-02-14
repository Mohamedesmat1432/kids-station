@props(['permission', 'id'])

<span x-data="{ tooltip: false }" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="relative">

    <div x-show="tooltip" class="absolute bg-gray-500 rounded-md bottom-8 z-10 text-white px-2">
        {{ __('site.attach') }}
    </div>

    @can($permission)
        <x-indigo-button wire:click.live="$dispatch('attach-modal',{id:'{{ $id }}'})" wire:loading.attr="disabled">
            <x-icon class="w-4 h-4" name="paper-clip" />
        </x-indigo-button>
    @else
        <x-indigo-button class="cursor-not-allowed opacity-60">
            <x-icon class="w-4 h-4" name="paper-clip" />
        </x-indigo-button>
    @endcan
</span>
