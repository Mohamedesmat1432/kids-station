{{-- confirm add && edit device --}}
<x-dialog-modal wire:model="confirm_form">
    <x-slot name="title">
        {{ isset($this->device_id) ? __('Edit Device') : __('Create New Device') }}
    </x-slot>

    <x-slot name="content">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Device Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name"
                placeholder="{{ __('Enter device name') }}" />
            <x-input-error for="name" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-3">
            <x-label for="serial" value="{{ __('Serial') }}" />
            <x-input id="serial" type="text" class="mt-1 block w-full" wire:model="serial"
                placeholder="{{ __('Enter device serial') }}" />
            <x-input-error for="serial" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-3">
            <x-label for="specifications" value="{{ __('Specifications') }}" />
            <x-textarea id="specifications" type="text" class="mt-1 block w-full" wire:model="specifications"
                placeholder="{{ __('Enter device specifications') }}">
            </x-textarea>
            <x-input-error for="specifications" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_form',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-indigo-button class="ml-3" wire:click.prevent="saveDevice()" wire:loading.attr="disabled">
            {{ __('Save Device') }}
        </x-indigo-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm add && edit device --}}
