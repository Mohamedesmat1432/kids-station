<div>
    @if ($this->force_bulk_delete_modal)
        <x-dialog-modal-danger wire:model="force_bulk_delete_modal" submit="delete" method="DELETE">
            <x-slot name="title">
                {{ __('site.force_bulk_delete_daily_expense') }}
            </x-slot>

            <x-slot name="content">
                {{ __('site.are_you_sure_to_want_delete') . $count }} .
            </x-slot>

            <x-slot name="footer">
                <x-danger-button type="submit" wire:loading.attr="disabled">
                    {{ __('site.force_bulk_delete_daily_expense') }}
                </x-danger-button>
                <x-secondary-button class="mx-2" wire:click="$set('force_bulk_delete_modal',false)"
                    wire:loading.attr="disabled">
                    {{ __('site.cancel') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal-danger>
    @endif
</div>
