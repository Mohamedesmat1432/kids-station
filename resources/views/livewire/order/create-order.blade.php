<div>
    <x-create-button permission="create-order-kids" />

    @if ($this->create_modal)
        <x-dialog-modal wire:model="create_modal" submit="save()" method="POST">
            <x-slot name="title">
                <div class="flex justify-between">
                    <div>{{ __('site.create_new_order') }}</div>
                    <div>{{ __('site.total') }} : {{ number_format($this->total, 2) }} {{ __('site.EGP') }}</div>
                </div>
            </x-slot>

            <x-slot name="content">
                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <x-label for="name" value="{{ __('site.customer_name') }}" />
                        <x-input type="text" class="mt-1 block w-full" wire:model="customer_name"
                            placeholder="{{ __('site.customer_name') }}" autocomplete="customer_name" />
                        <x-input-error for="customer_name" class="mt-2" />
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <x-label for="name" value="{{ __('site.customer_phone') }}" />
                        <x-input type="text" class="mt-1 block w-full" wire:model="customer_phone"
                            placeholder="{{ __('site.customer_phone') }}" autocomplete="customer_phone" />
                        <x-input-error for="customer_phone" class="mt-2" />
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <x-label for="duration" value="{{ __('site.duration') }}" />
                        <x-select wire:change="refreshNewVisitor" class="mt-1 block w-full" wire:model="duration">
                            <option value="">{{ __('site.duration') }}</option>
                            @foreach ($type_durations as $duration)
                                <option value="{{ $duration }}">{{ $duration }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="duration" class="mt-2" />
                    </div>
                </div>

                @if ($visitors)
                    @foreach ($visitors as $key => $visitor)
                        <div class="grid md:grid-cols-7 md:gap-3">
                            <div class="relative z-0 w-full mb-5 group md:col-span-2">
                                <x-label for="name" value="{{ __('si.tename') }}" />
                                <x-input type="text" class="mt-1 block w-full"
                                    wire:model="visitors.{{ $key }}.name" placeholder="{{ __('site.name') }}"
                                    autocomplete="visitors.{{ $key }}.name" />
                                <x-input-error for="visitors.{{ $key }}.name" class="mt-2" />
                            </div>
                            <div class="relative z-0 min-w-max mb-5 group md:col-span-2">
                                <x-label for="type_id" value="{{ __('site.type') }}" />
                                <x-select wire:change="totalVisitors" class="mt-1 block w-full"
                                    wire:model="visitors.{{ $key }}.type_id">
                                    <option value="">{{ __('site.type') }}</option>
                                    @foreach ($unique_types as $type)
                                        <option value="{{ $type->id }}">
                                            {{ $type->typeName->name }}
                                        </option>
                                    @endforeach
                                </x-select>
                                <x-input-error for="visitors.{{ $key }}.type_id" class="mt-2" />
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <x-label for="name" value="{{ __('site.serial') }}" />
                                <x-input type="text" class="mt-1 block w-full"
                                    wire:model="visitors.{{ $key }}.serial"
                                    placeholder="{{ __('site.serial') }}"
                                    autocomplete="visitors.{{ $key }}.serial" />
                                <x-input-error for="visitors.{{ $key }}.serial" class="mt-2" />
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <x-label for="price" value="{{ __('site.price') }}" />
                                <x-input type="number" class="mt-1 block w-full" disabled
                                    wire:model="visitors.{{ $key }}.price"
                                    placeholder="{{ __('site.price') }}" />
                                <x-input-error for="visitors.{{ $key }}.price" class="mt-2" />
                            </div>
                            @if ($loop->index !== 0)
                                <div class="relative z-0 w-full mb-5 group">
                                    <x-danger-button class="mt-6" wire:click="remove({{ $key }})"
                                        wire:loading.attr="disabled">
                                        {{ __('site.remove') }}
                                    </x-danger-button>
                                </div>
                            @else
                                <div class="relative z-0 w-full mb-5 group">
                                    <x-indigo-button wire:click="add" class="mt-6" wire:loading.attr="disabled">
                                        {{ __('site.add_more') }}
                                    </x-indigo-button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif

                @if (count($offers) > 0)
                    <div class="grid md:grid-cols-2 md:gap-4">
                        <div class="relative z-0 w-full mb-5 group">
                            <x-label for="offer_id" value="{{ __('site.offer') }}" />
                            <x-select wire:change="discount" class="mt-1 block w-full" wire:model="offer_id">
                                <option value="">{{ __('site.offer') }}</option>
                                @foreach ($offers as $offer)
                                    <option value="{{ $offer->id }}">
                                        {{ $offer->name }} - {{ $offer->price }} {{ __('site.EGP') }}
                                    </option>
                                @endforeach
                            </x-select>
                            <x-input-error for="offer_id" class="mt-2" />
                        </div>
                        @if ($this->offer_id)
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="font-bold text-center bg-gray-100 rounded mt-5 p-2">
                                    <span> {{ __('site.discount') }}:</span>
                                    <span>-{{ App\Models\Offer::find($this->offer_id)->price }}
                                        {{ __('site.EGP') }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                <div class="relative z-0 w-full mb-5 group">
                    <x-label for="note" value="{{ __('site.note') }}" />
                    <x-textarea class="mt-1 block w-full" wire:model="note" placeholder="{{ __('site.note') }}">
                    </x-textarea>
                    <x-input-error for="note" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-indigo-button type="submit" wire:loading.attr="disabled">
                    {{ __('site.save') }}
                </x-indigo-button>
                <x-secondary-button class="mx-2" wire:click="$set('create_modal',false)"
                    wire:loading.attr="disabled">
                    {{ __('site.cancel') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
