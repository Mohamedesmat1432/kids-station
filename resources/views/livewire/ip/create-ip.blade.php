<div>
    @can('create-ip')
        <x-indigo-button wire:click="createModal()" wire:loading.attr="disabled">
            <x-icon class="w-4 h-4" name="plus" />
            {{ __('Create') }}
        </x-indigo-button>
    @endcan

    <x-dialog-modal wire:model.live="create_modal" submit="save()" method="POST">
        <x-slot name="title">
            {{ __('Create New Ip') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="number" value="{{ __('Number') }}" />
                <x-input id="number" type="text" class="mt-1 block w-full" wire:model="form.number"
                    placeholder="{{ __('Enter ip number') }}" />
                <x-input-error for="form.number" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('create_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-indigo-button class="ml-3" type="submit" wire:loading.attr="disabled">
                {{ __('Save Ip') }}
            </x-indigo-button>
        </x-slot>
    </x-dialog-modal>
</div>
