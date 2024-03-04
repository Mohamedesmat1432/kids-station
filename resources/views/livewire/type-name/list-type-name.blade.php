<div>
    <x-page-content page-name="{{ __('site.type_names') }}">

        <livewire:type-name.update-type-name />

        <livewire:type-name.delete-type-name />

        <livewire:type-name.restore-type-name />

        <livewire:type-name.force-delete-type-name />

        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

            <div class="flex justify-between">
                <h1 class=" text-2xl font-medium text-gray-900">
                    {{ __('site.type_names') }}
                </h1>
                @livewire('type-name.create-type-name')
            </div>

            <div class="mt-6 text-gray-500 leading-relaxed">
                <div class="mt-3">
                    <div class="md:flex justify-between">
                        <div class="mt-2">
                            <x-input type="search" wire:model.live.debounce.500ms="search"
                                placeholder="{{ __('site.search') }}..." />
                        </div>

                        <div class="mt-2">
                            <x-trash-group-button />
                        </div>

                        @can('import-export-type-name')
                            <div class="mt-2">
                                <livewire:type-name.import-export-type-name />
                            </div>
                        @endcan
                    </div>

                    @if ($trashed)
                        @can('force-bulk-delete-type-name')
                            <td class="px-4 py-2 border">
                                <div class="mt-3">
                                    <x-force-bulk-delete-button />

                                    <livewire:type-name.force-bulk-delete-type-name />
                                </div>
                            </td>
                        @endcan
                    @else
                        @can('bulk-delete-type-name')
                            <td class="px-4 py-2 border">
                                <div class="mt-3">
                                    <x-bulk-delete-button />

                                    <livewire:type-name.bulk-delete-type-name />
                                </div>
                            </td>
                        @endcan
                    @endif
                </div>

                <x-table>
                    <x-slot name="thead">
                        <tr>
                            @if (count($type_names) > 1)
                                @if ($trashed)
                                    @can('force-bulk-delete-type-name')
                                        <td class="px-4 py-2 border">
                                            <div class="text-center">
                                                <x-checkbox wire:click="checkboxAll" />
                                            </div>
                                        </td>
                                    @endcan
                                @else
                                    @can('bulk-delete-type-name')
                                        <td class="px-4 py-2 border">
                                            <div class="text-center">
                                                <x-checkbox wire:click="checkboxAll" />
                                            </div>
                                        </td>
                                    @endcan
                                @endif
                            @endif
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('id')">
                                        {{ __('site.id') }}
                                    </button>
                                    <x-sort-icon sort_field="id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('name')">
                                        {{ __('site.name') }}
                                    </button>
                                    <x-sort-icon sort_field="name" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('status')">
                                        {{ __('site.status') }}
                                    </button>
                                    <x-sort-icon sort_field="status" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border" colspan="2">
                                <div class="flex justify-center">
                                    {{ __('site.action') }}
                                </div>
                            </td>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($type_names as $type)
                            <tr wire:key="type-{{ $type->id }}" class="odd:bg-gray-100">
                                @if (count($type_names) > 1)
                                    @if ($trashed)
                                        @can('force-bulk-delete-type-name')
                                            <td class="p-2 border">
                                                <x-checkbox wire:model.live="checkbox_arr" value="{{ $type->id }}" />
                                            </td>
                                        @endcan
                                    @else
                                        @can('bulk-delete-type-name')
                                            <td class="p-2 border">
                                                <x-checkbox wire:model.live="checkbox_arr" value="{{ $type->id }}" />
                                            </td>
                                        @endcan
                                    @endif
                                @endif
                                <td class="p-2 border">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="p-2 border">
                                    {{ $type->name }}
                                </td>
                                <td class="p-2 border">
                                    @if ($type->status)
                                        <span class="p-1 bg-green-500 rounded-full text-white">
                                            {{ __('site.active') }}
                                        </span>
                                    @else
                                        <span class="p-1 bg-red-500 rounded-full text-white">
                                            {{ __('site.not_active') }}
                                        </span>
                                    @endif
                                </td>
                                @if ($trashed)
                                    <td class="p-2 border">
                                        <x-restore-button permission="restore-type-name" id="{{ $type->id }}"
                                            name="{{ $type->name }}" />
                                    </td>
                                    <td class="p-2 border">
                                        <x-force-delete-button permission="force-delete-type-name" id="{{ $type->id }}"
                                            name="{{ $type->name }}" />
                                    </td>
                                @else
                                    <td class="p-2 border">
                                        <x-edit-button permission="edit-type-name" id="{{ $type->id }}" />
                                    </td>
                                    <td class="p-2 border">
                                        <x-delete-button permission="delete-type-name" id="{{ $type->id }}"
                                            name="{{ $type->name }}" />
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="p-2 border text-center">
                                    {{ __('site.no_data_found') }}
                                </td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table>
                
                @if ($type_names->hasPages())
                    <x-paginate :data-links="$type_names->links()" />
                @endif

            </div>
        </div>
    </x-page-content>
</div>
