{{-- confirm add && edit User --}}
<x-dialog-modal wire:model="confirm_form">
    <x-slot name="title">
        {{ isset($this->user_id) ? __('Edit User') : __('Create New User') }}
    </x-slot>

    <x-slot name="content">
        <form>
            @csrf
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name"
                    placeholder="{{ __('Enter user name') }}" autocomplete="username" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="text" class="mt-1 block w-full" wire:model="email"
                    placeholder="{{ __('Enter user email') }}" autocomplete="email" />
                <x-input-error for="email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="role" value="{{ __('Roles') }}" />
                <x-select id="role" class="mt-1 block w-full" wire:model="role" multiple>
                    @foreach ($roles as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="role" class="mt-2" />
            </div>
            @if (!isset($this->user_id))
                <div class="col-span-6 sm:col-span-4 mt-3">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" type="password" class="mt-1 block w-full" wire:model="password"
                        placeholder="{{ __('Enter user password') }}" autocomplete="current-password" />
                    <x-input-error for="password" class="mt-2" />
                </div>
            @endif
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_form',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-indigo-button class="ml-3" wire:click.prevent="saveUser()" wire:loading.attr="disabled">
            {{ __('Save User') }}
        </x-indigo-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm add && edit User --}}
