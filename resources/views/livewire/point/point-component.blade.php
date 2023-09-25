<div>
    @include('livewire.point.includes.save-point')

    @include('livewire.point.includes.delete-point')

    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

        <div class="flex justify-between">
            <h1 class=" text-2xl font-medium text-gray-900">
                {{ __('points') }}
            </h1>
            @can('create-point')
                <x-indigo-button wire:click="confirmPointAdd()" wire:loading.attr="disabled">
                    <x-icon class="w-4 h-4" name="plus" />
                    {{ __('Create') }}
                </x-indigo-button>
            @endcan
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
                    @foreach ($points as $point)
                        <tr wire:key="point-{{ $point->id }}">
                            <td class="p-2 border">
                                {{ $point->id }}
                            </td>
                            <td class="p-2 border">
                                {{ $point->name }}
                            </td>
                            <td class="p-2 border">
                                @can('edit-point')
                                    <x-indigo-button wire:click="confirmPointEdit({{ $point->id }})"
                                        wire:loading.attr="disabled">
                                        <x-icon class="w-4 h-4" name="pencil-square" />
                                        {{ __('Edit') }}
                                    </x-indigo-button>
                                @endcan
                            </td>
                            <td class="p-2 border">
                                @can('delete-point')
                                    <x-danger-button wire:click="confirmPointDeletion({{ $point->id }})"
                                        wire:loading.attr="disabled">
                                        <x-icon class="w-4 h-4" name="trash" />
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>

            <div class="mt-4">
                {{ $points->links() }}
            </div>
        </div>
    </div>
</div>
