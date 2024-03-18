@props(['permission', 'id'])

@can($permission)
    <x-indigo-button wire:click.live="$dispatch('attach-modal',{id:'{{ $id }}'})" wire:loading.attr="disabled">
        <x-icon class="w-4 h-4" name="paper-clip" />
    </x-indigo-button>
@else
    <x-indigo-button class="cursor-not-allowed opacity-60">
        <x-icon class="w-4 h-4" name="paper-clip" />
    </x-indigo-button>
@endcan
