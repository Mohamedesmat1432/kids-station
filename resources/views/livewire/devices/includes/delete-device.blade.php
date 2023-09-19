{{-- confirm delete ip --}}
<x-dialog-modal-danger wire:model="confirm_delete">
    <x-slot name="title">
        {{ __('Delete Device') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to delete your device?') }}

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_delete',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ml-3" wire:click="deleteDevice()" wire:loading.attr="disabled">
            {{ __('Delete Device') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal-danger>
{{-- end confirm delete ip --}}
