{{-- confirm import EmadEdeen --}}
<x-dialog-modal wire:model="confirm_import">
    <x-slot name="title">
        {{ __('Import Schema') }}
    </x-slot>

    <x-slot name="content">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="file" value="{{ __('Choose File') }}" />
            <x-input id="file" type="file" class="mt-1 block w-full border p-1" wire:model="file" />
            <x-input-error for="file" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_import',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-indigo-button class="ml-3" wire:click="importEmadEdeen()" wire:loading.attr="disabled">
            {{ __('Import Schema') }}
        </x-indigo-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm import EmadEdeen --}}