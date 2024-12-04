@props(['permission', 'id'])

@can($permission)
    <x-green-button wire:click="$dispatch('create-exists-modal',{id:'{{ $id }}'})" wire:loading.attr="disabled">
        <x-icon class="w-4 h-4" name="plus" />
    </x-green-button>
@else
    <x-green-button class="cursor-not-allowed opacity-60">
        <x-icon class="w-4 h-4" name="plus" />
    </x-green-button>
@endcan
