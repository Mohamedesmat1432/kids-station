{{-- confirm delete ip --}}
<x-dialog-modal-danger wire:model="confirm_delete">
    <x-slot name="title">
        {{ __('Delete Ip') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to delete your ip?') }}

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_delete',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ml-3" wire:click="deleteIp()" wire:loading.attr="disabled">
            {{ __('Delete Ip') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal-danger>
{{-- end confirm delete ip --}}
