{{-- confirm add && edit Point --}}
<x-dialog-modal wire:model="confirm_form">
    <x-slot name="title">
        {{ isset($this->point_id) ? __('Edit Point') : __('Create New Point') }}
    </x-slot>

    <x-slot name="content">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name"
                placeholder="{{ __('Enter point name') }}" />
            <x-input-error for="name" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_form',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-indigo-button class="ml-3" wire:click.prevent="savePoint()" wire:loading.attr="disabled">
            {{ __('Save Point') }}
        </x-indigo-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm add && edit Point --}}
