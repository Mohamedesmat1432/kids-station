<div>
    @livewire('role.update-role')

    @livewire('role.delete-role')

    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

        <div class="flex justify-between">
            <h1 class=" text-2xl font-medium text-gray-900">
                {{ __('Roles') }}
            </h1>
            @livewire('role.create-role')
        </div>

        <div class="mt-6 text-gray-500 leading-relaxed">
            <div class="mt-3">
                <div class="flex justify-between">
                    <div>
                        <x-input type="search" wire:model.live.debounce.500ms="search"
                            placeholder="{{ __('Search ...') }}" />
                    </div>
                </div>
            </div>
            <x-table>
                <x-slot name="thead">
                    <tr>
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
                                <button wire:click="sortByField('name')">
                                    {{ __('Name') }}
                                </button>
                                <x-sort-icon sort_field="name" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                    @forelse ($roles as $role)
                        <tr wire:key="role-{{ $role->id }}">
                            <td class="p-2 border">
                                {{ $role->id }}
                            </td>
                            <td class="p-2 border">
                                {{ $role->name }}
                            </td>
                            <td class="p-2 border">
                                @can(['edit-role'])
                                    <x-indigo-button wire:click="$dispatch('edit-modal',{id:'{{ $role->id }}'})"
                                        wire:loading.attr="disabled">
                                        <x-icon class="w-4 h-4" name="pencil-square" />
                                        {{-- {{ __('Edit') }} --}}
                                    </x-indigo-button>
                                @endcan
                            </td>
                            <td class="p-2 border">
                                @can(['delete-role'])
                                    <x-danger-button
                                        wire:click="$dispatch('delete-modal',{id:'{{ $role->id }}'})"
                                        wire:loading.attr="disabled">
                                        <x-icon class="w-4 h-4" name="trash" />
                                        {{-- {{ __('Delete') }} --}}
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
                <div>
                    <x-label for="page_element" value="{{ __('Per Page') }}"/>
                    <x-select class="ml-2 py-1" wire:model.live="page_element">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </x-select>
                </div>
                {{ $roles->links() }}
            </div>
        </div>
    </div>

</div>
