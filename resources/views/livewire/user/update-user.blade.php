<div>
    <x-dialog-modal wire:model.live="edit_modal" submit="save()" method="PATCH">
        <x-slot name="title">
            {{ __('Update User') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="form.name" value="{{ __('Name') }}" />
                <x-input id="form-name-update" type="text" class="mt-1 block w-full" wire:model="form.name"
                    placeholder="{{ __('Enter user name') }}" autocomplete="username" />
                <x-input-error for="form.name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.email" value="{{ __('Email') }}" />
                <x-input id="form-email-update" type="email" class="mt-1 block w-full" wire:model="form.email"
                    placeholder="{{ __('Enter user email') }}" autocomplete="form.email" />
                <x-input-error for="form.email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.role" value="{{ __('Roles') }}" />
                <x-select id="form-role-update" class="mt-1 block w-full" wire:model="form.role" multiple>
                    @foreach ($roles as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.role" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('edit_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-indigo-button class="ml-3" type="submit" wire:loading.attr="disabled">
                {{ __('Save User') }}
            </x-indigo-button>
        </x-slot>
    </x-dialog-modal>
</div>
