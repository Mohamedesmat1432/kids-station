<div>
    <x-dialog-modal-danger wire:model.live="delete_modal" submit="delete" method="DELETE">
        <x-slot name="title">
            {{ __('Delete Role') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete ') . $this->form->name }} ?
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('delete_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" type="submit" wire:loading.attr="disabled">
                {{ __('Delete Role') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal-danger>
</div>
