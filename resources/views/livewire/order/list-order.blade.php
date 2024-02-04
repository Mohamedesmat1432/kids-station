<div>
    <x-page-content page-name="{{ __('site.orders') }}">

        <livewire:order.attach-order />

        <livewire:order.show-order />
        
        <livewire:order.delete-order />

        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

            <div class="flex justify-between">
                <h1 class=" text-2xl font-medium text-gray-900">
                    {{ __('site.orders') }}
                </h1>
                <livewire:order.create-order />
            </div>

            <div class="mt-6 text-gray-500 leading-relaxed">
                <div class="mt-3">
                    <div class="flex justify-between">
                        <div>
                            <x-input order="search" wire:model.live.debounce.500ms="search"
                                placeholder="{{ __('site.search') }}..." />
                        </div>
                    </div>

                    @can('import-export-order')
                        <div class="mt-3 flex">
                            <livewire:order.import-export-order />
                        </div>
                    @endcan

                    @can('bulk-delete-order')
                        <td class="px-4 py-2 border">
                            <div class="mt-3">
                                <x-bulk-delete-button />

                                <livewire:order.bulk-delete-order />
                            </div>
                        </td>
                    @endcan
                </div>

                <x-table>
                    <x-slot name="thead">
                        <tr>
                            @can('bulk-delete-order')
                                <td class="px-4 py-2 border">
                                    <div class="text-center">
                                        <x-checkbox wire:click="checkboxAll" />
                                    </div>
                                </td>
                            @endcan
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
                                    <button wire:click="sortByField('casher_name')">
                                        {{ __('site.casher_name') }}
                                    </button>
                                    <x-sort-icon sort_field="casher_name" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('customer_name')">
                                        {{ __('site.customer_name') }}
                                    </button>
                                    <x-sort-icon sort_field="customer_name" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('customer_phone')">
                                        {{ __('site.customer_phone') }}
                                    </button>
                                    <x-sort-icon sort_field="customer_phone" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('duration')">
                                        {{ __('site.duration') }}
                                    </button>
                                    <x-sort-icon sort_field="duration" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('visitors')">
                                        {{ __('site.visitors') }}
                                    </button>
                                    <x-sort-icon sort_field="visitors" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                                    <button wire:click="sortByField('last_total')">
                                        {{ __('site.last_total') }}
                                    </button>
                                    <x-sort-icon sort_field="last_total" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('remianing')">
                                        {{ __('site.remianing') }}
                                    </button>
                                    <x-sort-icon sort_field="remianing" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('created_at')">
                                        {{ __('site.date_today') }}
                                    </button>
                                    <x-sort-icon sort_field="created_at" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('start_date')">
                                        {{ __('site.start_date') }}
                                    </button>
                                    <x-sort-icon sort_field="start_date" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('end_date')">
                                        {{ __('site.end_date') }}
                                    </button>
                                    <x-sort-icon sort_field="end_date" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('status')">
                                        {{ __('site.status') }}
                                    </button>
                                    <x-sort-icon sort_field="status" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                        @forelse ($orders as $order)
                            <tr wire:key="order-{{ $order->id }}" class="odd:bg-gray-100">
                                @can('bulk-delete-order')
                                    <td class="p-2 border">
                                        <x-checkbox wire:model.live="checkbox_arr" value="{{ $order->id }}" />
                                    </td>
                                @endcan
                                <td class="p-2 border">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="p-2 border">
                                    {{ $order->number }}
                                </td>
                                <td class="p-2 border">
                                    {{ $order->casher_name }}
                                </td>
                                <td class="p-2 border">
                                    {{ $order->customer_name }}
                                </td>
                                <td class="p-2 border">
                                    {{ $order->customer_phone }}
                                </td>
                                <td class="p-2 border">
                                    {{ $order->duration }}
                                </td>
                                <td class="w-1/2 p-2 border">
                                    <table class="text-center w-full">
                                        <thead>
                                            <th>#</th>
                                            <th>{{ __('site.name') }}</th>
                                            <th>{{ __('site.serial') }}</th>
                                            <th>{{ __('site.type') }}</th>
                                            <th>{{ __('site.price') }}</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->visitors as $visitor)
                                                <tr>
                                                    <td> {{ $loop->iteration }}</td>
                                                    <td> {{ $visitor['name'] }}</td>
                                                    <td> {{ $visitor['serial'] }}</td>
                                                    <td>{{ App\Models\Type::find($visitor['type_id'])->TypeName->name ?? '' }}
                                                    </td>
                                                    <td> {{ $visitor['price'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td class="p-2 border">
                                    {{ $order->total }}
                                </td>
                                <td class="p-2 border">
                                    {{ $order->last_total ?? 0 }}
                                </td>
                                <td class="p-2 border">
                                    {{ $order->remianing ?? 0 }}
                                </td>
                                <td class="p-2 border">
                                    {{ App\Helpers\Helper::formatDate($order->created_at) }}
                                </td>
                                <td class="p-2 border">
                                    {{ App\Helpers\Helper::formatHours($order->start_date) }}
                                </td>
                                <td class="p-2 border">
                                    {{ App\Helpers\Helper::formatHours($order->end_date) }}
                                </td>
                                <td class="p-2 border">
                                    {{ $order->status }}
                                </td>
                                <td class="p-2 border">
                                    <x-show-button permission="show-order" id="{{ $order->id }}" />
                                </td>
                                <td class="p-2 border">
                                    <x-attach-button permission="attach-order" id="{{ $order->id }}" />
                                </td>
                                <td class="p-2 border">
                                    <x-delete-button permission="delete-order" id="{{ $order->id }}"
                                        name="{{ $order->customer_name }}" />
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

                <x-paginate :data-links="$orders->links()" />
            </div>
        </div>
    </x-page-content>
</div>
