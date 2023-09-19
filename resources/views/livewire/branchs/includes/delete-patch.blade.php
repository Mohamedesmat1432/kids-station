{{-- confirm delete patch --}}
<x-dialog-modal-danger wire:model="confirm_delete">
    <x-slot name="title">
        {{ __('Delete Patch') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to delete your patch?') }}

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_delete',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ml-3" wire:click="deletePatch()"
            wire:loading.attr="disabled">
            {{ __('Delete Patch') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal-danger>
{{-- end confirm delete patch --}}
