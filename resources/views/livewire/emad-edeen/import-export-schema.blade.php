<div>
    <x-indigo-button class="mr-2" wire:click="importModal()" wire:loading.attr="disabled">
        <x-icon class="w-4 h-4 mr-1" name="arrow-up" />
        {{ __('Import') }}
    </x-indigo-button>
    <x-danger-button wire:click="exportModal()" wire:loading.attr="disabled">
        <x-icon class="w-4 h-4 mr-1" name="arrow-down" />
        {{ __('Export') }}
    </x-danger-button>

    <x-dialog-modal wire:model.live="import_modal" submit="import()" method="POST">
        <x-slot name="title">
            {{ __('Import EmadEdeen Schema') }}
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

    <x-dialog-modal wire:model.live="export_modal" submit="export()" method="POST">
        <x-slot name="title">
            {{ __('Export Schema') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="extension" value="{{ __('Extension') }}" />
                <x-select class="block w-full" wire:model.live="extension">
                    <option value="xlsx">xlsx</option>
                    <option value="csv">csv</option>
                    <option value="ods">ods</option>
                    <option value="ots">ots</option>
                    <option value="html">html</option>
                    <option value="pdf">pdf</option>
                </x-select>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('export_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-indigo-button class="ml-3" type="submit" wire:loading.attr="disabled">
                {{ __('Export Schema') }}
            </x-indigo-button>
        </x-slot>
    </x-dialog-modal>
</div>
