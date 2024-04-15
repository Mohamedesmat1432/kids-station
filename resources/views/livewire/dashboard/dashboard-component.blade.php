<div>
    <x-page-content page-name="{{ __('site.dashboard') }}">
        <h1 class="mt-6 p-2 text-2xl font-semibold text-gray-700 dark:text-white text-center">
            {{ __('site.wellcome_to_dashboard') }} {{ auth()->user()->name ?? '' }}
        </h1>

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 p-6 lg:p-8 bg-white border-b border-gray-200">
            <div class="mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ($dashboard_links as $link)
                        @can($link['role'])
                            <a wire:navigate href="{{ route($link['name']) }}">
                                <div class="{{ $link['bg'] }} {{ $link['hover'] }} rounded p-5 text-white">
                                    <div class="flex text-2xl justify-between">
                                        <div class="text-center">
                                            <x-icon class="w-12 h-12 text-center" name="{{ $link['icon'] }}" />
                                            <div class="mt-3">{{ $link['count'] }}</div>
                                        </div>
                                        <div class="text-center">
                                            <div>{{ $link['value'] }}</div>
                                            <div class="mt-3">
                                                {{ $link['total'] ? $link['total'] . ' ' . __('site.EGP') : 0 }}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endcan
                    @endforeach
                </div>
            </div>
            <div class="mx-5">

                {{-- orders --}}
                @can('view-order-kids')
                    <x-table>
                        <x-slot name="caption">
                            {{ __('site.orders') }}
                        </x-slot>
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
                                        <button wire:click="sortByField('months')">
                                            {{ __('site.months') }}
                                        </button>
                                        <x-sort-icon sort_field="months" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($orders_by_months as $order)
                                <tr wire:key="order-by-{{ $loop->iteration }}" class="odd:bg-gray-100">
                                    <td class="p-2 border">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ \Helper::formatDateMonths($order->months) }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ $order->total - $order->last_total }} {{ __('site.EGP') }}
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
                @endcan

                {{-- product_orders --}}
                @can('view-product-order')
                    <x-table>
                        <x-slot name="caption">
                            {{ __('site.product_orders') }}
                        </x-slot>
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
                                        <button wire:click="sortByField('months')">
                                            {{ __('site.months') }}
                                        </button>
                                        <x-sort-icon sort_field="months" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($product_orders_by_months as $product_order)
                                <tr wire:key="product-order-by-{{ $loop->iteration }}" class="odd:bg-gray-100">
                                    <td class="p-2 border">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ \Helper::formatDateMonths($product_order->months) }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ $product_order->total }} {{ __('site.EGP') }}
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
                @endcan

                {{-- daily_expenses --}}
                @can('view-daily-expense-kids')
                    <x-table>
                        <x-slot name="caption">
                            {{ __('site.daily_expenses') }}
                        </x-slot>
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
                                        <button wire:click="sortByField('months')">
                                            {{ __('site.months') }}
                                        </button>
                                        <x-sort-icon sort_field="months" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($daily_expenses_by_months as $expense)
                                <tr wire:key="product-order-by-{{ $loop->iteration }}" class="odd:bg-gray-100">
                                    <td class="p-2 border">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ \Helper::formatDateMonths($expense->months) }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ $expense->total }} {{ __('site.EGP') }}
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
                @endcan

                {{-- daily_expenses_product --}}
                @can('view-daily-expense-product')
                    <x-table>
                        <x-slot name="caption">
                            {{ __('site.daily_expenses_product') }}
                        </x-slot>
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
                                        <button wire:click="sortByField('months')">
                                            {{ __('site.months') }}
                                        </button>
                                        <x-sort-icon sort_field="months" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($daily_expenses_product_by_months as $expense_product)
                                <tr wire:key="product-order-by-{{ $loop->iteration }}" class="odd:bg-gray-100">
                                    <td class="p-2 border">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ \Helper::formatDateMonths($expense_product->months) }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ $expense_product->total }} {{ __('site.EGP') }}
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
                @endcan
            </div>
        </div>
    </x-page-content>
</div>
