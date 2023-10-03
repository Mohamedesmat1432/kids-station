<div>
    <x-dialog-modal wire:model.live="edit_modal" submit="save()" method="PATCH">
        <x-slot name="title">
            {{ __('Update License') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="form.name" value="{{ __('Name') }}" />
                <x-input id="form.name" type="text" class="mt-1 block w-full" wire:model="form.name"
                    placeholder="{{ __('Enter license name') }}" />
                <x-input-error for="form.name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.company_id" value="{{ __('Company') }}" />
                <x-select id="form.company_id" class="mt-1 block w-full overflow-scroll" wire:model="form.company_id">
                    <option value="#">{{ __('Select company') }}</option>
                    @foreach ($companies as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.company_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.file" value="{{ __('File') }}" />
                <x-input id="form.newFile" type="file" class="mt-1 block w-full" wire:model="form.newFile" />
                <x-input-error for="form.newFile" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.file" value="{{ __('Files') }}" />
                <x-input id="form.newFiles" type="file" class="mt-1 block w-full" wire:model="form.newFiles"
                    multiple />
                <x-input-error for="form.newFiles.*" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.start_date" value="{{ __('Start Date') }}" />
                <x-input id="form.start_date" type="date" class="mt-1 block w-full" wire:model="form.start_date" />
                <x-input-error for="form.start_date" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.end_date" value="{{ __('End Date') }}" />
                <x-input id="form.end_date" type="date" class="mt-1 block w-full" wire:model="form.end_date" />
                <x-input-error for="form.end_date" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('edit_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-indigo-button class="ml-3" type="submit" wire:loading.attr="disabled">
                {{ __('Save License') }}
            </x-indigo-button>

        </x-slot>
    </x-dialog-modal>
</div>
