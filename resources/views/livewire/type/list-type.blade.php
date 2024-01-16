<div>
    <x-page-content page-name="{{ __('site.types') }}">
        
        <livewire:type.update-type />
        <livewire:type.delete-type />

        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

            <div class="flex justify-between">
                <h1 class=" text-2xl font-medium text-gray-900">
                    {{ __('site.types') }}
                </h1>
                <livewire:type.create-type />
            </div>

            <div class="mt-6 text-gray-500 leading-relaxed">
                <div class="mt-3">
                    <div class="flex justify-between">
                        <div>
                            <x-input type="search" wire:model.live.debounce.500ms="search"
                                placeholder="{{  __('site.search') }}..." />
                        </div>
                    </div>

                    @can('import-export-type')
                        <div class="mt-3 flex">
                            <livewire:type.import-export-type />
                        </div>
                    @endcan

                    @can('bulk-delete-type')
                        <td class="px-4 py-2 border">
                            <div class="mt-3">
                                <x-bulk-delete-button />

                                <livewire:type.bulk-delete-type />
                            </div>
                        </td>
                    @endcan
                </div>

                <x-table>
                    <x-slot name="thead">
                        <tr>
                            @can('bulk-delete-type')
                                <td class="px-4 py-2 border">
                                    <div class="text-center">
                                        <x-checkbox wire:click="checkboxAll" />
                                    </div>
                                </td>
                            @endcan
                            <td class="px-4 py-2 border">
                                <div class="flex items-center">
                                    <button class="flex items-center" wire:click="sortByField('id')">
                                        {{ __('site.id') }}
                                    </button>
                                    <x-sort-icon sort_field="id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex items-center">
                                    <button wire:click="sortByField('type_name_id')">
                                        {{ __('site.name') }}
                                    </button>
                                    <x-sort-icon sort_field="type_name_id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex items-center">
                                    <button wire:click="sortByField('price')">
                                        {{ __('site.price') }}
                                    </button>
                                    <x-sort-icon sort_field="price" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex items-center">
                                    <button wire:click="sortByField('duration')">
                                        {{ __('site.duration') }}
                                    </button>
                                    <x-sort-icon sort_field="duration" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex items-center">
                                    <button wire:click="sortByField('status')">
                                        {{ __('site.status') }}
                                    </button>
                                    <x-sort-icon sort_field="status" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border" colspan="2">
                                <div class="flex items-center">
                                    {{ __('site.action') }}
                                </div>
                            </td>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($types as $type)
                            <tr wire:key="type-{{ $type->id }}" class="odd:bg-gray-100">
                                @can('bulk-delete-type')
                                    <td class="p-2 border">
                                        <x-checkbox wire:model.live="checkbox_arr" value="{{ $type->id }}" />
                                    </td>
                                @endcan
                                <td class="p-2 border">
                                    {{ $loop->index + 1 }}
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
                                <td class="p-2 border">
                                    <x-edit-button permission="edit-type" id="{{ $type->id }}" />
                                </td>
                                <td class="p-2 border">
                                    <x-delete-button permission="delete-type" id="{{ $type->id }}"
                                        name="{{ $type->typeName->name }}" />
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

                <x-paginate :data-links="$types->links()" />
            </div>
        </div>
    </x-page-content>
</div>
