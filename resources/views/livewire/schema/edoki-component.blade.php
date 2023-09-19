<div>

    @include('livewire.schema.includes.save-edoki')

    @include('livewire.schema.includes.delete-edoki')

    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

        <div class="flex justify-between">
            <h1 class=" text-2xl font-medium text-gray-900">
                {{ __('Edoki Schema') }}
            </h1>
            <x-indigo-button wire:click="confirmEdokiAdd()" wire:loading.attr="disabled">
                <x-icon class="w-4 h-4" name="plus" />
                {{ __('Create') }}
            </x-indigo-button>
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
                        <td class="px-4 py-2 border" colspan="2">
                            <div class="flex items-center">
                                {{ __('Action') }}
                            </div>
                        </td>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($edokis as $edoki)
                        <tr wire:key="edoki-{{ $edoki->id }}">
                            <td class="p-2 border">
                                {{ $edoki->id }}
                            </td>
                            <td class="p-2 border">
                                {{ $edoki->name }}
                            </td>
                            <td class="p-2 border">
                                {{ $edoki->email }}
                            </td>
                            <td class="p-2 border">
                                {{ $edoki->department->name ?? '' }}
                            </td>
                            <td class="p-2 border">
                                {{ $edoki->device->name ?? '' }}
                            </td>
                            <td class="p-2 border">
                                {{ $edoki->ip->number ?? '' }}
                            </td>
                            <td class="p-2 border">
                                {{ $edoki->switch->port ?? '' }}
                            </td>
                            <td class="p-2 border">
                                {{ $edoki->patch->port ?? '' }}
                            </td>
                            <td class="p-2 border">
                                <x-indigo-button wire:click="confirmEdokiEdit({{ $edoki->id }})"
                                    wire:loading.attr="disabled">
                                    <x-icon class="w-4 h-4" name="pencil-square" />
                                    {{ __('Edit') }}
                                </x-indigo-button>
                            </td>
                            <td class="p-2 border">
                                <x-danger-button wire:click="confirmEdokiDeletion({{ $edoki->id }})"
                                    wire:loading.attr="disabled">
                                    <x-icon class="w-4 h-4" name="trash" />
                                    {{ __('Delete') }}
                                </x-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>

            <div class="mt-4">
                {{ $edokis->links() }}
            </div>
        </div>
    </div>

</div>
