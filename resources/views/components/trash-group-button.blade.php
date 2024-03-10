<div
    class="inline-flex {{ LaravelLocalization::getCurrentLocale() === 'en' ? 'flex-row-reverse' : '' }} rounded-md shadow-sm">
    <x-indigo-button wire:click="$set('trashed',false)"
        class="flex rounded-r-md rounded-l-none {{ $this->trashed ? '' : 'opacity-60 cursor-default' }}">
        <x-icon class="w-4 h-4" name="clipboard-document-list" />
        <span>{{ __('site.list') }}</span>
    </x-indigo-button>
    <x-danger-button wire:click="$set('trashed',true)"
        class="flex rounded-l-md rounded-r-none {{ $this->trashed ? 'opacity-60 cursor-default' : '' }}">
        <x-icon class="w-4 h-4" name="trash" />
        <span>{{ __('site.trashed') }}</span>
    </x-danger-button>
</div>
