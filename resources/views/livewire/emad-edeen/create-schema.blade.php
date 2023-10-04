<div>
    @can('create-schema')
        <x-indigo-button wire:click="createModal()" wire:loading.attr="disabled">
            <x-icon class="w-4 h-4" name="plus" />
            {{ __('Create') }}
        </x-indigo-button>
    @endcan

    <x-dialog-modal wire:model.live="create_modal" submit="save()" method="POST">
        <x-slot name="title">
            {{ __('Create New Schema') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input type="text" class="mt-1 block w-full" wire:model="form.name"
                    placeholder="{{ __('Enter edoki name') }}" autocomplete="on" />
                <x-input-error for="form.name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input type="text" class="mt-1 block w-full" wire:model="form.email"
                    placeholder="{{ __('Enter edoki email') }}" autocomplete="on" />
                <x-input-error for="form.email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="department_id" value="{{ __('Department') }}" />
                <x-select class="mt-1 block w-full" wire:model="form.department_id">
                    <option value="#">{{ __('Select Department') }}</option>
                    @foreach ($departments as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.department_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="device_id" value="{{ __('Devices') }}" />
                <x-select class="mt-1 block w-full" wire:model="form.device_id">
                    <option value="#">{{ __('Select Device') }}</option>
                    @foreach ($devices as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.device_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="ip_id" value="{{ __('IP') }}" />
                <x-select class="mt-1 block w-full" wire:model="form.ip_id">
                    <option value="#">{{ __('Select IP') }}</option>
                    @foreach ($ips as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.ip_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="switch_id" value="{{ __('Switch') }}" />
                <x-select class="mt-1 block w-full" wire:model="form.switch_id">
                    <option value="#">{{ __('Select Switch') }}</option>
                    @foreach ($switchs as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.switch_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="patch_id" value="{{ __('Patch') }}" />
                <x-select class="mt-1 block w-full" wire:model="form.patch_id">
                    <option value="#">{{ __('Select Patch') }}</option>
                    @foreach ($patchs as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.patch_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="point_id" value="{{ __('Point') }}" />
                <x-select class="mt-1 block w-full" wire:model="form.point_id">
                    <option value="#">{{ __('Select Point') }}</option>
                    @foreach ($points as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.point_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="port" value="{{ __('Switch Port') }}" />
                <x-select class="mt-1 block w-full" wire:model="form.port">
                    <option value="#">{{ __('Select Port') }}</option>
                    @for ($i = 1; $i <= 24; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </x-select>
                <x-input-error for="form.port" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('create_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-indigo-button class="ml-3" type="submit" wire:loading.attr="disabled">
                {{ __('Save Schema') }}
            </x-indigo-button>
        </x-slot>
    </x-dialog-modal>
</div>
