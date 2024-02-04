<div>
    <x-page-content page-name="{{ __('site.units') }}">

        <livewire:unit.update-unit />
        <livewire:unit.delete-unit />

        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

            <div class="flex justify-between">
                <h1 class=" text-2xl font-medium text-gray-900">
                    {{ __('site.units') }}
                </h1>
                <livewire:unit.create-unit />
            </div>

            <div class="mt-6 text-gray-500 leading-relaxed">
                <div class="mt-3">
                    <div class="flex justify-between">
                        <div>
                            <x-input type="search" wire:model.live.debounce.500ms="search"
                                placeholder="{{ __('site.search') }}..." />
                        </div>
                        @can('import-export-unit')
                            <div>
                                <livewire:unit.import-export-unit />
                            </div>
                        @endcan
                    </div>

                    @can('bulk-delete-unit')
                        <td class="px-4 py-2 border">
                            <div class="mt-3">
                                <x-bulk-delete-button />

                                <livewire:unit.bulk-delete-unit />
                            </div>
                        </td>
                    @endcan
                </div>

                <x-table>
                    <x-slot name="thead">
                        <tr>
                            @can('bulk-delete-unit')
                                <td class="px-4 py-2 border">
                                    <div class="text-center">
                                        <x-checkbox wire:click="checkboxAll" />
                                    </div>
                                </td>
                            @endcan
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
                                    <button wire:click="sortByField('qty')">
                                        {{ __('site.qty') }}
                                    </button>
                                    <x-sort-icon sort_field="qty" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                        @forelse ($units as $unit)
                            <tr wire:key="type-{{ $unit->id }}" class="odd:bg-gray-100">
                                @can('bulk-delete-unit')
                                    <td class="p-2 border">
                                        <x-checkbox wire:model.live="checkbox_arr" value="{{ $unit->id }}" />
                                    </td>
                                @endcan
                                <td class="p-2 border">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="p-2 border">
                                    {{ $unit->name }}
                                </td>
                                <td class="p-2 border">
                                    {{ $unit->qty }}
                                </td>
                                <td class="p-2 border">
                                    <x-edit-button permission="edit-unit" id="{{ $unit->id }}" />
                                </td>
                                <td class="p-2 border">
                                    <x-delete-button permission="delete-unit" id="{{ $unit->id }}"
                                        name="{{ $unit->name }}" />
                                </td>
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

                <x-paginate :data-links="$units->links()" />
            </div>
        </div>
    </x-page-content>
</div>
