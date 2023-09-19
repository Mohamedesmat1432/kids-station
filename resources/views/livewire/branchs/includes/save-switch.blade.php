{{-- confirm add && edit switch --}}
<x-dialog-modal wire:model="confirm_form">
    <x-slot name="title">
        {{ isset($this->switch_id) ? __('Edit Switch') : __('Create New Switch') }}
    </x-slot>

    <x-slot name="content">
        <form>
            @csrf
            <div class="col-span-6 sm:col-span-4">
                <x-label for="port" value="{{ __('Port') }}" />
                <x-input id="port" type="text" class="mt-1 block w-full" wire:model="port"
                    placeholder="{{ __('Enter switch port') }}" />
                <x-input-error for="port" class="mt-2" />
            </div>
        </form>

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_form',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-indigo-button class="ml-3" wire:click.prevent="saveSwitch()" wire:loading.attr="disabled">
            {{ __('Save Switch') }}
        </x-indigo-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm add && edit switch --}}
