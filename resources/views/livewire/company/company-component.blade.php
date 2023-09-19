<div>
    @include('livewire.company.includes.save-company')

    @include('livewire.company.includes.delete-company')

    @include('livewire.company.includes.import-company')

    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

        <div class="flex justify-between">
            <h1 class=" text-2xl font-medium text-gray-900">
                {{ __('Companies') }}
            </h1>
            <x-indigo-button wire:click="confirmCompanyAdd()" wire:loading.attr="disabled">
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
                <x-danger-button wire:click="exportCompany()" wire:loading.attr="disabled">
                    <x-icon class="w-4 h-4 mr-1" name="arrow-down" />
                    {{ __('Export') }}
                </x-danger-button>
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
                    @foreach ($companies as $company)
                        <tr wire:key="company-{{ $company->id }}">
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
                                <x-indigo-button wire:click="confirmCompanyEdit({{ $company->id }})"
                                    wire:loading.attr="disabled">
                                    <x-icon class="w-4 h-4" name="pencil-square" />
                                    {{-- {{ __('Edit') }} --}}
                                </x-indigo-button>
                            </td>
                            <td class="p-2 border">
                                <x-danger-button wire:click="confirmCompanyDeletion({{ $company->id }})"
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
                {{ $companies->links() }}
            </div>
        </div>
    </div>

</div>
