<div>
    <x-page-content page-name="{{ __('site.products') }}">
        <div class="grid md:grid-cols-2 gap-4 p-5">
            <div>
                <div class="mt-5 text-gray-500 leading-relaxed">
                    <div class="mt-3">
                        <div class="flex justify-between">
                            <div>
                                <x-input type="search" wire:model.live.debounce.500ms="search"
                                    placeholder="{{ __('site.search') }}..." />
                            </div>
                        </div>

                        <x-table>
                            <x-slot name="thead">
                                <tr>
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
                                    {{-- <td class="px-4 py-2 border">
                                        <div class="flex justify-center">
                                            <button wire:click="sortByField('description')">
                                                {{ __('site.description') }}
                                            </button>
                                            <x-sort-icon sort_field="description" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                        </div>
                                    </td> --}}
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
                                            <button wire:click="sortByField('qty')">
                                                {{ __('site.qty') }}
                                            </button>
                                            <x-sort-icon sort_field="qty" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 border">
                                        <div class="flex justify-center">
                                            {{ __('site.action') }}
                                        </div>
                                    </td>

                                </tr>
                            </x-slot>
                            <x-slot name="tbody">
                                @forelse ($products as $product)
                                    <tr wire:key="product-{{ $product->id }}" class="odd:bg-gray-100">
                                        <td class="p-2 border">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="p-2 border">
                                            {{ $product->name }}
                                        </td>
                                        {{-- <td class="p-2 border">
                                            {{ $product->description }}
                                        </td> --}}
                                        <td class="p-2 border">
                                            {{ $product->price }}
                                        </td>
                                        <td class="p-2 border">
                                            {{ $product->qty }}
                                        </td>
                                        <td class="p-2 border">
                                            <x-indigo-button wire:click="addToCart({{ $product }})">
                                                {{-- {{ __('add_to_cart') }} --}}
                                                <x-icon name="shopping-cart" class="w-4 h-4 font-bold" />
                                            </x-indigo-button>
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

                        @if ($products->hasPages())
                            <x-paginate :data-links="$products->links()" />
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <livewire:cart.list-cart />
            </div>
        </div>
    </x-page-content>
</div>
