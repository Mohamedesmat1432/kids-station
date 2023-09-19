{{-- confirm show license_show details --}}
<x-dialog-modal wire:model="confirm_show">
    <x-slot name="title">
        {{ __('license_shows Company Details') }}
    </x-slot>

    <x-slot name="content">
        <div class="mt-2">
            <p>
                <b>Name:</b>
                {{ $license_show->company->name ?? '' }}
            </p>
        </div>
        <div class="mt-2">
            <p>
                <b>Email:</b>
                {{ $license_show->company->email ?? '' }}
            </p>
        </div>
        <div class="mt-2">
            <p>
                <b>Address:</b>
                {{ $license_show->company->address ?? '' }}
            </p>
        </div>
        <div class="mt-2">
            <p>
                <b>Contacts:</b>
                @foreach (explode(',', $license_show->company->contacts ?? '') as $contact)
                    {{ $contact }}
                @endforeach
            </p>
        </div>
        <div class="mt-2">
            <p>
                <b>Specialization:</b>
                {{ $license_show->company->specialization ?? '' }}
            </p>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_show',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm show license_show details --}}
