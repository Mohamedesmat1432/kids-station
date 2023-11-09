<div>
    @livewire('company.update-company')

    @livewire('company.delete-company')

    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

        <div class="flex justify-between">
            <h1 class=" text-2xl font-medium text-gray-900">
                {{ __('Companies') }}
            </h1>
            @livewire('company.create-company')
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
            @can('import-export-company')
                <div class="mt-3 flex">
                    @livewire('company.import-export-company')
                </div>
            @endcan
            @can('bulk-delete-company')
                <div class="mt-3">
                    <x-bulk-delete-button />

                    @livewire('company.bulk-delete-company')
                </div>
            @endcan
            <x-table>
                <x-slot name="thead">
                    <tr>
                        @can('bulk-delete-company')
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
                                <button wire:click="sortByField('email')">
                                    {{ __('Email') }}
                                </button>
                                <x-sort-icon sort_field="email" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('address')">
                                    {{ __('Address') }}
                                </button>
                                <x-sort-icon sort_field="address" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('contacts')">
                                    {{ __('Contacts') }}
                                </button>
                                <x-sort-icon sort_field="contacts" :sort_by="$sort_by" :sort_asc="$sort_asc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortByField('specialization')">
                                    {{ __('Specialization') }}
                                </button>
                                <x-sort-icon sort_field="specialization" :sort_by="$sort_by" :sort_asc="$sort_asc" />
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
                    @forelse ($companies as $company)
                        <tr wire:key="company-{{ $company->id }}" class="odd:bg-gray-100">
                            @can('bulk-delete-company')
                                <td class="p-2 border">
                                    <x-checkbox wire:model.live="form.checkbox_arr" value="{{ $company->id }}" />
                                </td>
                            @endcan
                            <td class="p-2 border">
                                {{ $company->id }}
                            </td>
                            <td class="p-2 border">
                                {{ $company->name }}
                            </td>
                            <td class="p-2 border">
                                {{ $company->email }}
                            </td>
                            <td class="p-2 border">
                                {{ $company->address }}
                            </td>
                            <td class="p-2 border">
                                @foreach (explode(',', $company->contacts) as $contact)
                                    {{ $contact }}
                                    <br />
                                @endforeach
                            </td>
                            <td class="p-2 border">
                                {{ $company->specialization }}
                            </td>
                            <td class="p-2 border">
                                <x-edit-button permission="edit-company" id="{{ $company->id }}" />
                            </td>
                            <td class="p-2 border">
                                <x-delete-button permission="delete-company" id="{{ $company->id }}"
                                    name="{{ $company->name }}" />
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
                    <x-label for="page_element" value="{{ __('Per Page') }}" />
                    <x-select class="ml-2 py-1" wire:model.live="page_element">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </x-select>
                </div>
                {{ $companies->links() }}
            </div>
        </div>
    </div>

</div>
