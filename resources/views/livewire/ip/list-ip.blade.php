<div>
    @livewire('ip.update-ip')

    @livewire('ip.delete-ip')

    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

        <div class="flex justify-between">
            <h1 class=" text-2xl font-medium text-gray-900">
                {{ __('IPs') }}
            </h1>
            @livewire('ip.create-ip')
        </div>

        <div class="mt-6 text-gray-500 leading-relaxed">
            <div class="mt-3">
                <div class="flex justify-between">
                    <div>
                        <x-input type="search" wire:model.live.debounce.500ms="search"
                            placeholder="{{ __('Search ...') }}" />
                    </div>
                    <div>
                        <x-select class="block w-full" wire:model.live="page_element">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </x-select>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <x-bulk-delete-button />

                @livewire('ip.bulk-delete-ip')
            </div>

            <x-table>
                <x-slot name="thead">
                    <tr>
                        <td class="px-4 py-2 border">
                            <div class="text-center">
                                <x-checkbox wire:click="checkboxAll" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button class="flex items-center" wire:click="sortByField('id')">
                                    {{ __('ID') }}
                                </button>
                                <x-sort-icon sort_field="id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('number')">
                                    {{ __('Ip Number') }}
                                </button>
                                <x-sort-icon sort_field="number" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border" colspan="2">
                            <div class="flex items-center">
                                {{ __('Action') }}
                            </div>
                        </td>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($ips as $ip)
                        <tr wire:key="ip-{{ $ip->id }}">
                            <td class="p-2 border">
                                <x-checkbox wire:model.live="form.checkbox_arr" value="{{ $ip->id }}" />
                            </td>
                            <td class="p-2 border">
                                {{ $ip->id }}
                            </td>
                            <td class="p-2 border">
                                {{ $ip->number }}
                            </td>
                            <td class="p-2 border">
                                @can('edit-ip')
                                    <x-indigo-button wire:click="$dispatch('edit-modal',{id:'{{ $ip->id }}'})"
                                        wire:loading.attr="disabled">
                                        <x-icon class="w-4 h-4" name="pencil-square" />
                                        {{ __('Edit') }}
                                    </x-indigo-button>
                                @endcan
                            </td>
                            <td class="p-2 border">
                                @can('delete-ip')
                                    <x-danger-button wire:click="$dispatch('delete-modal',{id:'{{ $ip->id }}'})"
                                        wire:loading.attr="disabled">
                                        <x-icon class="w-4 h-4" name="trash" />
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="p-2 border text-center">
                                {{ __('No Data Found') }}
                            </td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table>

            <div class="mt-4">
                {{ $ips->links() }}
            </div>
        </div>
    </div>

</div>
