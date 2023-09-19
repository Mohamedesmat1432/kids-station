{{-- confirm delete license --}}
<x-dialog-modal-danger wire:model="confirm_delete">
    <x-slot name="title">
        {{ __('Delete License') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to delete your license?') }}

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_delete',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ml-3" wire:click="deleteLicense()"
            wire:loading.attr="disabled">
            {{ __('Delete License') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal-danger>
{{-- end confirm delete license --}}
