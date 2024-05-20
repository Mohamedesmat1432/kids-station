<div>
    <x-page-content page-name="{{ __('site.types') }}">

        <livewire:type.update-type />

        <livewire:type.restore-type />

        <livewire:type.delete-type />

        <livewire:type.force-delete-type />

        <div class="p-6 lg:p-8 bg-white border-b border-gray-200 rounded-md">

            <div class="flex justify-between">
                <h1 class=" text-2xl font-medium text-gray-900">
                    {{ __('site.types') }}
                </h1>
                <livewire:type.create-type />
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

                        @can('import-export-type')
                            <div class="mt-2">
                                <livewire:type.import-export-type />
                            </div>
                        @endcan
                    </div>

                    @if ($this->trash)
                        @can('force-bulk-delete-type')
                            <td class="px-4 py-2 border">
                                <div class="mt-3">
                                    <x-force-bulk-delete-button />

                                    <livewire:type.force-bulk-delete-type />
                                </div>
                            </td>
                        @endcan
                    @else
                        @can('bulk-delete-type')
                            <td class="px-4 py-2 border">
                                <div class="mt-3">
                                    <x-bulk-delete-button />

                                    <livewire:type.bulk-delete-type />
                                </div>
                            </td>
                        @endcan
                    @endif
                </div>

                <x-table>
                    <x-slot name="thead">
                        <tr>
                            @if (count($types) > 1)
                                @if ($this->trash)
                                    @can('force-bulk-delete-type')
                                        <td class="px-4 py-2 border">
                                            <div class="text-center">
                                                <x-checkbox wire:click="checkboxAll" />
                                            </div>
                                        </td>
                                    @endcan
                                @else
                                    @can('bulk-delete-type')
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
                                    <button wire:click="sortByField('type_name_id')">
                                        {{ __('site.name') }}
                                    </button>
                                    <x-sort-icon sort_field="type_name_id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('price')">
                                        {{ __('site.price') }}
                                    </button>
                                    <x-sort-icon sort_field="price" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('duration')">
                                        {{ __('site.duration') }}
                                    </button>
                                    <x-sort-icon sort_field="duration" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                        @forelse ($types as $type)
                            <tr wire:key="type-{{ $type->id }}" class="odd:bg-gray-100">
                                @if (count($types) > 1)
                                    @if ($this->trash)
                                        @can('force-bulk-delete-type')
                                            <td class="p-2 border">
                                                <x-checkbox wire:model.live="checkbox_arr" value="{{ $type->id }}" />
                                            </td>
                                        @endcan
                                    @else
                                        @can('bulk-delete-type')
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
                                    {{ $type->typeName->name ?? '' }}
                                </td>
                                <td class="p-2 border">
                                    {{ $type->price }}
                                </td>
                                <td class="p-2 border">
                                    {{ $type->duration }}
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
                                @if ($this->trash)
                                    <td class="p-2 border">
                                        <x-restore-button permission="restore-type" id="{{ $type->id }}"
                                            name="{{ $type->typeName->name ?? '' }}" />
                                    </td>
                                    <td class="p-2 border">
                                        <x-force-delete-button permission="force-delete-type" id="{{ $type->id }}"
                                            name="{{ $type->typeName->name  ?? ''}}" />
                                    </td>
                                @else
                                    <td class="p-2 border">
                                        <x-edit-button permission="edit-type" id="{{ $type->id }}" />
                                    </td>
                                    <td class="p-2 border">
                                        <x-delete-button permission="delete-type" id="{{ $type->id }}"
                                            name="{{ $type->typeName->name ?? ''}}" />
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
                @if ($types->hasPages())
                    <x-paginate :data-links="$types->links()" />
                @endif
            </div>
        </div>
    </x-page-content>
</div>
