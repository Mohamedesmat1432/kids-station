<div>
    @livewire('license.update-license')

    @livewire('license.delete-license')

    @livewire('license.show-license')

    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <div class="flex justify-between">
            <h1 class=" text-2xl font-medium text-gray-900">
                {{ __('Licenses') }}
            </h1>
            @livewire('license.create-license')
        </div>

        <div class="mt-6 text-gray-500">
            <div class="mt-3">
                <div class="flex justify-between">
                    <div>
                        <x-input type="search" wire:model.live.debounce.500ms="search"
                            placeholder="{{ __('Search ...') }}" />
                    </div>
                    <div>
                        <x-select class="overflow-scroll" wire:model.live.debounce.500ms="filter">
                            <option value="">{{ __('Status') }}</option>
                            <option value="success">{{ __('Success') }}</option>
                            <option value="warning">{{ __('Warning') }}</option>
                            <option value="danger">{{ __('Danger') }}</option>
                            <option value="expired">{{ __('Expired') }}</option>
                        </x-select>
                    </div>
                </div>
            </div>
            @can('import-export-license')
                <div class="mt-3 flex">
                    @livewire('license.import-export-license')
                </div>
            @endcan
            @can('bulk-delete-license')
                <td class="px-4 py-2 border">
                    <div class="mt-3">
                        <x-bulk-delete-button />

                        @livewire('license.bulk-delete-license')
                    </div>
                </td>
            @endcan
            <x-table>
                <x-slot name="thead">
                    <tr>
                        @can('bulk-delete-license')
                            <td class="px-4 py-2 border">
                                <div class="text-center">
                                    <x-checkbox wire:click="checkboxAll" />
                                </div>
                            </td>
                        @endcan
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
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('file')">
                                    {{ __('File') }}
                                </button>
                                <x-sort-icon sort_field="file" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('files')">
                                    {{ __('Files') }}
                                </button>
                                <x-sort-icon sort_field="files" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('status')">
                                    {{ __('Status') }}
                                </button>
                                <x-sort-icon sort_field="status" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('start_date')">
                                    {{ __('Start Date') }}
                                </button>
                                <x-sort-icon sort_field="start_date" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('end_date')">
                                    {{ __('End Date') }}
                                </button>
                                <x-sort-icon sort_field="end_date" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('company_id')">
                                    {{ __('Company') }}
                                </button>
                                <x-sort-icon sort_field="company_id" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                    @forelse ($licenses as $license)
                        <tr wire:key="license-{{ $license->id }}">
                            @can('bulk-delete-license')
                                <td class="p-2 border">
                                    <x-checkbox wire:model.live="form.checkbox_arr" value="{{ $license->id }}" />
                                </td>
                            @endcan
                            <td class="p-2 border">
                                {{ $license->id }}
                            </td>
                            <td class="p-2 border">
                                {{ $license->name }}
                            </td>
                            <td class="p-2 border">
                                <a href="{{ asset('files/licenses/' . $license->file) }}" target="_blank">
                                    {{ $license->file }}
                                </a>

                            </td>
                            <td class="p-2 border">
                                @if ($license->files)
                                    @foreach (explode(',', $license->files) as $file)
                                        <a href="{{ asset('files/licenses/' . $file) }}" target="_blank">
                                            {{ $file }}
                                        </a>
                                        <br />
                                    @endforeach
                                @endif
                            </td>
                            <td class="p-2 border">
                                <x-license-status status="{{ $license->status }}" />
                            </td>
                            <td class="p-2 border">
                                {{ $license->start_date }}
                            </td>
                            <td class="p-2 border">
                                {{ $license->end_date }}
                            </td>
                            <td class="p-2 border">
                                <x-show-button permission="show-license" id="{{ $license->id }}" />
                            </td>
                            <td class="p-2 border">
                                <x-edit-button permission="edit-license" id="{{ $license->id }}" />
                            </td>
                            <td class="p-2 border">
                                <x-delete-button permission="delete-license" id="{{ $license->id }}"
                                    name="{{ $license->name }}" />
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

            <x-paginate :data-links="$licenses->links()" />
        </div>

    </div>
</div>
