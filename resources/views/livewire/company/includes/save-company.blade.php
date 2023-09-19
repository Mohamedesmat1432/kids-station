{{-- confirm add && edit comapny --}}
<x-dialog-modal wire:model="confirm_form">
    <x-slot name="title">
        {{ isset($this->companyId) ? __('Edit Company') : __('Create New Company') }}
    </x-slot>

    <x-slot name="content">
        <form>
            @csrf
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name"
                    placeholder="{{ __('Enter company name') }}" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="name" value="{{ __('Email') }}" />
                <x-input id="email" type="email" class="mt-1 block w-full" wire:model="email"
                    placeholder="{{ __('Enter company email') }}" />
                <x-input-error for="email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="address" value="{{ __('Address') }}" />
                <x-input id="address" type="text" class="mt-1 block w-full" wire:model="address"
                    placeholder="{{ __('Enter company address') }}" />
                <x-input-error for="address" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="contacts" value="{{ __('Contacts') }}" />
                <x-textarea id="contacts" class="mt-1 block w-full" wire:model="contacts"
                    placeholder="Example: name , phone"></x-textarea>
                <x-input-error for="contacts" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="specialization" value="{{ __('Specialization') }}" />
                <x-textarea id="specialization" class="mt-1 block w-full" wire:model="specialization"
                    placeholder="{{ __('Enter company specialization') }}"></x-textarea>
                <x-input-error for="specialization" class="mt-2" />
            </div>
        </form>

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_form',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-indigo-button class="ml-3" wire:click.prevent="saveCompany()" wire:loading.attr="disabled">
            {{ __('Save Company') }}
        </x-indigo-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm add && edit comapny --}}
