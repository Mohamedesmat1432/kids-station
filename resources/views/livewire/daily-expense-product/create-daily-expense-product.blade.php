<div>
    <x-create-button permission="create-daily-expense-kids" />

    @if ($this->create_modal)
        <x-dialog-modal wire:model="create_modal" submit="save()" method="POST">
            <x-slot name="title">
                {{ __('site.create_new_daily_expense') }}
            </x-slot>

            <x-slot name="content">
                @if ($data)
                    @foreach ($data as $key => $item)
                        <div class="grid md:grid-cols-3 md:gap-5">
                            <div class="relative z-0 w-full mb-5 group">
                                <x-label for="name" value="{{ __('site.name') }}" />
                                <x-input type="text" class="mt-1 block w-full"
                                    wire:model="data.{{ $key }}.name" placeholder="{{ __('site.name') }}"
                                    autocomplete="data.{{ $key }}.name" />
                                <x-input-error for="data.{{ $key }}.name" class="mt-2" />
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <x-label for="price" value="{{ __('site.price') }}" />
                                <x-input type="number" class="mt-1 block w-full"
                                    wire:model="data.{{ $key }}.price" placeholder="{{ __('site.price') }}" />
                                <x-input-error for="data.{{ $key }}.price" class="mt-2" />
                            </div>
                            @if ($loop->index !== 0)
                                <div class="relative z-0 w-full mb-5 group mt-6">
                                    <x-danger-button wire:click="remove({{ $key }})"
                                        wire:loading.attr="disabled">
                                        {{ __('site.remove') }}
                                    </x-danger-button>
                                </div>
                            @else
                                <div class="relative z-0 w-full mb-5 group mt-6">
                                    <x-indigo-button wire:click="add" wire:loading.attr="disabled">
                                        {{ __('site.add_more') }}
                                    </x-indigo-button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </x-slot>

            <x-slot name="footer">
                <x-indigo-button type="submit" wire:loading.attr="disabled">
                    {{ __('site.save') }}
                </x-indigo-button>
                <x-secondary-button class="mx-2" wire:click="$set('create_modal',false)" wire:loading.attr="disabled">
                    {{ __('site.cancel') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
