<div>
    <x-dialog-modal wire:model.live="edit_modal" submit="save()" method="PATCH">
        <x-slot name="title">
            {{ __('Update Device') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Device Name') }}" />
                <x-input type="text" class="mt-1 block w-full" wire:model="form.name"
                    placeholder="{{ __('Enter device name') }}" autocomplete="on" />
                <x-input-error for="form.name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="serial" value="{{ __('Serial') }}" />
                <x-input type="text" class="mt-1 block w-full" wire:model="form.serial"
                    placeholder="{{ __('Enter device serial') }}" autocomplete="on" />
                <x-input-error for="form.serial" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="specifications" value="{{ __('Specifications') }}" />
                <x-quill-editor name="form.specifications" body="{!! $this->form->specifications !!}" />

                {{-- <x-textarea id="editor" type="text" class="mt-1 block w-full" wire:model="form.specifications"
                    placeholder="{{ __('Enter device specifications') }}">
                </x-textarea> --}}
                <x-input-error for="form.specifications" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('edit_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-indigo-button class="ml-3" type="submit" wire:loading.attr="disabled">
                {{ __('Save Device') }}
            </x-indigo-button>
        </x-slot>
    </x-dialog-modal>
</div>
