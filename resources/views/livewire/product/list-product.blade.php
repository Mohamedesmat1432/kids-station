<div>
    <x-page-content page-name="{{ __('site.products') }}">

        <livewire:product.update-product />

        <livewire:product.show-product />

        <livewire:product.restore-product />

        <livewire:product.delete-product />

        <livewire:product.force-delete-product />

        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

            <div class="flex justify-between">
                <h1 class=" text-2xl font-medium text-gray-900">
                    {{ __('site.products') }}
                </h1>
                <livewire:product.create-product />
            </div>

            <div class="mt-6 text-gray-500 leading-relaxed">
                <div class="mt-3">
                    <div class="flex justify-between">
                        <div>
                            <x-input order="search" wire:model.live.debounce.500ms="search"
                                placeholder="{{ __('site.search') }}..." />
                        </div>

                        <div class="inline-flex rounded-md shadow-sm">
                            <x-indigo-button wire:click.live.debounce.500ms="$set('trashed',false)"
                                class="rounded-r-md rounded-l-none">
                                {{ __('site.list') }}
                            </x-indigo-button>
                            <x-danger-button wire:click.live.debounce.500ms="$set('trashed',true)"
                                class="rounded-l-md rounded-r-none">
                                {{ __('site.trashed') }}
                            </x-danger-button>
                        </div>

                        @can('import-export-product')
                            <div>
                                <livewire:product.import-export-product />
                            </div>
                        @endcan
                    </div>

                    @if ($this->trashed)
                        @can('force-bulk-delete-product')
                            <td class="px-4 py-2 border">
                                <div class="mt-3">
                                    <x-force-bulk-delete-button />

                                    <livewire:product.force-bulk-delete-product />
                                </div>
                            </td>
                        @endcan
                    @else
                        @can('bulk-delete-product')
                            <td class="px-4 py-2 border">
                                <div class="mt-3">
                                    <x-bulk-delete-button />

                                    <livewire:product.bulk-delete-product />
                                </div>
                            </td>
                        @endcan
                    @endif
                </div>

                <x-table>
                    <x-slot name="thead">
                        <tr>
                            @if ($this->trashed)
                                @can('force-bulk-delete-product')
                                    <td class="px-4 py-2 border">
                                        <div class="text-center">
                                            <x-checkbox wire:click="forceCheckboxAll" />
                                        </div>
                                    </td>
                                @endcan
                            @else
                                @can('bulk-delete-product')
                                    <td class="px-4 py-2 border">
                                        <div class="text-center">
                                            <x-checkbox wire:click="checkboxAll" />
                                        </div>
                                    </td>
                                @endcan
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
                                    <button wire:click="sortByField('description')">
                                        {{ __('site.description') }}
                                    </button>
                                    <x-sort-icon sort_field="description" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('purchase_price')">
                                        {{ __('site.purchase_price') }}
                                    </button>
                                    <x-sort-icon sort_field="purchase_price" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                                    <button wire:click="sortByField('revenue_price')">
                                        {{ __('site.revenue_price') }}
                                    </button>
                                    <x-sort-icon sort_field="revenue_price" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('unit_id')">
                                        {{ __('site.unit_id') }}
                                    </button>
                                    <x-sort-icon sort_field="unit_id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('category_id')">
                                        {{ __('site.category_id') }}
                                    </button>
                                    <x-sort-icon sort_field="category_id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border" colspan="3">
                                <div class="flex justify-center">
                                    {{ __('site.action') }}
                                </div>
                            </td>

                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($products as $product)
                            <tr wire:key="product-{{ $product->id }}" class="odd:bg-gray-100">
                                @if ($this->trashed)
                                    @can('force-bulk-delete-product')
                                        <td class="p-2 border">
                                            <x-checkbox wire:model.live="checkbox_arr" value="{{ $product->id }}" />
                                        </td>
                                    @endcan
                                @else
                                    @can('bulk-delete-product')
                                        <td class="p-2 border">
                                            <x-checkbox wire:model.live="checkbox_arr" value="{{ $product->id }}" />
                                        </td>
                                    @endcan
                                @endif
                                <td class="p-2 border">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="p-2 border">
                                    {{ $product->name }}
                                </td>
                                <td class="p-2 border">
                                    {{ $product->description }}
                                </td>
                                <td class="p-2 border">
                                    {{ $product->purchase_price }}
                                </td>
                                <td class="p-2 border">
                                    {{ $product->price }}
                                </td>
                                <td class="p-2 border">
                                    {{ $product->revenue_price }}
                                </td>
                                <td class="p-2 border">
                                    {{ $product->qty }}
                                </td>
                                <td class="p-2 border">
                                    {{ $product->unit->name ?? '' }}
                                </td>
                                <td class="p-2 border">
                                    {{ $product->category->name ?? '' }}
                                </td>
                                @if ($this->trashed)
                                    <td class="p-2 border">
                                        <x-restore-button permission="restore-product" id="{{ $product->id }}"
                                            name="{{ $product->name }}" />
                                    </td>
                                    <td class="p-2 border">
                                        <x-delete-button permission="force-delete-product" id="{{ $product->id }}"
                                            name="{{ $product->name }}" />
                                    </td>
                                @else
                                    <td class="p-2 border">
                                        <x-edit-button permission="edit-product" id="{{ $product->id }}" />
                                    </td>
                                    <td class="p-2 border">
                                        <x-delete-button permission="delete-product" id="{{ $product->id }}"
                                            name="{{ $product->name }}" />
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

                <x-paginate :data-links="$products->links()" />
            </div>
        </div>
    </x-page-content>
</div>
