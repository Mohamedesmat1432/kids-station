<div>
    @if ($this->delete_modal)
        <x-dialog-modal-danger wire:model="delete_modal" submit="delete" method="DELETE">
            <x-slot name="title">
                {{ __('site.delete_user') }}
            </x-slot>

            <x-slot name="content">
                {{ __('site.are_you_sure_to_want_delete') . $name }} .
            </x-slot>

            <x-slot name="footer">
                <x-danger-button type="submit" wire:loading.attr="disabled">
                    {{ __('site.delete_user') }}
                </x-danger-button>
                <x-secondary-button class="mx-2" wire:click="$set('delete_modal',false)" wire:loading.attr="disabled">
                    {{ __('site.cancel') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal-danger>
    @endif
</div>
