<div>
    <x-page-content page-name="{{ __('site.categories') }}">

        <livewire:category.update-category />

        <livewire:category.delete-category />

        <livewire:category.restore-category />

        <livewire:category.force-delete-category />

        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

            <div class="flex justify-between">
                <h1 class=" text-2xl font-medium text-gray-900">
                    {{ __('site.categories') }}
                </h1>
                <livewire:category.create-category />
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

                        @can('import-export-category')
                            <div class="mt-2">
                                <livewire:category.import-export-category />
                            </div>
                        @endcan
                    </div>

                    @if ($trashed)
                        @can('force-bulk-delete-category')
                            <td class="px-4 py-2 border">
                                <div class="mt-3">
                                    <x-force-bulk-delete-button />

                                    <livewire:category.force-bulk-delete-category />
                                </div>
                            </td>
                        @endcan
                    @else
                        @can('bulk-delete-category')
                            <td class="px-4 py-2 border">
                                <div class="mt-3">
                                    <x-bulk-delete-button />

                                    <livewire:category.bulk-delete-category />
                                </div>
                            </td>
                        @endcan
                    @endif

                </div>

                <x-table>
                    <x-slot name="thead">
                        <tr>
                            @if (count($categories) > 1)
                                @if ($trashed)
                                    @can('force-bulk-delete-category')
                                        <td class="px-4 py-2 border">
                                            <div class="text-center">
                                                <x-checkbox wire:click="checkboxAll" />
                                            </div>
                                        </td>
                                    @endcan
                                @else
                                    @can('bulk-delete-category')
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
                            <td class="px-4 py-2 border" colspan="2">
                                <div class="flex justify-center">
                                    {{ __('site.action') }}
                                </div>
                            </td>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($categories as $category)
                            <tr wire:key="category-{{ $category->id }}" class="odd:bg-gray-100">
                                @if (count($categories) > 1)
                                    @if ($trashed)
                                        @can('force-bulk-delete-category')
                                            <td class="p-2 border">
                                                <x-checkbox wire:model.live="checkbox_arr" value="{{ $category->id }}" />
                                            </td>
                                        @endcan
                                    @else
                                        @can('bulk-delete-category')
                                            <td class="p-2 border">
                                                <x-checkbox wire:model.live="checkbox_arr" value="{{ $category->id }}" />
                                            </td>
                                        @endcan
                                    @endif
                                @endif
                                <td class="p-2 border">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="p-2 border">
                                    {{ $category->name }}
                                </td>
                                @if ($trashed)
                                    <td class="p-2 border">
                                        <x-restore-button permission="restore-category" id="{{ $category->id }}"
                                            name="{{ $category->name }}" />
                                    </td>
                                    <td class="p-2 border">
                                        <x-force-delete-button permission="force-delete-category"
                                            id="{{ $category->id }}" name="{{ $category->name }}" />
                                    </td>
                                @else
                                    <td class="p-2 border">
                                        <x-edit-button permission="edit-category" id="{{ $category->id }}" />
                                    </td>
                                    <td class="p-2 border">
                                        <x-delete-button permission="delete-category" id="{{ $category->id }}"
                                            name="{{ $category->name }}" />
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
                
                @if ($categories->hasPages())
                    <x-paginate :data-links="$categories->links()" />
                @endif
            </div>
        </div>
    </x-page-content>
</div>
