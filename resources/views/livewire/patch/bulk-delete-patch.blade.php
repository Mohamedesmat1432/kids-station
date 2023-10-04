<div>
    <x-dialog-modal-danger wire:model.live="bulk_delete_modal" submit="delete" method="DELETE">
        <x-slot name="title">
            {{ __('Bulk Delete Patchs') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete ') . $count }} ?
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('bulk_delete_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" type="submit" wire:loading.attr="disabled">
                {{ __('Delete Patchs') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal-danger>
</div>
