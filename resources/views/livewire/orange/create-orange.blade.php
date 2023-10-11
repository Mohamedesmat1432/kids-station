<div>
    @can('create-orange')
        <x-indigo-button wire:click="createModal()" wire:loading.attr="disabled">
            <x-icon class="w-4 h-4" name="plus" />
            {{ __('Create') }}
        </x-indigo-button>
    @endcan

    <x-dialog-modal wire:model.live="create_modal" submit="save()" method="POST">
        <x-slot name="title">
            {{ __('Create New Orange') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input type="text" class="mt-1 block w-full" wire:model="form.name"
                    placeholder="{{ __('Enter Orange name') }}" autocomplete="on" />
                <x-input-error for="form.name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="company_id" value="{{ __('Company') }}" />
                <x-select class="mt-1 block w-full overflow-scroll" wire:model="form.company_id">
                    <option value="#">{{ __('Select Company') }}</option>
                    @foreach ($companies as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.company_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="status" value="{{ __('Status') }}" />
                <x-select class="mt-1 block w-full overflow-scroll" wire:model="form.status">
                    <option value="">{{ __('Select Status') }}</option>
                    <option value="active">{{ __('Active') }}</option>
                    <option value="pendding">{{ __('Pendding') }}</option>
                    <option value="cancelled">{{ __('Cancelled') }}</option>
                </x-select>
                <x-input-error for="form.status" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="price" value="{{ __('Price') }}" />
                <x-input type="number" class="mt-1 block w-full" wire:model="form.price"
                    placeholder="{{ __('Enter Price') }}" autocomplete="on" />
                <x-input-error for="form.price" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="seats" value="{{ __('Seats') }}" />
                <x-input type="number" class="mt-1 block w-full" wire:model="form.seats"
                    placeholder="{{ __('Enter Seats') }}" autocomplete="on" />
                <x-input-error for="form.seats" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="start_date" value="{{ __('Start Date') }}" />
                <x-input type="date" class="mt-1 block w-full" wire:model="form.start_date" autocomplete="on" />
                <x-input-error for="form.start_date" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="end_date" value="{{ __('End Date') }}" />
                <x-input type="date" class="mt-1 block w-full" wire:model="form.end_date" autocomplete="on" />
                <x-input-error for="form.end_date" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('create_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-indigo-button class="ml-3" type="submit" wire:loading.attr="disabled">
                {{ __('Save Orange') }}
            </x-indigo-button>

        </x-slot>
    </x-dialog-modal>
</div>
