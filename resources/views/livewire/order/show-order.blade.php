<div>
    <x-dialog-modal wire:model="show_modal">
        <x-slot name="title">
            <div class="flex justify-between row-invoice">
                <div>{{ __('site.order_details') }}</div>
                <div>{{ __('site.total') }} : {{ number_format($this->total, 2) }} {{ __('site.EGP') }}</div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="w-full" id="print_invoice">
                <div class="grid md:grid-cols-1 md:gap-4">
                    <div class="relative z-0 w-full group invoice-one">
                        <div class="mb-3 flex justify-between row-invoice">
                            <b>{{ __('site.number') }}:</b>
                            {{ $this->number ?? '' }}
                        </div>
                        @if ($this->last_number ?? '')
                            <div class="mb-3 flex justify-between row-invoice">
                                <b>{{ __('site.last_number') }}:</b>
                                {{ $this->last_number ?? '' }}
                            </div>
                        @endif
                        <div class="mb-3 flex justify-between row-invoice">
                            <b>{{ __('site.casher_name') }}:</b>
                            {{ $this->casher_name ?? '' }}
                        </div>
                        <div class="mb-3 flex justify-between row-invoice">
                            <b>{{ __('site.customer_name') }}:</b>
                            {{ $this->customer_name ?? '' }}
                        </div>
                        <div class="mb-3 flex justify-between row-invoice">
                            <b>{{ __('site.customer_phone') }}:</b>
                            {{ $this->customer_phone ?? '' }}
                        </div>
                        <div class="mb-3 flex justify-between row-invoice">
                            <b>{{ __('site.date_today') }}:</b>
                            {{ App\Helpers\Helper::formatDate($this->start_date) ?? '' }}
                        </div>
                        <div class="mb-3 flex justify-between row-invoice">
                            <b>{{ __('site.start_date') }}:</b>
                            {{ App\Helpers\Helper::formatHours($this->start_date) ?? '' }}
                        </div>
                        <div class="mb-3 flex justify-between row-invoice">
                            <b>{{ __('site.duration') }}:</b>
                            {{ $this->duration ?? '' }} {{ __('site.H') }}
                        </div>
                        <div class="mb-3 flex justify-between row-invoice">
                            <b>{{ __('site.end_date') }}:</b>
                            {{ App\Helpers\Helper::formatHours($this->end_date) ?? '' }}
                        </div>
                    </div>
                    <div class="relative z-0 w-full group invoice-two">
                        <div class="mb-3 text-center table-header">
                            <b>{{ __('site.visitors_date') }}</b>
                        </div>
                        <table class="w-full text-center mb-3 bg-white">
                            <thead class="font-bold">
                                <tr>
                                    <th class="px-4 py-2 border">
                                        <div class="flex justify-center">
                                            {{ __('site.name') }}
                                        </div>
                                    </th>
                                    <th class="px-4 py-2 border">
                                        <div class="flex justify-center">
                                            {{ __('site.type') }}
                                        </div>
                                    </th>
                                    <th class="px-4 py-2 border">
                                        <div class="flex justify-center">
                                            {{ __('site.serial') }}
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
                                @if ($this->visitors)
                                    @forelse ($this->visitors as $visitor)
                                        <tr wire:key="visitor-{{ $visitor['name'] }}">
                                            <td class="p-2 border">
                                                {{ $visitor['name'] }}
                                            </td>
                                            <td class="p-2 border">
                                                {{ App\Models\Type::findOrFail($visitor['type_id'])->typeName->name ?? '' }}
                                            </td>
                                            <td class="p-2 border">
                                                {{ $visitor['serial'] }}
                                            </td>
                                            <td class="p-2 border">
                                                {{ $visitor['price'] }}
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
                            {{ $this->total ?? 0 }} {{ __('site.EGP') }}
                        </div>
                        @if ($this->last_total ?? 0)
                            <div class="mb-3 p-2 bg-gray-100 flex justify-between row-invoice">
                                <b>{{ __('site.last_total') }}:</b>
                                {{ $this->last_total ?? 0 }} {{ __('site.EGP') }}
                            </div>
                        @endif
                        @if ($this->offer_id ?? 0)
                            <div class="mb-3 p-2 bg-gray-100 flex justify-between row-invoice">
                                <b>{{ __('site.discount') }}:</b>
                                -{{ $this->offer->price ?? 0 }} {{ __('site.EGP') }}
                            </div>
                        @endif
                        @if ($this->remianing ?? 0)
                            <div class="mb-3 p-2 bg-gray-100 flex justify-between row-invoice">
                                <b>{{ __('site.remianing') }}:</b>
                                {{ $this->remianing ?? 0 }} {{ __('site.EGP') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-indigo-button onclick="printInvoice()">
                <x-icon name="printer" class="h-4 w-4" />
                {{ __('site.print') }}
            </x-indigo-button>
            <x-secondary-button class="mx-2" wire:click="$set('show_modal',false)" wire:loading.attr="disabled">
                {{ __('site.cancel') }}
            </x-secondary-button>
            <script>
                function printInvoice() {
                    var prtContent = document.getElementById('print_invoice');
                    var winPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
                    winPrint.document.write(`<!DOCTYPE html>
                    <html lang='{{ str_replace('_', '-', app()->getLocale()) }}' dir='{{ config('app.direction') }}'>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta name="csrf-token" content="{{ csrf_token() }}"><head>
                    <link rel='stylesheet' href='{{ asset('css/invoice.css') }}'/>
                    </head><body onload='window.print(); window.close();'>
                        <h1 class='header-invoice'>{{ __('site.invoice_title') }}</h1>`);
                    winPrint.document.write(prtContent.innerHTML);
                    winPrint.document.write('</body></html>');
                    winPrint.document.close();
                    winPrint.focus();
                }
            </script>
        </x-slot>
    </x-dialog-modal>

</div>
