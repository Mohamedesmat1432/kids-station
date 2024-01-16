<div>
    <div class="w-full text-center mt-6 p-2 text-gray-500">
        <div class="flex justify-between text-2xl text-bold w-full mb-3 p-2">
            <div>
                <b>{{ __('site.total') }}</b> :
                <b>{{ Cart::getTotal() }} {{ __('site.EGP') }}</span>
            </div>
            <div>
                {{ __('site.shoppingcart') }} ({{ Cart::getTotalQuantity() }})
            </div>
        </div>
        <table class="text-sm lg:text-base w-full text-center border">
            <thead>
                <tr class="h-12 uppercase border">
                    <th class="p-2">#</th>
                    <th class="p-2">{{ __('site.name') }}</th>
                    <th class="p-2">{{ __('site.qty') }}</th>
                    <th class="p-2"> {{ __('site.price') }}</th>
                    <th class="p-2"> {{ __('site.action') }} </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cartItems as $item)
                    <tr wire:key="cart-{{ $item['id'] }}" class="odd:bg-gray-100">
                        <td class="p-2">
                            {{ $loop->index + 1 }}
                        </td>
                        {{--  <td class="p-2">
                <a href="#">
                  <img src="{{ $item['attributes']['image'] }}" class="w-20 rounded" alt="Thumbnail">
                </a>
              </td> --}}
                        <td class="p-2">
                            {{ $item['name'] }}
                        </td>
                        <td class="p-2" wire:ignore>
                            <livewire:cart.update-cart :item="$item" :key="$item['id']" />
                        </td>
                        <td class="p-2">
                            {{ $item['price'] }} {{ __('site.EGP') }}
                        </td>
                        <td class="p-2">
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

            </tbody>
        </table>
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
