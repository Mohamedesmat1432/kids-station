@props(['permission', 'id', 'name'])

@can($permission)
    <x-indigo-button wire:click.live="$dispatch('restore-modal',{id:'{{ $id }}',name:'{{ $name }}'})"
        wire:loading.attr="disabled">
        <x-icon class="w-4 h-4" name="arrow-uturn-left" />
    </x-indigo-button>
@else
    <x-indigo-button class="cursor-not-allowed opacity-60">
        <x-icon class="w-4 h-4" name="arrow-uturn-left" />
    </x-indigo-button>
@endcan
