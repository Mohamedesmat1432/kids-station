{{-- confirm add && edit Role --}}
<x-dialog-modal wire:model="confirm_form">
    <x-slot name="title">
        {{ isset($this->role_id) ? __('Edit Role') : __('Create New Role') }}
    </x-slot>

    <x-slot name="content">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name"
                placeholder="{{ __('Enter role name') }}" />
            <x-input-error for="name" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-3">
            <x-label for="permission" value="{{ __('Permissions') }}" />
            <x-select id="permission" class="mt-1 block w-full" wire:model="permission" multiple>
                @foreach ($permissions as $key => $val)
                    <option value="{{  $key }}">{{ $val }}</option>
                @endforeach
            </x-select>
            <x-input-error for="permission" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_form',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-indigo-button class="ml-3" wire:click.prevent="saveRole()" wire:loading.attr="disabled">
            {{ __('Save Role') }}
        </x-indigo-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm add && edit Role --}}
