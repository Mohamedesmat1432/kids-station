<div>
    <x-page-content page-name="{{ __('site.dashboard') }}">
        <h1 class="mb-5 p-2 text-2xl font-semibold text-gray-700 text-center">
            {{ __('site.wellcome_to_dashboard') }} {{ auth()->user()->name ?? '' }}
        </h1>
        
        <div wire:poll.15s="updateInsuranceTotalOrders"></div>

        <div class="p-6 lg:p-6 bg-white border-b border-gray-200 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
                @foreach ($dashboard_links as $link)
                    @can($link['role'])
                        <a wire:navigate href="{{ route($link['name']) }}">
                            <div class="{{ $link['bg'] }} {{ $link['hover'] }} rounded p-3 text-white">
                                <div class="flex text-2xl justify-between">
                                    <div class="text-center">
                                        <x-icon class="w-12 h-12 text-center" name="{{ $link['icon'] }}" />
                                        <div class="mt-3">{{ $link['count'] }}</div>
                                    </div>
                                    <div class="text-center">
                                        <div>{{ $link['value'] }}</div>
                                        <div class="mt-3">
                                            {{ $link['total'] ? number_format($link['total'], 2) . ' ' . __('site.EGP') : '' }}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endcan
                @endforeach
            </div>

            @if (auth()->user()->hasRole(['Super Admin', 'Admin']))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 mt-3">

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

                {{-- search date --}}
                <div class="grid grid-cols-2 gap-y-4 gap-x-8 mt-3">
                    <x-input type="date" class="mt-1 block w-full" wire:model.live="start_date"
                        placeholder="{{ __('site.start_date') }}" autocomplete="start_date" />

                    <x-input type="date" class="mt-1 block w-full" wire:model.live="end_date"
                        placeholder="{{ __('site.end_date') }}" autocomplete="end_date" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 mt-3">
                    {{-- visitors count  --}}
                    <x-table>
                        <x-slot name="caption">
                            {{ __('site.visitors_count') }}
                        </x-slot>
                        <x-slot name="thead">
                            <tr>
                                <td class="px-4 py-2 border">
                                    <div class="flex justify-center">
                                        <button wire:click="sortByField('type')">
                                            {{ __('site.type') }}
                                        </button>
                                        <x-sort-icon sort_field="type" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                    </div>
                                </td>
                                <td class="px-4 py-2 border">
                                    <div class="flex justify-center">
                                        <button wire:click="sortByField('count')">
                                            {{ __('site.count') }}
                                        </button>
                                        <x-sort-icon sort_field="count" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                    </div>
                                </td>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($visitors_count as $key => $visitor)
                                <tr wire:key="product-order-by-{{ $loop->iteration }}" class="odd:bg-gray-100">
                                    <td class="p-2 border">
                                        {{ $key }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ $visitor }}
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
                    
                    {{-- visitors count by duration  --}}
                    <x-table>
                        <x-slot name="caption">
                            {{ __('site.visitors_count_by_duration') }}
                        </x-slot>
                        <x-slot name="thead">
                            <tr>
                                <td class="px-4 py-2 border">
                                    <div class="flex justify-center">
                                        <button wire:click="sortByField('type')">
                                            {{ __('site.type') }}
                                        </button>
                                        <x-sort-icon sort_field="type" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                    </div>
                                </td>
                                <td class="px-4 py-2 border">
                                    <div class="flex justify-center">
                                        <button wire:click="sortByField('count')">
                                            {{ __('site.count') }}
                                        </button>
                                        <x-sort-icon sort_field="count" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                    </div>
                                </td>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($visitors_count_by_duration as $key => $visitor)
                                <tr wire:key="product-order-by-{{ $loop->iteration }}" class="odd:bg-gray-100">
                                    <td class="p-2 border">
                                        {{ $key }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ $visitor }}
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
                </div>
            @endif
        </div>
    </x-page-content>
</div>
