{{-- confirm add && edit edoki --}}
<x-dialog-modal wire:model="confirm_form">
    <x-slot name="title">
        {{ isset($this->edoki_id) ? __('Edit Edoki') : __('Create New Edoki') }}
    </x-slot>

    <x-slot name="content">
        <form>
            @csrf
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="name"
                    placeholder="{{ __('Enter edoki name') }}" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="email"
                    placeholder="{{ __('Enter edoki email') }}" />
                <x-input-error for="email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="department_id" value="{{ __('Department') }}" />
                <x-select id="department_id" class="mt-1 block w-full" wire:model="department_id">
                    <option value="#">{{ __('Select Department') }}</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="department_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="device_id" value="{{ __('Devices') }}" />
                <x-select id="device_id" class="mt-1 block w-full" wire:model="device_id">
                    <option value="#">{{ __('Select Device') }}</option>
                    @foreach ($devices as $device)
                        <option value="{{ $device->id }}">{{ $device->name }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="device_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="ip_id" value="{{ __('IP') }}" />
                <x-select id="ip_id" class="mt-1 block w-full" wire:model="ip_id">
                    <option value="#">{{ __('Select IP') }}</option>
                    @foreach ($ips as $ip)
                        <option value="{{ $ip->id }}">{{ $ip->number }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="ip_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="switch_id" value="{{ __('Switch') }}" />
                <x-select id="switch_id" class="mt-1 block w-full" wire:model="switch_id">
                    <option value="#">{{ __('Select Switch') }}</option>
                    @foreach ($switchs as $switch)
                        <option value="{{ $switch->id }}">{{ $switch->port }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="switch_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="patch_id" value="{{ __('Patch') }}" />
                <x-select id="patch_id" class="mt-1 block w-full" wire:model="patch_id">
                    <option value="#">{{ __('Select Patch') }}</option>
                    @foreach ($patchs as $patch)
                        <option value="{{ $patch->id }}">{{ $patch->port }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="patch_id" class="mt-2" />
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_form',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-indigo-button class="ml-3" wire:click.prevent="saveEdoki()" wire:loading.attr="disabled">
            {{ __('Save Edoki') }}
        </x-indigo-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm add && edit edoki --}}
