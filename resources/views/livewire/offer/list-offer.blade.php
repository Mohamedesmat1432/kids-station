<div>
    <x-page-content page-name="{{ __('site.offers') }}">

        <livewire:offer.update-offer />

        <livewire:offer.restore-offer />

        <livewire:offer.delete-offer />

        <livewire:offer.force-delete-offer />

        <div class="p-6 lg:p-8 bg-white border-b border-gray-200 rounded-md">

            <div class="flex justify-between">
                <h1 class=" text-2xl font-medium text-gray-900">
                    {{ __('site.offers') }}
                </h1>
                <livewire:offer.create-offer />
            </div>

            <div class="mt-6 text-gray-500 leading-relaxed">
                <div class="mt-3">
                    <div class="md:flex justify-between">
                        <div class="mt-2">
                            <x-input type="search" wire:model.live.debounce.500ms="search"
                                placeholder="{{ __('site.search') }}..." />
                        </div>

                        <div class="mt-2">
                            <x-trash-group-button />
                        </div>

                        {{-- @can('import-export-offer')
                            <div class="mt-2">
                                <livewire:offer.import-export-offer />
                            </div>
                        @endcan --}}
                    </div>

                    @if ($this->trash)
                        @can('force-bulk-delete-offer')
                            <td class="px-4 py-2 border">
                                <div class="mt-3">
                                    <x-force-bulk-delete-button />

                                    <livewire:offer.force-bulk-delete-offer />
                                </div>
                            </td>
                        @endcan
                    @else
                        @can('bulk-delete-offer')
                            <td class="px-4 py-2 border">
                                <div class="mt-3">
                                    <x-bulk-delete-button />

                                    <livewire:offer.bulk-delete-offer />
                                </div>
                            </td>
                        @endcan
                    @endif
                </div>

                <x-table>
                    <x-slot name="thead">
                        <tr>
                            @if (count($offers) > 1)
                                @if ($this->trash)
                                    @can('force-bulk-delete-offer')
                                        <td class="px-4 py-2 border">
                                            <div class="text-center">
                                                <x-checkbox wire:click="checkboxAll" wire:model.live="checkbox_status" />
                                            </div>
                                        </td>
                                    @endcan
                                @else
                                    @can('bulk-delete-offer')
                                        <td class="px-4 py-2 border">
                                            <div class="text-center">
                                                <x-checkbox wire:click="checkboxAll" wire:model.live="checkbox_status" />
                                            </div>
                                        </td>
                                    @endcan
                                @endif
                            @endif
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
                                    <button wire:click="sortByField('name')">
                                        {{ __('site.name') }}
                                    </button>
                                    <x-sort-icon sort_field="name" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('price')">
                                        {{ __('site.price') }}
                                    </button>
                                    <x-sort-icon sort_field="price" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                        @forelse ($offers as $offer)
                            <tr wire:key="offer-{{ $offer->id }}" class="odd:bg-gray-100">
                                @if (count($offers) > 1)
                                    @if ($this->trash)
                                        @can('force-bulk-delete-offer')
                                            <td class="p-2 border">
                                                <x-checkbox wire:model.live="checkbox_arr" value="{{ $offer->id }}" />
                                            </td>
                                        @endcan
                                    @else
                                        @can('bulk-delete-offer')
                                            <td class="p-2 border">
                                                <x-checkbox wire:model.live="checkbox_arr" value="{{ $offer->id }}" />
                                            </td>
                                        @endcan
                                    @endif
                                @endif
                                <td class="p-2 border">
                                    {{ $offer->id }}
                                </td>
                                <td class="p-2 border">
                                    {{ $offer->name }}
                                </td>
                                <td class="p-2 border">
                                    {{ $offer->price }}
                                </td>
                                <td class="p-2 border">
                                    @if ($offer->status)
                                        <span class="p-2 bg-green-500 rounded-full text-white">
                                            {{ __('site.active') }}
                                        </span>
                                    @else
                                        <span class="p-2 bg-red-500 rounded-full text-white">
                                            {{ __('site.not_active') }}
                                        </span>
                                    @endif
                                </td>
                                @if ($this->trash)
                                    <td class="p-2 border">
                                        <div class="flex justify-center">
                                            <x-restore-button permission="restore-offer" id="{{ $offer->id }}"
                                                name="{{ $offer->name }}" />
                                            <div class="mx-1"></div>
                                            <x-force-delete-button permission="force-delete-offer"
                                                id="{{ $offer->id }}" name="{{ $offer->name }}" />
                                        </div>
                                    </td>
                                @else
                                    <td class="p-2 border">
                                        <div class="flex justify-center">
                                            <x-edit-button permission="edit-offer" id="{{ $offer->id }}" />
                                            <div class="mx-1"></div>
                                            <x-delete-button permission="delete-offer" id="{{ $offer->id }}"
                                                name="{{ $offer->name }}" />
                                        </div>
                                    </td>
                                @endif
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

                @if ($offers->hasPages())
                    <x-paginate :data-links="$offers->links()" />
                @endif
            </div>
        </div>
    </x-page-content>
</div>
