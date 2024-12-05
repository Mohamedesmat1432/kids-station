<div>
    @if ($this->edit_modal)
        <x-dialog-modal wire:model="edit_modal" submit="save()" method="PATCH">
            <x-slot name="title">
                {{ __('site.update_type') }}
            </x-slot>

            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4 mt-3">
                    <x-label for="name" value="{{ __('site.name') }}" />
                    <x-select class="mt-1 block w-full" wire:model="type_name_id">
                        <option value="">{{ __('site.name') }}</option>
                        @foreach ($type_names as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="type_name_id" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-3">
                    <x-label for="duration" value="{{ __('site.duration') }}" />
                    <x-input type="text" class="mt-1 block w-full" wire:model="duration"
                        placeholder="{{ __('site.duration') }}" autocomplete="duration" />
                    <x-input-error for="duration" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-3">
                    <x-label for="price" value="{{ __('site.price') }}" />
                    <x-input type="text" class="mt-1 block w-full" wire:model="price"
                        placeholder="{{ __('site.price') }}" autocomplete="price" />
                    <x-input-error for="price" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-3">
                    <x-toggle-status :status="$status" />
                    <x-input-error for="status" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-indigo-button type="submit" wire:loading.attr="disabled">
                    {{ __('site.save') }}
                </x-indigo-button>
                <x-secondary-button class="mx-2" wire:click="$set('edit_modal',false)" wire:loading.attr="disabled">
                    {{ __('site.cancel') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
