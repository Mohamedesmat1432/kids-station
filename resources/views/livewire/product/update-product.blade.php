<div>
    @if ($this->edit_modal)
        <x-dialog-modal wire:model="edit_modal" submit="save()" method="PATCH">
            <x-slot name="title">
                {{ __('site.update_product') }}
            </x-slot>

            <x-slot name="content">
                <div class="grid md:grid-cols-2 md:gap-2">
                    <div class="relative z-0 w-full mb-3 group">
                        <x-label for="name" value="{{ __('site.name') }}" />
                        <x-input type="text" class="mt-1 block w-full" wire:model="name"
                            placeholder="{{ __('site.name') }}" />
                        <x-input-error for="name" class="mt-2" />
                    </div>
                    <div class="relative z-0 w-full mb-3 group">
                        <x-label for="category_id" value="{{ __('site.category_id') }}" />
                        <x-select class="mt-1 block w-full" wire:model="category_id">
                            <option value="">{{ __('site.category_id') }}</option>
                            @foreach ($categories as $key => $val)
                                <option value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="category_id" class="mt-2" />
                    </div>
                </div>
                <div class="grid md:grid-cols-1 md:gap-2">
                    <div class="relative z-0 w-full mb-3 group">
                        <x-label for="name" value="{{ __('site.description') }}" />
                        <x-textarea type="text" class="mt-1 block w-full" wire:model="description"
                            placeholder="{{ __('site.description') }}"></x-textarea>
                        <x-input-error for="description" class="mt-2" />
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-3">
                    <div class="relative z-0 w-full mb-3 group">
                        <x-label for="unit_id" value="{{ __('site.unit_id') }}" />
                        <x-select wire:change="changeQuantity" class="mt-1 block w-full" wire:model="unit_id">
                            <option value="">{{ __('site.unit_id') }}</option>
                            @foreach ($units as $key => $val)
                                <option value="{{ $key }}"jhdgbdjj>{{ $val }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="unit_id" class="mt-2" />
                    </div>
                    <div class="relative z-0 w-full mb-3 group">
                        <x-label for="qty" value="{{ __('site.qty') }}" />
                        <x-input type="text" wire:change="changeQuantity" class="mt-1 block w-full" wire:model="qty"
                            placeholder="{{ __('site.qty') }}" />
                        <x-input-error for="qty" class="mt-2" />
                    </div>
                </div>
                <div class="grid md:grid-cols-3 md:gap-2">
                    <div class="relative z-0 w-full mb-3 group">
                        <x-label for="price" value="{{ __('site.price') }}" />
                        <x-input type="text" class="mt-1 block w-full" wire:model="price" wire:keyup="revenuePrice"
                            placeholder="{{ __('site.price') }}" />
                        <x-input-error for="price" class="mt-2" />
                    </div>
                    <div class="relative z-0 w-full mb-3 group">
                        <x-label for="purchase_price" value="{{ __('site.purchase_price') }}" />
                        <x-input type="text" class="mt-1 block w-full" wire:model="purchase_price"
                            wire:keyup="revenuePrice" placeholder="{{ __('site.purchase_price') }}" />
                        <x-input-error for="purchase_price" class="mt-2" />
                    </div>
                    <div class="relative z-0 w-full mb-3 group">
                        <x-label for="revenue_price" value="{{ __('site.revenue_price') }}" />
                        <x-input type="text" class="mt-1 block w-full" wire:model="revenue_price"
                            placeholder="{{ __('site.revenue_price') }}" />
                        <x-input-error for="revenue_price" class="mt-2" />
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-indigo-button type="submit" wire:loading.attr="disabled">
                    {{ __('site.save') }}
                </x-indigo-button>
                <x-secondary-button class="mx-2" wire:click="$set('edit_modal',false)" wire:loading.attr="disabled">
                    {{ __('site.cancel') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
