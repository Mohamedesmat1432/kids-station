<div>
    <x-page-content page-name="{{ __('site.invoice_details') }}">

        <livewire:invoice-details.update-invoice />

        <livewire:invoice-details.delete-invoice />

        <div class="p-6 lg:p-8 bg-white border-b border-gray-200 rounded-md">

            <div class="flex justify-between">
                <h1 class=" text-2xl font-medium text-gray-900">
                    {{ __('site.invoice_details') }}
                </h1>
                <livewire:invoice-details.create-invoice />
            </div>

            <div class="mt-6 text-gray-500 leading-relaxed">
                <div class="mt-3">
                    <div class="flex justify-between">
                        <div>
                            <x-input type="search" wire:model.live.debounce.500ms="search"
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
                                    <button wire:click="sortByField('note')">
                                        {{ __('site.note') }}
                                    </button>
                                    <x-sort-icon sort_field="note" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    {{ __('site.action') }}
                                </div>
                            </td>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($invoice_details as $invoice_detail)
                            <tr wire:key="invoice-{{ $invoice_detail->id }}" class="odd:bg-gray-100">
                                <td class="p-2 border">
                                    {{ $invoice_detail->id }}
                                </td>
                                <td class="p-2 border">
                                    {{ $invoice_detail->note }}
                                </td>
                                <td class="p-2 border">
                                    @if ($invoice_detail->status)
                                        <span class="p-1 bg-green-500 rounded-full text-white">
                                            {{ __('site.active') }}
                                        </span>
                                    @else
                                        <span class="p-1 bg-red-500 rounded-full text-white">
                                            {{ __('site.not_active') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-2 border">
                                    <div class="flex justify-center">
                                        <x-edit-button permission="edit-invoice-details"
                                            id="{{ $invoice_detail->id }}" />
                                        <div class="mx-1"></div>
                                        <x-delete-button permission="delete-invoice-details"
                                            id="{{ $invoice_detail->id }}" name="{{ $invoice_detail->note }}" />
                                    </div>
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

                @if ($invoice_details->hasPages())
                    <x-paginate :data-links="$invoice_details->links()" />
                @endif
            </div>
        </div>
    </x-page-content>
</div>
