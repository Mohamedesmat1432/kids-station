<div>
    @if ($this->show_modal)
        <x-dialog-modal wire:model="show_modal">
            <x-slot name="title">
                <div class="flex justify-between row-invoice">
                    <div>{{ __('site.order_details') }}</div>
                    <div>{{ __('site.total') }} : {{ number_format($product_order->total, 2) }}
                        {{ __('site.EGP') }}</div>
                </div>
            </x-slot>

            <x-slot name="content">
                <div class="w-full">
                    <div class="grid md:grid-cols-1 md:gap-4">
                        <div class="relative z-0 w-full group invoice-one">
                            <div class="mb-3 flex justify-between row-invoice">
                                <b>{{ __('site.number') }}:</b>
                                {{ $product_order->number ?? '' }}
                            </div>
                            <div class="mb-3 flex justify-between row-invoice">
                                <b>{{ __('site.casher_name') }}:</b>
                                {{ $product_order->user->name ?? '' }}
                            </div>
                            <div class="mb-3 flex justify-between row-invoice">
                                <b>{{ __('site.date_today') }}:</b>
                                {{ App\Helpers\Helper::formatDate($product_order->created_at) ?? '' }}
                            </div>
                            <div class="mb-3 flex justify-between row-invoice">
                                <b>{{ __('site.date_order') }}:</b>
                                {{ App\Helpers\Helper::formatHours($product_order->created_at) ?? '' }}
                            </div>
                        </div>
                        <div class="relative z-0 w-full group invoice-two">
                            <table class="w-full text-center mb-3 bg-white">
                                <thead class="font-bold">
                                    <tr>
                                        <th class="px-4 py-2 border">
                                            <div class="flex justify-center">
                                                #
                                            </div>
                                        </th>
                                        <th class="px-4 py-2 border">
                                            <div class="flex justify-center">
                                                {{ __('site.name') }}
                                            </div>
                                        </th>
                                        <th class="px-4 py-2 border">
                                            <div class="flex justify-center">
                                                {{ __('site.qty') }}
                                            </div>
                                        </th>
                                        <th class="px-4 py-2 border">
                                            <div class="flex justify-center">
                                                {{ __('site.price') }}
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($product_order->products ?? '')
                                        @forelse ($product_order->products as $product)
                                            <tr wire:key="product-{{ $product['id'] }}">
                                                <td class="p-2 border">
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td class="p-2 border">
                                                    {{ $product['name'] }}
                                                </td>
                                                <td class="p-2 border">
                                                    {{ $product['quantity'] }}
                                                </td>
                                                <td class="p-2 border">
                                                    {{ $product['price'] }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="12" class="p-2 border text-center">
                                                    {{ __('site.no_data_found') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                            <div class="mb-3 p-2 bg-gray-100 flex justify-between row-invoice">
                                <b>{{ __('site.total') }} :</b>
                                {{ $product_order->total ?? 0 }} {{ __('site.EGP') }}
                            </div>
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-indigo-button
                    onclick="printProductOrder('{{ $product_order->id }}','{{ LaravelLocalization::getCurrentLocale() }}')"
                    wire:click="$set('show_modal',false)">
                    <x-icon name="printer" class="h-4 w-4" />
                    {{ __('site.print') }}
                </x-indigo-button>
                <x-secondary-button class="mx-2" wire:click="$set('show_modal',false)" wire:loading.attr="disabled">
                    {{ __('site.cancel') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
