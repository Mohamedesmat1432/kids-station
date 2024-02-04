<div>
    <x-indigo-button class="mr-2" wire:click="importModal()" wire:loading.attr="disabled">
        <x-icon class="w-4 h-4 mr-1" name="arrow-up" />
        {{ __('site.import') }}
    </x-indigo-button>
    <x-danger-button wire:click="exportModal()" wire:loading.attr="disabled">
        <x-icon class="w-4 h-4 mr-1" name="arrow-down" />
        {{ __('site.export') }}
    </x-danger-button>

    @if ($this->import_modal)
        <x-dialog-modal wire:model="import_modal" submit="import()" method="POST">
            <x-slot name="title">
                {{ __('site.import_type') }}
            </x-slot>

            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="file" value="{{ __('site.choose_file') }}" />
                    <x-input type="file" class="mt-1 block w-full border p-1" wire:model="file" />
                    <x-input-error for="file" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-indigo-button type="submit" wire:loading.attr="disabled">
                    {{ __('site.import') }}
                </x-indigo-button>

                <x-secondary-button class="mx-2" wire:click="$set('import_modal',false)" wire:loading.attr="disabled">
                    {{ __('site.cancel') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif

    @if ($this->export_modal)
        <x-dialog-modal wire:model="export_modal" submit="export()" method="POST">
            <x-slot name="title">
                {{ __('site.export_type') }}
            </x-slot>

            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="extension" value="{{ __('site.extension') }}" />
                    <x-select class="block w-full" wire:model.live="extension">
                        <option value="xlsx">xlsx</option>
                        <option value="csv">csv</option>
                        <option value="ods">ods</option>
                        <option value="ots">ots</option>
                        <option value="html">html</option>
                        <option value="pdf">pdf</option>
                    </x-select>
                </div>
                <div class="col-span-6 sm:col-span-4 mt-3">
                    <x-label for="search" value="{{ __('site.search') }}" />
                    <x-input type="search" placeholder="{{ __('site.search') }}" class="mt-1 block w-full border p-1"
                        wire:model.live="search" />
                    <x-input-error for="search" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-indigo-button type="submit" wire:loading.attr="disabled">
                    {{ __('site.export') }}
                </x-indigo-button>

                <x-secondary-button class="mx-2" wire:click="$set('export_modal',false)" wire:loading.attr="disabled">
                    {{ __('site.cancel') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
