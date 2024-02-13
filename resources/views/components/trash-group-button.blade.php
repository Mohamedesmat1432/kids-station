<div class="inline-flex rounded-md shadow-sm">
    <x-indigo-button wire:click.live.debounce.500ms="$set('trashed',false)" aria-busy="page"
        class="rounded-r-md rounded-l-none {{ $this->trashed ? '' : 'opacity-60 cursor-default' }}">
        {{ __('site.list') }}
    </x-indigo-button>
    <x-danger-button wire:click.live.debounce.500ms="$set('trashed',true)"
        class="rounded-l-md rounded-r-none {{ $this->trashed ? 'opacity-60 cursor-default' : '' }}">
        {{ __('site.trashed') }}
    </x-danger-button>
</div>
