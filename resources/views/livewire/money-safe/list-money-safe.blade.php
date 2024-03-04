<div>
    <x-page-content page-name="{{ __('site.money_safes') }}">

        {{-- <livewire:money-safe.update-money-safe />

        <livewire:money-safe.restore-money-safe />

        <livewire:money-safe.delete-money-safe />
        
        <livewire:money-safe.force-delete-money-safe /> --}}

        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

            <div class="flex justify-between">
                <h1 class=" text-2xl font-medium text-gray-900">
                    {{ __('site.money_safes') }}
                </h1>
                <livewire:money-safe.create-money-safe />
            </div>

            <div class="mt-6 text-gray-500 leading-relaxed">
                <div class="mt-3">
                    <div class="md:flex justify-between">
                        <div class="mt-2">
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
                                    <button wire:click="sortByField('user_id')">
                                        {{ __('site.name') }}
                                    </button>
                                    <x-sort-icon sort_field="user_id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('date_now')">
                                        {{ __('site.date_now') }}
                                    </button>
                                    <x-sort-icon sort_field="date_now" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('total_order')">
                                        {{ __('site.total_order') }}
                                    </button>
                                    <x-sort-icon sort_field="total_order" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('total_daily_expense')">
                                        {{ __('site.total_daily_expense') }}
                                    </button>
                                    <x-sort-icon sort_field="total_daily_expense" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                            {{-- <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    {{ __('site.action') }}
                                </div>
                            </td> --}}
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($money_safes as $money_safe)
                            <tr wire:key="money_safe-{{ $money_safe->id }}" class="odd:bg-gray-100">
                                <td class="p-2 border">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="p-2 border">
                                    {{ $money_safe->user->name ?? '' }}
                                </td>
                                <td class="p-2 border">
                                    {{ \Helper::formatDate($money_safe->date_now) }}
                                </td>
                                <td class="p-2 border">
                                    {{ $money_safe->total_order }}
                                </td>
                                <td class="p-2 border">
                                    {{ $money_safe->total_daily_expense }}
                                </td>
                                <td class="p-2 border">
                                    {{ $money_safe->total }}
                                </td>
                                {{-- <td class="p-2 border">
                                    xxx
                                </td> --}}
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

                @if ($money_safes->hasPages())
                    <x-paginate :data-links="$money_safes->links()" />
                @endif
            </div>
        </div>
    </x-page-content>
</div>
