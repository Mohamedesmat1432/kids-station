@props(['permission', 'id'])

@can($permission)
    <x-indigo-button wire:click="createModal()" wire:loading.attr="disabled">
        <x-icon class="w-4 h-4" name="plus" />
        {{ __('Create') }}
    </x-indigo-button>
@else
    <x-indigo-button class="cursor-not-allowed opacity-60">
        <x-icon class="w-4 h-4" name="plus" />
        {{ __('Create') }}
    </x-indigo-button>
@endcan
