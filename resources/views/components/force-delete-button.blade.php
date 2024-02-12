@props(['permission', 'id', 'name'])

<span x-data="{ tooltip: false }" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="relative">
    
    <div x-show="tooltip" class="absolute bg-gray-500 rounded-md bottom-8 z-10 text-white px-2">
        {{ __('site.force_delete') }}
    </div>
    
    @can($permission)
        <x-danger-button
            wire:click.live="$dispatch('force-delete-modal',{id:'{{ $id }}',name:'{{ $name }}'})"
            wire:loading.attr="disabled">
            <x-icon class="w-4 h-4" name="trash" />
        </x-danger-button>
    @else
        <x-danger-button class="cursor-not-allowed opacity-60">
            <x-icon class="w-4 h-4" name="trash" />
        </x-danger-button>
    @endcan
</span>
