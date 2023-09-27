<div>
    @include('livewire.branchs.includes.save-patch')

    @include('livewire.branchs.includes.delete-patch')

    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

        <div class="flex justify-between">
            <h1 class=" text-2xl font-medium text-gray-900">
                {{ __('Patchs') }}
            </h1>
            @can('create-patch')
                <x-indigo-button wire:click="confirmAdd()" wire:loading.attr="disabled">
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
            <div class="mt-3">
                @if ($bulk_disabled)
                    <x-danger-button wire:click="confirmDeletionAll()" wire:loading.attr="disabled">
                        <x-icon class="w-4 h-4" name="trash" />
                        {{ __('Delete Selected') }} ({{ $bulk_disabled }})
                    </x-danger-button>
                @endif
            </div>
        </div>
        <x-table>
            <x-slot name="thead">
                <tr>
                    <td class="px-4 py-2 border">
                        <div class="text-center">
                            <x-checkbox wire:click="selectedAll" />
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
                            <button wire:click="sortByField('port')">
                                {{ __('Port') }}
                            </button>
                            <x-sort-icon sort_field="port" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                @forelse ($patchs as $patch)
                    <tr wire:key="patch-{{ $patch->id }}">
                        <td class="p-2 border">
                            <x-checkbox wire:model.live="selected_patch" value="{{ $patch->id }}" />
                        </td>
                        <td class="p-2 border">
                            {{ $patch->id }}
                        </td>
                        <td class="p-2 border">
                            {{ $patch->port }}
                        </td>
                        <td class="p-2 border">
                            @can('edit-patch')
                                <x-indigo-button wire:click="confirmEdit({{ $patch->id }})"
                                    wire:loading.attr="disabled">
                                    <x-icon class="w-4 h-4" name="pencil-square" />
                                    {{ __('Edit') }}
                                </x-indigo-button>
                            @endcan
                        </td>
                        <td class="p-2 border">
                            @can('delete-patch')
                                <x-danger-button wire:click="confirmDeletion({{ $patch->id }})"
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
            {{ $patchs->links() }}
        </div>
    </div>
</div>

</div>
