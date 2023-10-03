<div>
    @can('create-company')
        <x-indigo-button wire:click="createModal()" wire:loading.attr="disabled">
            <x-icon class="w-4 h-4" name="plus" />
            {{ __('Create') }}
        </x-indigo-button>
    @endcan

    <x-dialog-modal wire:model.live="create_modal" submit="save" method="POST">
        <x-slot name="title">
            {{ __('Create New Company') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="form.name" value="{{ __('Name') }}" />
                <x-input id="form.name" type="text" class="mt-1 block w-full" wire:model="form.name"
                    placeholder="{{ __('Enter company name') }}" />
                <x-input-error for="form.name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.email" value="{{ __('Email') }}" />
                <x-input id="form.email" type="email" class="mt-1 block w-full" wire:model="form.email"
                    placeholder="{{ __('Enter company email') }}" />
                <x-input-error for="form.email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.address" value="{{ __('Address') }}" />
                <x-input id="form.address" type="text" class="mt-1 block w-full" wire:model="form.address"
                    placeholder="{{ __('Enter company address') }}" />
                <x-input-error for="form.address" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.contacts" value="{{ __('Contacts') }}" />
                <x-textarea id="form.contacts" class="mt-1 block w-full" wire:model="form.contacts"
                    placeholder="Example: name , phone"></x-textarea>
                <x-input-error for="form.contacts" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.specialization" value="{{ __('Specialization') }}" />
                <x-textarea id="form.specialization" class="mt-1 block w-full" wire:model="form.specialization"
                    placeholder="{{ __('Enter company specialization') }}"></x-textarea>
                <x-input-error for="form.specialization" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('create_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-indigo-button class="ml-3" type="submit" wire:loading.attr="disabled">
                {{ __('Save Company') }}
            </x-indigo-button>
        </x-slot>
    </x-dialog-modal>
</div>
