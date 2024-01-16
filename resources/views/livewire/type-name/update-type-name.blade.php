<div>
    <x-dialog-modal wire:model="edit_modal" submit="save()" method="PATCH">
        <x-slot name="title">
            {{ __('site.update_type_name') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('site.name') }}" />
                <x-input type="text" class="mt-1 block w-full" wire:model="name"
                    placeholder="{{ __('site.name') }}" autocomplete="name" />
                <x-input-error for="name" class="mt-2" />
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
</div>
