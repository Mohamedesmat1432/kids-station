<div>
    <x-dialog-modal wire:model.live="show_modal">
        <x-slot name="title">
            {{ __('Oranges Company Details') }}
        </x-slot>
    
        <x-slot name="content">
            <div class="mt-2">
                <p>
                    <b>Name:</b>
                    {{ $this->form->orange->company->name ?? '' }}
                </p>
            </div>
            <div class="mt-2">
                <p>
                    <b>Email:</b>
                    {{ $this->form->orange->company->email ?? '' }}
                </p>
            </div>
            <div class="mt-2">
                <p>
                    <b>Address:</b>
                    {{ $this->form->orange->company->address ?? '' }}
                </p>
            </div>
            <div class="mt-2">
                <p>
                    <b>Contacts:</b>
                    @foreach (explode(',', $this->form->orange->company->contacts ?? '') as $contact)
                        {{ $contact }}
                    @endforeach
                </p>
            </div>
            <div class="mt-2">
                <p>
                    <b>Specialization:</b>
                    {{ $this->form->orange->company->specialization ?? '' }}
                </p>
            </div>
        </x-slot>
    
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('show_modal',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>

