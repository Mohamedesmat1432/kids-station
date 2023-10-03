<div>
    @can('create-license')
        <x-indigo-button wire:click="createModal()" wire:loading.attr="disabled">
            <x-icon class="w-4 h-4" name="plus" />
            {{ __('Create') }}
        </x-indigo-button>
    @endcan

    <x-dialog-modal wire:model.live="create_modal" submit="save()" method="POST">
        <x-slot name="title">
            {{ __('Create New License') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="form.name"
                    placeholder="{{ __('Enter license name') }}" />
                <x-input-error for="form.name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="company_id" value="{{ __('Company') }}" />
                <x-select id="company_id" class="mt-1 block w-full overflow-scroll" wire:model="form.company_id">
                    <option value="#">{{ __('Select company') }}</option>
                    @foreach ($companies as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.company_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="file" value="{{ __('File') }}" />
                <x-input id="file" type="file" class="mt-1 block w-full" wire:model="form.file" />
                <x-input-error for="form.file" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="file" value="{{ __('Files') }}" />
                <x-input id="files" type="file" class="mt-1 block w-full" wire:model="form.files" multiple />
                <x-input-error for="form.files.*" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="start_date" value="{{ __('Start Date') }}" />
                <x-input id="start_date" type="date" class="mt-1 block w-full" wire:model="form.start_date" />
                <x-input-error for="form.start_date" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="end_date" value="{{ __('End Date') }}" />
                <x-input id="end_date" type="date" class="mt-1 block w-full" wire:model="form.end_date" />
                <x-input-error for="form.end_date" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('create_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-indigo-button class="ml-3" type="submit" wire:loading.attr="disabled">
                {{ __('Save License') }}
            </x-indigo-button>

        </x-slot>
    </x-dialog-modal>
</div>
