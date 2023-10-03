<div>
    <x-dialog-modal wire:model.live="edit_modal" submit="save()" method="PATCH">
        <x-slot name="title">
            {{ __('Update Schema') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="form.name" value="{{ __('Name') }}" />
                <x-input id="form.name" type="text" class="mt-1 block w-full" wire:model="form.name"
                    placeholder="{{ __('Enter edoki name') }}" />
                <x-input-error for="form.name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.email" value="{{ __('Email') }}" />
                <x-input id="form.email" type="text" class="mt-1 block w-full" wire:model="form.email"
                    placeholder="{{ __('Enter edoki email') }}" />
                <x-input-error for="form.email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.department_id" value="{{ __('Department') }}" />
                <x-select id="form.department_id" class="mt-1 block w-full" wire:model="form.department_id">
                    <option value="#">{{ __('Select Department') }}</option>
                    @foreach ($departments as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.department_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.device_id" value="{{ __('Devices') }}" />
                <x-select id="form.device_id" class="mt-1 block w-full" wire:model="form.device_id">
                    <option value="#">{{ __('Select Device') }}</option>
                    @foreach ($devices as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.device_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.ip_id" value="{{ __('IP') }}" />
                <x-select id="form.ip_id" class="mt-1 block w-full" wire:model="form.ip_id">
                    <option value="#">{{ __('Select IP') }}</option>
                    @foreach ($ips as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.ip_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.switch_id" value="{{ __('Switch') }}" />
                <x-select id="form.switch_id" class="mt-1 block w-full" wire:model="form.switch_id">
                    <option value="#">{{ __('Select Switch') }}</option>
                    @foreach ($switchs as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.switch_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.patch_id" value="{{ __('Patch') }}" />
                <x-select id="form.patch_id" class="mt-1 block w-full" wire:model="form.patch_id">
                    <option value="#">{{ __('Select Patch') }}</option>
                    @foreach ($patchs as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.patch_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.point_id" value="{{ __('Point') }}" />
                <x-select id="form.point_id" class="mt-1 block w-full" wire:model="form.point_id">
                    <option value="#">{{ __('Select Point') }}</option>
                    @foreach ($points as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.point_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="form.port" value="{{ __('Switch Port') }}" />
                <x-select id="form.port" class="mt-1 block w-full" wire:model="form.port">
                    <option value="#">{{ __('Select Port') }}</option>
                    @for ($i = 1; $i <= 24; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </x-select>
                <x-input-error for="form.port" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('edit_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-indigo-button class="ml-3" type="submit" wire:loading.attr="disabled">
                {{ __('Save Schema') }}
            </x-indigo-button>
        </x-slot>
    </x-dialog-modal>
</div>
