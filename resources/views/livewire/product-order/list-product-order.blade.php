<div>
    <x-page-content page-name="{{ __('site.product_orders') }}">

        <livewire:product-order.show-product-order />

        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

            <div class="flex justify-between">
                <h1 class=" text-2xl font-medium text-gray-900">
                    {{ __('site.product_orders') }}
                </h1>
            </div>

            <div class="mt-6 text-gray-500 leading-relaxed">
                <div class="mt-3">
                    <div class="flex justify-between">
                        <div>
                            <x-input order="search" wire:model.live.debounce.500ms="search"
                                placeholder="{{ __('site.search') }}..." />
                        </div>
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
                                    <button wire:click="sortByField('number')">
                                        {{ __('site.number') }}
                                    </button>
                                    <x-sort-icon sort_field="number" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('user_id')">
                                        {{ __('site.casher_name') }}
                                    </button>
                                    <x-sort-icon sort_field="user_id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('products')">
                                        {{ __('site.products') }}
                                    </button>
                                    <x-sort-icon sort_field="products" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('total')">
                                        {{ __('site.total') }}
                                    </button>
                                    <x-sort-icon sort_field="total" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button class="flex justify-center" wire:click="sortByField('created_at')">
                                        {{ __('site.date_today') }}
                                    </button>
                                    <x-sort-icon sort_field="created_at" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button class="flex justify-center" wire:click="sortByField('created_at')">
                                        {{ __('site.date_order') }}
                                    </button>
                                    <x-sort-icon sort_field="created_at" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                        @forelse ($product_orders as $product_order)
                            <tr wire:key="product-{{ $product_order->id }}" class="odd:bg-gray-100">
                                <td class="p-2 border">
                                    {{ $loop->index + 1 }}
                                </td>
                                <td class="p-2 border">
                                    {{ $product_order->number }}
                                </td>
                                <td class="p-2 border">
                                    {{ $product_order->user->name ?? '' }}
                                </td>
                                <td class="w-1/2 p-2 border">
                                    <table class="text-center w-full">
                                        <thead>
                                            <th>#</th>
                                            <th>{{ __('site.name') }}</th>
                                            <th>{{ __('site.qty') }}</th>
                                            <th>{{ __('site.price') }}</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($product_order->products as $product)
                                                <tr>
                                                    <td> {{ $loop->index + 1 }}</td>
                                                    <td> {{ $product['name'] }}</td>
                                                    <td> {{ $product['quantity'] }}</td>
                                                    <td>
                                                        {{ number_format($product['price'], 2) }}
                                                        {{ __('site.EGP') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td class="p-2 border">
                                    <b>{{ $product_order->total }} {{ __('site.EGP') }}</b>
                                </td>
                                <td class="p-2 border">
                                    {{ App\Helpers\Helper::formatDate($product_order->created_at) }}
                                </td>
                                <td class="p-2 border">
                                    {{ App\Helpers\Helper::formatHours($product_order->created_at) }}
                                </td>
                                <td class="p-2 border">
                                    <x-show-button permission="show-product-order" id="{{ $product_order->id }}" />
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

                <x-paginate :data-links="$product_orders->links()" />
            </div>
        </div>
    </x-page-content>
</div>