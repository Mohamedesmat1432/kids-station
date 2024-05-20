<div>
    <x-page-content page-name="{{ __('site.backup') }}">

        <div class="p-6 lg:p-8 bg-white border-b border-gray-200 rounded-md">

            <div class="flex justify-between">
                <h1 class=" text-2xl font-medium text-gray-900">
                    {{ __('site.backup') }}
                </h1>
            </div>

            <div class="mt-6 text-gray-500 leading-relaxed">
                <div class="my-3">
                    <div class="flex">
                        <x-button wire:click="backupDB">
                            {{ __('site.backup') }}
                        </x-button>
                        <x-button wire:click="optimizeClear" class="mx-1">
                            {{ __('site.clear_all_cache') }}
                        </x-button>
                    </div>
                </div>

                <x-table>
                    <x-slot name="thead">
                        <tr>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    {{ __('site.id') }}
                                </div>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex justify-center">
                                    {{ __('site.name') }}
                                </div>
                            </td>
                            <td class="px-4 py-2 border" colspan="2">
                                <div class="flex justify-center">
                                    {{ __('site.action') }}
                                </div>
                            </td>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($files as $key => $file)
                            <tr wire:key="backup-{{ $loop->iteration }}" class="odd:bg-gray-100">
                                <td class="p-2 border">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="p-2 border">
                                    {{ $file->getFilename() }}
                                </td>
                                <td class="p-2 border">
                                    <x-button wire:click.debounce.500ms="download('{{ $file->getFilename() }}')">
                                        {{ __('site.download') }}
                                    </x-button>
                                </td>
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
            </div>
        </div>
    </x-page-content>
</div>
