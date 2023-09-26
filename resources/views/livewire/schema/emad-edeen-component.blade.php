<div>

    @include('livewire.schema.includes.save-emad-edeen')

    @include('livewire.schema.includes.delete-emad-edeen')
    
    @include('livewire.schema.includes.import-emad-edeen')

    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

        <div class="flex justify-between">
            <h1 class=" text-2xl font-medium text-gray-900">
                {{ __('Emad Edeen Schema') }}
            </h1>
            @can('create-schema')
                <x-indigo-button wire:click="confirmEmadEdeenAdd()" wire:loading.attr="disabled">
                    <x-icon class="w-4 h-4" name="plus" />
                    {{ __('Create') }}
                </x-indigo-button>
            @endcan
        </div>

        <div class="mt-6 text-gray-500 leading-relaxed">
            <div class="mt-3">
                <div class="flex justify-between">
                    <div>
                        <x-input type="search" wire:model.live.debounce.500ms="search"
                            placeholder="{{ __('Search ...') }}" />
                    </div>
                </div>
            </div>
            <div class="mt-3 flex">
                <x-indigo-button class="mr-2" wire:click="confirmImport()" wire:loading.attr="disabled">
                    <x-icon class="w-4 h-4 mr-1" name="arrow-up" />
                    {{ __('Import') }}
                </x-indigo-button>
                <x-danger-button wire:click="exportEmadEdeen()" wire:loading.attr="disabled">
                    <x-icon class="w-4 h-4 mr-1" name="arrow-down" />
                    {{ __('Export') }}
                </x-danger-button>
            </div>
            <x-table>
                <x-slot name="thead">
                    <tr>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button class="flex items-center" wire:click="sortByField('id')">
                                    {{ __('ID') }}
                                </button>
                                <x-sort-icon sort_field="id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('name')">
                                    {{ __('Name') }}
                                </button>
                                <x-sort-icon sort_field="name" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('email')">
                                    {{ __('Email') }}
                                </button>
                                <x-sort-icon sort_field="email" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('department_id')">
                                    {{ __('Department') }}
                                </button>
                                <x-sort-icon sort_field="department_id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('device_id')">
                                    {{ __('Device') }}
                                </button>
                                <x-sort-icon sort_field="device_id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('ip_id')">
                                    {{ __('IP') }}
                                </button>
                                <x-sort-icon sort_field="ip_id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('switch_id')">
                                    {{ __('Switch') }}
                                </button>
                                <x-sort-icon sort_field="switch_id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('patch_id')">
                                    {{ __('Patch') }}
                                </button>
                                <x-sort-icon sort_field="patch_id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('point_id')">
                                    {{ __('Point') }}
                                </button>
                                <x-sort-icon sort_field="point_id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('port')">
                                    {{ __('Switch Port') }}
                                </button>
                                <x-sort-icon sort_field="port" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border" colspan="2">
                            <div class="flex items-center">
                                {{ __('Action') }}
                            </div>
                        </td>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($emadEdeens as $emadEdeen)
                        <tr wire:key="emadEdeen-{{ $emadEdeen->id }}">
                            <td class="p-2 border">
                                {{ $emadEdeen->id }}
                            </td>
                            <td class="p-2 border">
                                {{ $emadEdeen->name }}
                            </td>
                            <td class="p-2 border">
                                {{ $emadEdeen->email }}
                            </td>
                            <td class="p-2 border">
                                {{ $emadEdeen->department->name ?? '' }}
                            </td>
                            <td class="p-2 border">
                                {{ $emadEdeen->device->name ?? '' }}
                            </td>
                            <td class="p-2 border">
                                {{ $emadEdeen->ip->number ?? '' }}
                            </td>
                            <td class="p-2 border">
                                {{ $emadEdeen->switch->hostname ?? '' }}
                            </td>
                            <td class="p-2 border">
                                {{ $emadEdeen->patch->port ?? '' }}
                            </td>
                            <td class="p-2 border">
                                {{ $emadEdeen->point->name ?? '' }}
                            </td>
                            <td class="p-2 border">
                                {{ $emadEdeen->port }}
                            </td>
                            <td class="p-2 border">
                                @can('edit-schema')
                                    <x-indigo-button wire:click="confirmEmadEdeenEdit({{ $emadEdeen->id }})"
                                        wire:loading.attr="disabled">
                                        <x-icon class="w-4 h-4" name="pencil-square" />
                                        {{ __('Edit') }}
                                    </x-indigo-button>
                                @endcan
                            </td>
                            <td class="p-2 border">
                                @can('delete-schema')
                                    <x-danger-button wire:click="confirmEmadEdeenDeletion({{ $emadEdeen->id }})"
                                        wire:loading.attr="disabled">
                                        <x-icon class="w-4 h-4" name="trash" />
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>

            <div class="mt-4">
                {{ $emadEdeens->links() }}
            </div>
        </div>
    </div>
</div>
