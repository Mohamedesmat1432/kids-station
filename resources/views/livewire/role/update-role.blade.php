<div>
    <x-dialog-modal wire:model.live="edit_modal" submit="save()" method="PATCH">
        <x-slot name="title">
            {{ __('Update Role') }}
        </x-slot>
    
        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="form.name"
                    placeholder="{{ __('Enter role name') }}" />
                <x-input-error for="form.name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="permission" value="{{ __('Permissions') }}" />
                <x-select id="permission" class="mt-1 block w-full h-48" wire:model="form.permission" multiple>
                    @foreach ($permissions as $key => $val)
                        <option value="{{  $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.permission" class="mt-2" />
            </div>
        </x-slot>
    
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('edit_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-indigo-button class="ml-3" type="submit" wire:loading.attr="disabled">
                {{ __('Save Role') }}
            </x-indigo-button>
        </x-slot>
    </x-dialog-modal>
</div>
