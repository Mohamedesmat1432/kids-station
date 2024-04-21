<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}" />
</head>

<body>
    <div class="header">
        <img src="{{ asset('images/kids_logo.jpeg') }}" alt="{{ __('site.invoice_title_products') }}" class="logo" />
        <h1 class="title"> {{ __('site.invoice_title_products') }}</h1>
    </div>

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
</body>

</html>
