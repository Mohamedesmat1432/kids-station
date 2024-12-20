<div>
    <x-page-content page-name="{{ __('site.daily_expenses_product') }}">

        <livewire:daily-expense-product.update-daily-expense-product />

        <livewire:daily-expense-product.show-daily-expense-product />

        <livewire:daily-expense-product.delete-daily-expense-product />

        <livewire:daily-expense-product.restore-daily-expense-product />

        <livewire:daily-expense-product.force-delete-daily-expense-product />

        <div class="p-6 lg:p-8 bg-white border-b border-gray-200 rounded-md">

            <div class="flex justify-between">
                <h1 class=" text-2xl font-medium text-gray-900">
                    {{ __('site.daily_expenses_product') }}
                </h1>
                <livewire:daily-expense-product.create-daily-expense-product />
            </div>

            <div class="mt-6 text-gray-500 leading-relaxed">
                <div class="mt-3">
                    <div class="md:flex justify-between">
                        <div class="mt-2">
                            <x-input type="search" wire:model.live.debounce.500ms="search"
                                placeholder="{{ __('site.search') }}..." class="mb-2" />

                            <x-input type="date" wire:model.live.debounce.500ms="date"
                                placeholder="{{ __('site.date') }}..." />
                        </div>

                        <div class="mt-2">
                            <x-trash-group-button />
                        </div>

                        {{-- @can('import-export-daily-expense')
                            <div class="mt-2">
                                <livewire:daily-expense-product.import-export-daily-expense />
                            </div>
                        @endcan --}}
                    </div>

                    @if (count($daily_expenses) > 1)
                        @if ($this->trash)
                            @can('force-bulk-delete-daily-expense-product')
                                <td class="px-4 py-2 border">
                                    <div class="mt-3">
                                        <x-force-bulk-delete-button />

                                        <livewire:daily-expense-product.force-bulk-delete-daily-expense-product />
                                    </div>
                                </td>
                            @endcan
                        @else
                            @can('bulk-delete-daily-expense-product')
                                <td class="px-4 py-2 border">
                                    <div class="mt-3">
                                        <x-bulk-delete-button />

                                        <livewire:daily-expense-product.bulk-delete-daily-expense-product />
                                    </div>
                                </td>
                            @endcan
                        @endif
                    @endif
                </div>

                <x-table>
                    <x-slot name="thead">
                        <tr>
                            @if (count($daily_expenses) > 1)
                                @if ($this->trash)
                                    @can('force-bulk-delete-daily-expense-product')
                                        <td class="px-4 py-2 border">
                                            <div class="text-center">
                                                <x-checkbox wire:click="checkboxAll" wire:model.live="checkbox_status" />
                                            </div>
                                        </td>
                                    @endcan
                                @else
                                    @can('bulk-delete-daily-expense-product')
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
                                    <button wire:click="sortByField('user_id')">
                                        {{ __('site.casher_name') }}
                                    </button>
                                    <x-sort-icon sort_field="user_id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('data')">
                                        {{ __('site.data') }}
                                    </button>
                                    <x-sort-icon sort_field="data" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                                    <button wire:click="sortByField('updated_at')">
                                        {{ __('site.date_today') }}
                                    </button>
                                    <x-sort-icon sort_field="updated_at" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    <button wire:click="sortByField('updated_at')">
                                        {{ __('site.start_date') }}
                                    </button>
                                    <x-sort-icon sort_field="updated_at" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                        @forelse ($daily_expenses as $daily_expense)
                            <tr wire:key="daily-expense-product-{{ $daily_expense->id }}" class="odd:bg-gray-100">
                                @if (count($daily_expenses) > 1)
                                    @if ($this->trash)
                                        @can('force-bulk-delete-daily-expense-product')
                                            <td class="p-2 border">
                                                <x-checkbox wire:model.live="checkbox_arr"
                                                    value="{{ $daily_expense->id }}" />
                                            </td>
                                        @endcan
                                    @else
                                        @can('bulk-delete-daily-expense-product')
                                            <td class="p-2 border">
                                                <x-checkbox wire:model.live="checkbox_arr"
                                                    value="{{ $daily_expense->id }}" />
                                            </td>
                                        @endcan
                                    @endif
                                @endif
                                <td class="p-2 border">
                                    {{ $daily_expense->id }}
                                </td>
                                <td class="p-2 border">
                                    {{ $daily_expense->user->name ?? '' }}
                                </td>
                                <td class="p-2 border">
                                    <table class="text-center w-full">
                                        <thead>
                                            <th>#</th>
                                            <th>{{ __('site.name') }}</th>
                                            <th>{{ __('site.price') }}</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($daily_expense->data as $item)
                                                <tr>

                                                    <td> {{ $loop->iteration }}</td>
                                                    <td> {{ $item['name'] }}</td>
                                                    <td> {{ $item['price'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td class="p-2 border">
                                    {{ $daily_expense->total }}
                                </td>
                                <td class="p-2 border">
                                    {{ \Helper::formatDate($daily_expense->updated_at) }}
                                </td>
                                <td class="p-2 border">
                                    {{ \Helper::formatHours($daily_expense->updated_at) }}
                                </td>
                                @if ($this->trash)
                                    <td class="p-2 border">
                                        <div class="flex justify-center">
                                            <x-restore-button permission="restore-daily-expense-product"
                                                id="{{ $daily_expense->id }}" name="" />
                                            <div class="mx-1"></div>
                                            <x-force-delete-button permission="force-delete-daily-expense-product"
                                                id="{{ $daily_expense->id }}" name="" />
                                        </div>
                                    </td>
                                @else
                                    <td class="p-2 border">
                                        <div class="flex justify-center">
                                            <x-edit-button permission="edit-daily-expense-product"
                                                id="{{ $daily_expense->id }}" />
                                            <div class="mx-1"></div>
                                            <x-delete-button permission="delete-daily-expense-product"
                                                id="{{ $daily_expense->id }}" name="" />
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

                @if ($daily_expenses->hasPages())
                    <x-paginate :data-links="$daily_expenses->links()" />
                @endif
            </div>
        </div>
    </x-page-content>
</div>
