<div>
    @if ($this->restore_modal)
        <x-dialog-modal wire:model="restore_modal" submit="restore" method="POST">
            <x-slot name="title">
                {{ __('site.restore_user') }}
            </x-slot>

            <x-slot name="content">
                {{ __('site.are_you_sure_to_want_restore') . $name }} .
            </x-slot>

            <x-slot name="footer">
                <x-indigo-button type="submit" wire:loading.attr="disabled">
                    {{ __('site.restore_user') }}
                </x-indigo-button>
                <x-secondary-button class="mx-2" wire:click="$set('restore_modal',false)" wire:loading.attr="disabled">
                    {{ __('site.cancel') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
