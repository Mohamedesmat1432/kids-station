<div>
    @if ($this->show_modal)
        <x-dialog-modal wire:model="show_modal">
            <x-slot name="title">
                <div class="flex justify-between row-invoice">
                    <div>{{ __('site.order_details') }}</div>
                    <div>{{ __('site.total') }} : {{ number_format($order->total, 2) }} {{ __('site.EGP') }}</div>
                </div>
            </x-slot>

            <x-slot name="content">
                <div class="w-full">
                    <div class="grid md:grid-cols-1 md:gap-4">
                        <div class="relative z-0 w-full group invoice-one">
                            <div class="mb-3 flex justify-between row-invoice">
                                <b>{{ __('site.number') }}:</b>
                                {{ $order->number }}
                            </div>
                            @if ($order->last_number)
                                <div class="mb-3 flex justify-between row-invoice">
                                    <b>{{ __('site.last_number') }}:</b>
                                    {{ $order->last_number }}
                                </div>
                            @endif
                            <div class="mb-3 flex justify-between row-invoice">
                                <b>{{ __('site.casher_name') }}:</b>
                                {{ $order->user->name }}
                            </div>
                            <div class="mb-3 flex justify-between row-invoice">
                                <b>{{ __('site.customer_name') }}:</b>
                                {{ $order->customer_name }}
                            </div>
                            <div class="mb-3 flex justify-between row-invoice">
                                <b>{{ __('site.customer_phone') }}:</b>
                                {{ $order->customer_phone }}
                            </div>
                            <div class="mb-3 flex justify-between row-invoice">
                                <b>{{ __('site.locker_number') }}:</b>
                                {{ $order->locker_number }}
                            </div>
                            <div class="mb-3 flex justify-between row-invoice">
                                <b>{{ __('site.insurance') }}:</b>
                                {{ $order->insurance }}
                            </div>
                            <div class="mb-3 flex justify-between row-invoice">
                                <b>{{ __('site.date_today') }}:</b>
                                {{ \Helper::formatDate($order->start_date) }}
                            </div>
                            <div class="mb-3 flex justify-between row-invoice">
                                <b>{{ __('site.start_date') }}:</b>
                                {{ \Helper::formatHours($order->start_date) }}
                            </div>
                            <div class="mb-3 flex justify-between row-invoice">
                                <b>{{ __('site.duration') }}:</b>
                                {{ $order->duration }} {{ __('site.H') }}
                            </div>
                            <div class="mb-3 flex justify-between row-invoice">
                                <b>{{ __('site.end_date') }}:</b>
                                {{ \Helper::formatHours($order->end_date) }}
                            </div>
                        </div>
                        <div class="relative z-0 w-full group invoice-two">
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
                                        {{-- <th class="px-4 py-2 border">
                                            <div class="flex justify-center">
                                                {{ __('site.serial') }}
                                            </div>
                                        </th> --}}
                                        <th class="px-4 py-2 border">
                                            <div class="flex justify-center">
                                                {{ __('site.price') }}
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($order->visitors)
                                        @forelse ($order->visitors as $visitor)
                                            <tr wire:key="visitor-{{ $visitor['name'] }}">
                                                <td class="p-2 border">
                                                    {{ $visitor['name']  ?? ''}}
                                                </td>
                                                <td class="p-2 border">
                                                    {{ $this->visitorType($visitor['type_id']) }}
                                                </td>
                                                {{-- <td class="p-2 border">
                                                    {{ $visitor['serial'] ?? ''}}
                                                </td> --}}
                                                <td class="p-2 border">
                                                    {{ $visitor['price'] ?? 0}}
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
                            @if ($order->offer_id)
                                <div class="mb-3 p-2 bg-gray-100 flex justify-between row-invoice">
                                    <b>{{ __('site.discount') }}: {{ $order->offer->name ?? 0 }}</b>
                                    {{ $order->offer->price ?? 0 }} {{ __('site.EGP') }}
                                </div>
                            @endif
                            <div class="mb-3 p-2 bg-gray-100 flex justify-between row-invoice">
                                <b>{{ __('site.total') }} :</b>
                                {{ $order->total ?? 0 }} {{ __('site.EGP') }}
                            </div>
                            @if ($order->last_total)
                                <div class="mb-3 p-2 bg-gray-100 flex justify-between row-invoice">
                                    <b>{{ __('site.last_total') }}:</b>
                                    {{ $order->last_total ?? 0 }} {{ __('site.EGP') }}
                                </div>
                            @endif
                            @if ($order->remianing ?? 0)
                                <div class="mb-3 p-2 bg-gray-100 flex justify-between row-invoice">
                                    <b>{{ __('site.remianing') }}:</b>
                                    {{ $order->remianing ?? 0 }} {{ __('site.EGP') }}
                                </div>
                            @endif
                            @if ($order->note)
                                <div class="mb-3 p-2 bg-gray-100 flex justify-between row-invoice">
                                    <b>{{ __('site.note') }}:</b>
                                    {{ $order->note ?? '' }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-indigo-button
                    onclick="printOrderKids('{{ $order->id }}','{{ LaravelLocalization::getCurrentLocale() }}')"
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
