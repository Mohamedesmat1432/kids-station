<div>
    @if ($this->note_modal)
        <x-dialog-modal wire:model="note_modal" submit="updateNoteOrders" method="PATCH">
            <x-slot name="title">
                {{ __('site.update_note_orders') }}
            </x-slot>

            <x-slot name="content">
                <div>
                    {{ __('site.are_you_sure_to_want_update_note_orders') . $count }} .
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <x-label for="note" value="{{ __('site.note') }}" />
                    <x-textarea class="mt-1 block w-full" wire:model="note" placeholder="{{ __('site.note') }}">
                    </x-textarea>
                    <x-input-error for="note" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-indigo-button type="submit" wire:loading.attr="disabled">
                    {{ __('site.update_note_orders') }}
                </x-indigo-button>
                <x-secondary-button class="mx-2" wire:click="$set('note_modal',false)"
                    wire:loading.attr="disabled">
                    {{ __('site.cancel') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
