<div>
    @include('livewire.license.includes.save-license')

    @include('livewire.license.includes.delete-license')

    @include('livewire.license.includes.import-license')

    @include('livewire.license.includes.show-details')

    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <div class="flex justify-between">
            <h1 class=" text-2xl font-medium text-gray-900">
                {{ __('Licenses') }}
            </h1>
            <x-indigo-button wire:click="confirmLicenseAdd()" wire:loading.attr="disabled">
                <x-icon class="w-4 h-4" name="plus" />

                {{ __('Create') }}
            </x-indigo-button>
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
            <div class="mt-3 flex">
                <x-indigo-button class="mr-2" wire:click="confirmImport()" wire:loading.attr="disabled">
                    <x-icon class="w-4 h-4 mr-1" name="arrow-up" />
                    {{ __('Import') }}
                </x-indigo-button>
                <x-danger-button wire:click="exportLicense()" wire:loading.attr="disabled">
                    <x-icon class="w-4 h-4 mr-1" name="arrow-down" />
                    {{ __('Export') }}
                </x-danger-button>
            </div>

            <x-table>
                <x-slot name="thead">
                    <tr wire:key="licence-{{ $licence->id }}">
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
                                <button>
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
                    @foreach ($licenses as $license)
                        <tr>
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
                                <x-status-date start="{{ now() }}" end="{{ $license->end_date }}" />
                            </td>
                            <td class="p-2 border">
                                {{ $license->start_date }}
                            </td>
                            <td class="p-2 border">
                                {{ $license->end_date }}
                            </td>
                            <td class="p-2 border">
                                <x-yellow-button wire:click="confirmLicenseShow({{ $license->id }})"
                                    wire:loading.attr="disabled">
                                    <x-icon class="w-4 h-4" name="eye" />
                                    {{-- {{ __('Details') }} --}}
                                </x-yellow-button>
                            </td>
                            <td class="p-2 border">
                                <x-indigo-button wire:click="confirmLicenseEdit({{ $license->id }})"
                                    wire:loading.attr="disabled">
                                    <x-icon class="w-4 h-4" name="pencil-square" />
                                    {{-- {{ __('Edit') }} --}}
                                </x-indigo-button>
                            </td>
                            <td class="p-2 border">
                                <x-danger-button wire:click="confirmLicenseDeletion({{ $license->id }})"
                                    wire:loading.attr="disabled">
                                    <x-icon class="w-4 h-4" name="trash" />
                                    {{-- {{ __('Delete') }} --}}
                                </x-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>

            <div class="mt-4">
                {{ $licenses->links() }}
            </div>
        </div>

    </div>
</div>
