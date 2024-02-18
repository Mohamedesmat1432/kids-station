<div>
    <x-create-button permission="create-money-safe-product" />

    @if ($this->create_modal)
        <x-dialog-modal wire:model="create_modal" submit="save()" method="POST">
            <x-slot name="title">
                {{ __('site.create_new_money_safe_product') }}
            </x-slot>

            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4 mt-3">
                    <x-label for="user_id" value="{{ __('site.name') }}" />
                    <x-select class="mt-1 block w-full" wire:model="user_id">
                        <option value="">{{ __('site.select_user') }}</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="user_id" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-3">
                    <x-label for="date_now" value="{{ __('site.date_now') }}" />
                    <x-input type="date" class="mt-1 block w-full" wire:model="date_now"
                        placeholder="{{ __('site.date_now') }}" autocomplete="date_now" />
                    <x-input-error for="date_now" class="mt-2" />
                </div>
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
