@can('view-trash-group-button')
    <div
        class="inline-flex {{ LaravelLocalization::getCurrentLocale() === 'en' ? 'flex-row-reverse' : '' }} rounded-md shadow-sm">
        <x-indigo-button wire:click.debounce.500ms="$set('trash',false)"
            class="flex rounded-r-md rounded-l-none {{ $this->trash ? '' : 'opacity-60 cursor-not-allowed' }}">
            <x-icon class="w-4 h-4" name="clipboard-document-list" />
            <span>{{ __('site.list') }}</span>
        </x-indigo-button>
        <x-danger-button wire:click.debounce.500ms="$set('trash',true)"
            class="flex rounded-l-md rounded-r-none {{ $this->trash ? 'opacity-60 cursor-not-allowed' : '' }}">
            <x-icon class="w-4 h-4" name="trash" />
            <span>{{ __('site.trash') }}</span>
        </x-danger-button>
    </div>
@endcan
