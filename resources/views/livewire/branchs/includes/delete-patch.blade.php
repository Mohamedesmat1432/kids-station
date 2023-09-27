{{-- confirm delete patch --}}
<x-dialog-modal-danger wire:model="confirm_delete">
    <x-slot name="title">
        {{ __('Delete Patch') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to delete your patch?') }}
        @if ($bulk_disabled)
            {{ __('And this count is: ') . $bulk_disabled }}
        @endif
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_delete',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        @if ($bulk_disabled)
            <x-danger-button class="ml-3" wire:click="deleteAll()" wire:loading.attr="disabled">
                {{ __('Delete All') }}
            </x-danger-button>
        @else
            <x-danger-button class="ml-3" wire:click="delete()" wire:loading.attr="disabled">
                {{ __('Delete Patch') }}
            </x-danger-button>
        @endif
    </x-slot>
</x-dialog-modal-danger>
{{-- end confirm delete patch --}}
