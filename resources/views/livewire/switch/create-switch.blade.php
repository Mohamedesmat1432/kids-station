<div>
    @can('create-switch')
        <x-indigo-button wire:click="createModal()" wire:loading.attr="disabled">
            <x-icon class="w-4 h-4" name="plus" />
            {{ __('Create') }}
        </x-indigo-button>
    @endcan

    <x-dialog-modal wire:model.live="create_modal" submit="save()" method="POST">
        <x-slot name="title">
            {{ __('Create New Switch') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="hostname" value="{{ __('HostName') }}" />
                <x-input id="hostname" type="text" class="mt-1 block w-full" wire:model="form.hostname"
                    placeholder="{{ __('Enter switch hostname') }}" />
                <x-input-error for="form.hostname" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="ip" value="{{ __('Ip') }}" />
                <x-input id="ip" type="text" class="mt-1 block w-full" wire:model="form.ip"
                    placeholder="{{ __('Enter switch ip') }}" />
                <x-input-error for="form.ip" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="platform" value="{{ __('Platform') }}" />
                <x-input id="platform" type="text" class="mt-1 block w-full" wire:model="form.platform"
                    placeholder="{{ __('Enter switch platform') }}" />
                <x-input-error for="form.platform" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="version" value="{{ __('Version') }}" />
                <x-input id="version" type="text" class="mt-1 block w-full" wire:model="form.version"
                    placeholder="{{ __('Enter switch version') }}" />
                <x-input-error for="form.version" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="floor" value="{{ __('Floor') }}" />
                <x-select id="floor" class="mt-1 block w-full overflow-scroll" wire:model="form.floor">
                    <option value="#">{{ __('Select Floor') }}</option>
                    <option value="WeData">{{ __('We Data') }}</option>
                    <option value="DataCenter">{{ __('Data Center') }}</option>
                    <option value="5th">{{ __('5th') }}</option>
                    <option value="6th">{{ __('6th') }}</option>
                </x-select>
                <x-input-error for="form.floor" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="location" value="{{ __('Location') }}" />
                <x-select id="location" class="mt-1 block w-full overflow-scroll" wire:model="form.location">
                    <option value="#">{{ __('Select Location') }}</option>
                    <option value="WeData">{{ __('We Data') }}</option>
                    <option value="DataCenter">{{ __('Data Center') }}</option>
                    <option value="Rack1">{{ __('Rack1') }}</option>
                    <option value="Rack2">{{ __('Rack2') }}</option>
                </x-select>
                <x-input-error for="form.location" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="text" class="mt-1 block w-full" wire:model="form.password"
                    placeholder="{{ __('Enter switch password') }}" />
                <x-input-error for="form.password" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="password_enable" value="{{ __('PasswordEnable') }}" />
                <x-input id="password_enable" type="text" class="mt-1 block w-full"
                    wire:model="form.password_enable" placeholder="{{ __('Enter switch password enable') }}" />
                <x-input-error for="form.password_enable" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('create_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-indigo-button class="ml-3" type="submit" wire:loading.attr="disabled">
                {{ __('Save Switch') }}
            </x-indigo-button>
        </x-slot>
    </x-dialog-modal>
</div>
