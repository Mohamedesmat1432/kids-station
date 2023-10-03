<div>
    <x-indigo-button class="mr-2" wire:click="importModal()" wire:loading.attr="disabled">
        <x-icon class="w-4 h-4 mr-1" name="arrow-up" />
        {{ __('Import') }}
    </x-indigo-button>
    <x-danger-button wire:click="export()" wire:loading.attr="disabled">
        <x-icon class="w-4 h-4 mr-1" name="arrow-down" />
        {{ __('Export') }}
    </x-danger-button>

    <x-dialog-modal wire:model.live="import_modal" submit="import()" method="POST">
        <x-slot name="title">
            {{ __('Import Edoki Schema') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="file" value="{{ __('Choose File') }}" />
                <x-input id="file" type="file" class="mt-1 block w-full border p-1" wire:model="file" />
                <x-input-error for="file" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('import_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-indigo-button class="ml-3" type="submit" wire:loading.attr="disabled">
                {{ __('Import Schema') }}
            </x-indigo-button>
        </x-slot>
    </x-dialog-modal>
</div>
