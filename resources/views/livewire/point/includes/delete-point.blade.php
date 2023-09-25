{{-- confirm delete Point --}}
<x-dialog-modal-danger wire:model="confirm_delete">
    <x-slot name="title">
        {{ __('Delete Point') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to delete your point?') }}

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_delete',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ml-3" wire:click="deletePoint()" wire:loading.attr="disabled">
            {{ __('Delete Point') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal-danger>
{{-- end confirm delete Point --}}
