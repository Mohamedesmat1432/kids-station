{{-- confirm add && edit emad edeen --}}
<x-dialog-modal wire:model="confirm_form">
    <x-slot name="title">
        {{ isset($this->emadedeen_id) ? __('Edit EmadEdeen') : __('Create New EmadEdeen') }}
    </x-slot>

    <x-slot name="content">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name"
                placeholder="{{ __('Enter emad edeen name') }}" />
            <x-input-error for="name" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-3">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="text" class="mt-1 block w-full" wire:model="email"
                placeholder="{{ __('Enter emad edeen email') }}" />
            <x-input-error for="email" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-3">
            <x-label for="department_id" value="{{ __('Department') }}" />
            <x-select id="department_id" class="mt-1 block w-full" wire:model="department_id">
                <option value="#">{{ __('Select Department') }}</option>
                @foreach ($departments as $key => $val)
                    <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </x-select>
            <x-input-error for="department_id" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-3">
            <x-label for="device_id" value="{{ __('Devices') }}" />
            <x-select id="device_id" class="mt-1 block w-full" wire:model="device_id">
                <option value="#">{{ __('Select Device') }}</option>
                @foreach ($devices as $key => $val)
                    <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </x-select>
            <x-input-error for="device_id" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-3">
            <x-label for="ip_id" value="{{ __('IP') }}" />
            <x-select id="ip_id" class="mt-1 block w-full" wire:model="ip_id">
                <option value="#">{{ __('Select IP') }}</option>
                @foreach ($ips as $key => $val)
                    <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </x-select>
            <x-input-error for="ip_id" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-3">
            <x-label for="switch_id" value="{{ __('Switch') }}" />
            <x-select id="switch_id" class="mt-1 block w-full" wire:model="switch_id">
                <option value="#">{{ __('Select Switch') }}</option>
                @foreach ($switchs as $key => $val)
                    <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </x-select>
            <x-input-error for="switch_id" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-3">
            <x-label for="patch_id" value="{{ __('Patch') }}" />
            <x-select id="patch_id" class="mt-1 block w-full" wire:model="patch_id">
                <option value="#">{{ __('Select Patch') }}</option>
                @foreach ($patchs as $key => $val)
                    <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </x-select>
            <x-input-error for="patch_id" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-3">
            <x-label for="point_id" value="{{ __('Point') }}" />
            <x-select id="point_id" class="mt-1 block w-full" wire:model="point_id">
                <option value="#">{{ __('Select Point') }}</option>
                @foreach ($points as $key => $val)
                    <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </x-select>
            <x-input-error for="point_id" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-3">
            <x-label for="port" value="{{ __('Switch Port') }}" />
            <x-select id="port" class="mt-1 block w-full" wire:model="port">
                <option value="#">{{ __('Select Port') }}</option>
                @for ($i = 1; $i <= 24; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </x-select>
            <x-input-error for="port" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_form',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-indigo-button class="ml-3" wire:click.prevent="saveEmadEdeen()" wire:loading.attr="disabled">
            {{ __('Save Emad Edeen') }}
        </x-indigo-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm add && edit EmadEdeen --}}
