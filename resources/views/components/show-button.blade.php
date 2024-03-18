@props(['permission', 'id'])

@can($permission)
    <x-yellow-button wire:click="$dispatch('show-modal',{id:'{{ $id }}'})" wire:loading.attr="disabled">
        <x-icon class="w-4 h-4" name="eye" />
    </x-yellow-button>
@else
    <x-yellow-button class="cursor-not-allowed opacity-60">
        <x-icon class="w-4 h-4" name="eye" />
    </x-yellow-button>
@endcan
