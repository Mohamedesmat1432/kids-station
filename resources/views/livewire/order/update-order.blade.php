<div>
    @if ($this->edit_modal)
        <x-dialog-modal wire:model="edit_modal" submit="save()" method="PATCH">
            <x-slot name="title">
                <div class="flex justify-between">
                    <h1>{{ __('site.update_order') }}</h1>
                    <div>{{ __('site.total') }} : {{ number_format($this->total, 2) }} {{ __('site.EGP') }}</div>
                </div>
            </x-slot>

            <x-slot name="content">
                <div class="grid md:grid-cols-3 md:gap-4">
                    <div class="relative z-0 w-full mb-5 group">
                        <x-label for="name" value="{{ __('site.customer_name') }}" />
                        <x-input type="text" class="mt-1 block w-full" wire:model="customer_name"
                            placeholder="{{ __('site.customer_name') }}" autocomplete="customer_name" disabled />
                        <x-input-error for="customer_name" class="mt-2" />
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <x-label for="name" value="{{ __('site.customer_phone') }}" />
                        <x-input type="text" class="mt-1 block w-full" wire:model="customer_phone"
                            placeholder="{{ __('site.customer_phone') }}" autocomplete="customer_phone" disabled />
                        <x-input-error for="customer_phone" class="mt-2" />
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <x-label for="duration" value="{{ __('site.duration') }}" />
                        <x-select wire:change="refreshAttachVisitors" class="mt-1 block w-full" wire:model="duration"
                            disabled>
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
                                <x-label for="name" value="{{ __('site.name') }}" />
                                @if ($visitor['name'] != '')
                                    <x-input type="text" class="mt-1 block w-full"
                                        wire:model="visitors.{{ $key }}.name"
                                        placeholder="{{ __('site.name') }}"
                                        autocomplete="visitors.{{ $key }}.name" disabled />
                                @else
                                    <x-input type="text" class="mt-1 block w-full"
                                        wire:model="visitors.{{ $key }}.name"
                                        placeholder="{{ __('site.name') }}"
                                        autocomplete="visitors.{{ $key }}.name" />
                                @endif
                                <x-input-error for="visitors.{{ $key }}.name" class="mt-2" />
                            </div>
                            <div class="relative z-0  w-full mb-5 group md:col-span-2">
                                <x-label for="type_id" value="{{ __('site.type') }}" />
                                @if ($visitor['type_id'] != '')
                                    <x-input type="hidden" class="mt-1 block w-full"
                                        wire:model="visitors.{{ $key }}.type_id" />
                                    <x-input type="text" class="mt-1 block w-full"
                                        value="{{ $this->visitorType($visitor['type_id']) }}" disabled />
                                @else
                                    <x-select wire:change="totalVisitors"
                                        wire:model="visitors.{{ $key }}.type_id" class="mt-1 block w-full">
                                        <option value="">{{ __('site.type') }}</option>
                                        @foreach ($unique_types as $type)
                                            <option value="{{ $type->id }}">
                                                {{ $type->typeName->name }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                @endif
                                <x-input-error for="visitors.{{ $key }}.type_id" class="mt-2" />
                            </div>
                            {{-- <div class="relative z-0 w-full mb-5 group">
                                <x-label for="serial" value="{{ __('site.serial') }}" />
                                <x-input type="text" class="mt-1 block w-full"
                                    wire:model="visitors.{{ $key }}.serial"
                                    placeholder="{{ __('site.serial') }}" disabled />
                                <x-input-error for="visitors.{{ $key }}.serial" class="mt-2" />
                            </div> --}}
                            <div class="relative z-0 w-full mb-5 group">
                                <x-label for="price" value="{{ __('site.price') }}" />
                                <x-input type="number" class="mt-1 block w-full"
                                    wire:model="visitors.{{ $key }}.price"
                                    placeholder="{{ __('site.price') }}" disabled />
                                <x-input-error for="visitors.{{ $key }}.price" class="mt-2" />
                            </div>

                            @if ($loop->index !== 0)
                                <div class="relative z-0 w-full mb-5 group md:mt-6">
                                    @if (auth()->user()->hasRole(['Super Admin']))
                                        <x-danger-button wire:click="remove({{ $key }})"
                                            wire:loading.attr="disabled">
                                            {{ __('site.remove') }}
                                        </x-danger-button>
                                    @else
                                        @if ($visitor['name'] != '' && $visitor['type_id'] != '')
                                            <x-danger-button class="cursor-not-allowed opacity-60">
                                                {{ __('site.remove') }}
                                            </x-danger-button>
                                        @else
                                            <x-danger-button wire:click="remove({{ $key }})"
                                                wire:loading.attr="disabled">
                                                {{ __('site.remove') }}
                                            </x-danger-button>
                                        @endif
                                    @endif
                                </div>
                            @else
                                <div class="relative z-0 w-full mb-5 group md:mt-6 flex">
                                    @if (auth()->user()->hasRole(['Super Admin']))
                                        <x-danger-button wire:click="remove({{ $key }})"
                                            wire:loading.attr="disabled">
                                            {{ __('site.remove') }}
                                        </x-danger-button>
                                        <div class="mx-1"></div>
                                    @endif
                                    <x-indigo-button wire:click="add" wire:loading.attr="disabled">
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
                            <x-select wire:change="totalVisitors" class="mt-1 block w-full" wire:model="offer_id">
                                <option value="{{ null }}">{{ __('site.offer') }}</option>
                                @foreach ($offers as $offer)
                                    <option value="{{ $offer->id }}">
                                        {{ $offer->name }} / {{ $offer->price }} {{ __('site.EGP') }}
                                    </option>
                                @endforeach
                            </x-select>
                            <x-input-error for="offer_id" class="mt-2" />
                        </div>
                        @if ($this->offer_id)
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="font-bold text-center bg-gray-100 rounded mt-5 p-2">
                                    <span> {{ __('site.discount') }}:</span>
                                    <span>{{ $this->priceOffer($this->offer_id) }}
                                        {{ __('site.EGP') }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                <div class="grid md:grid-cols-2 md:gap-4">
                    <div class="relative z-0 w-full mb-5 group">
                        <x-label for="locker_number" value="{{ __('site.locker_number') }}" />
                        <x-input type="text" class="mt-1 block w-full" wire:model="locker_number"
                            placeholder="{{ __('site.locker_number') }}" autocomplete="locker_number" />
                        <x-input-error for="locker_number" class="mt-2" />
                    </div>
                    <div class="relative z-0 w-full mb-5">
                        <x-label for="insurance" value="{{ __('site.insurance') }}" />
                        <x-input type="text" class="mt-1 block w-full" wire:model="insurance"
                            placeholder="{{ __('site.insurance') }}" autocomplete="insurance" />
                        <x-input-error for="insurance" class="mt-2" />
                    </div>
                </div>
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

                <x-secondary-button class="mx-2" wire:click="$set('edit_modal',false)"
                    wire:loading.attr="disabled">
                    {{ __('site.cancel') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>