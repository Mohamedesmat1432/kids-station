<div>
    <div class="w-full text-center mt-2 p-2 text-gray-500">
        <div class="flex justify-between text-2xl text-bold w-full mb-3 p-2">
            <div>
                <b>{{ __('site.total') }}</b> :
                <b>{{ Cart::getTotal() }} {{ __('site.EGP') }}</span>
            </div>
            <div>
                {{ __('site.shoppingcart') }} ({{ Cart::getTotalQuantity() }})
            </div>
        </div>
        <x-table class="text-sm lg:text-base w-full text-center border">
            <x-slot name="thead">
                <tr>
                    <td class="px-4 py-2 border">
                        <div class="flex justify-center">
                            <button wire:click="sortByField('id')">
                                #
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
                            {{ __('site.action') }}
                        </div>
                    </td>
                </tr>
            </x-slot>
            <x-slot name="tbody">
                @forelse ($cartItems as $item)
                    <tr wire:key="cart-{{ $item['id'] }}" class="odd:bg-gray-100">
                        <td class="p-2 border">
                            {{ $loop->iteration }}
                        </td>
                        <td class="p-2 border">
                            {{ $item['name'] }}
                        </td>
                        <td class="p-2" wire:ignore>
                            <livewire:cart.update-cart :item="$item" :key="$item['id']" />
                        </td>
                        <td class="p-2 border">
                            {{ $item['price'] }} {{ __('site.EGP') }}
                        </td>
                        <td class="p-2 border">
                            <x-danger-button wire:click.prevent="removeCart('{{ $item['id'] }}')">
                                <x-icon name="trash" class="w-4 h-4" />
                            </x-danger-button>
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
        @if (Cart::getTotalQuantity() > 0)
            <div class="mt-3 flex justify-between p-2">
                <x-indigo-button wire:click="createOrder">
                    <x-icon name="plus" class="w-4 h-4" />
                    {{ __('site.create_new_order') }}
                </x-indigo-button>
                <x-danger-button wire:click.prevent="clearAllCart">
                    <x-icon name="trash" class="w-4 h-4" />
                    {{ __('site.remove_all_cart') }}
                </x-danger-button>
            </div>
        @endif

    </div>
</div>
