<div>
    @if ($this->edit_modal)
        <x-dialog-modal wire:model="edit_modal" submit="save()" method="PATCH">
            <x-slot name="title">
                {{ __('site.update_invoice_details') }}
            </x-slot>

            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="note" value="{{ __('site.note') }}" />
                    <x-input type="text" class="mt-1 block w-full" wire:model="note"
                        placeholder="{{ __('site.note') }}" autocomplete="on" />
                    <x-input-error for="note" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-3">
                    <x-label for="role" value="{{ __('site.status') }}" />
                    <x-select class="mt-1 block w-full" wire:model="status">
                        <option value="">{{ __('site.status') }}</option>
                        <option value="1">{{ __('site.active') }}</option>
                        <option value="0">{{ __('site.not_active') }}</option>
                    </x-select>
                    <x-input-error for="status" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-indigo-button type="submit" wire:loading.attr="disabled">
                    {{ __('site.save') }}
                </x-indigo-button>
                <x-secondary-button class="mx-2" wire:click="$set('edit_modal',false)" wire:loading.attr="disabled">
                    {{ __('site.cancel') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
