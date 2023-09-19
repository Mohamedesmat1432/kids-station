{{-- confirm show license details --}}
<x-dialog-modal wire:model="confirm_show">
    <x-slot name="title">
        {{ __('Licenses Company Details') }}
    </x-slot>

    <x-slot name="content">
        <div class="mt-2">
            <p>
                <b>Name:</b>
                {{ $license->company->name ?? '' }}
            </p>
        </div>
        <div class="mt-2">
            <p>
                <b>Email:</b>
                {{ $license->company->email ?? '' }}
            </p>
        </div>
        <div class="mt-2">
            <p>
                <b>Address:</b>
                {{ $license->company->address ?? '' }}
            </p>
        </div>
        <div class="mt-2">
            <p>
                <b>Contacts:</b>
                @foreach (explode(',', $license->company->contacts ?? '') as $contact)
                    {{ $contact }}
                @endforeach
            </p>
        </div>
        <div class="mt-2">
            <p>
                <b>Specialization:</b>
                {{ $license->company->specialization ?? '' }}
            </p>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirm_show',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm show license details --}}
