<div>
    @if ($this->attach_modal)
        <x-dialog-modal wire:model="attach_modal" submit="save()" method="PATCH">
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
                        <x-select wire:change="refreshAttachVisitors" class="mt-1 block w-full" wire:model="duration">
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
                        <div class="grid md:grid-cols-5 md:gap-3">
                            <div class="relative z-0 w-full mb-5 group">
                                <x-label for="name" value="{{ __('site.name') }}" />
                                <x-input type="text" class="mt-1 block w-full"
                                    wire:model="visitors.{{ $key }}.name" placeholder="{{ __('site.name') }}"
                                    autocomplete="visitors.{{ $key }}.name" disabled />
                                <x-input-error for="visitors.{{ $key }}.name" class="mt-2" />
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <x-label for="type_id" value="{{ __('site.type') }}" />
                                <x-input type="hidden" class="mt-1 block w-full"
                                    wire:model="visitors.{{ $key }}.type_id" />
                                <x-input type="text" class="mt-1 block w-full"
                                    value="{{ App\Models\Type::find($visitor['type_id'])->typeName->name ?? '' }}"
                                    disabled />
                                <x-input-error for="visitors.{{ $key }}.type_id" class="mt-2" />
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <x-label for="serial" value="{{ __('site.serial') }}" />
                                <x-input type="text" class="mt-1 block w-full"
                                    wire:model="visitors.{{ $key }}.serial"
                                    placeholder="{{ __('site.serial') }}" disabled />
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
                                <div class="relative z-0 w-full mb-5 group mt-6">
                                    @can('remove-visitor')
                                        <x-danger-button wire:click="remove({{ $key }})"
                                            wire:loading.attr="disabled">
                                            {{ __('site.remove') }}
                                        </x-danger-button>
                                    @else
                                        <x-danger-button class="cursor-not-allowed opacity-60">
                                            {{ __('site.remove') }}
                                            </x-indigo-button>
                                        @endcan
                                </div>
                            @else
                                <div class="relative z-0 w-full mb-5 group mt-6">
                                    @can('add-more-visitor')
                                        <x-indigo-button wire:click="add" wire:loading.attr="disabled">
                                            {{ __('site.add_more') }}
                                        </x-indigo-button>
                                    @else
                                        <x-indigo-button class="cursor-not-allowed opacity-60">
                                            {{ __('site.add_more') }}
                                        </x-indigo-button>
                                    @endcan

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
                                    <span>{{ App\Models\Offer::find($this->offer_id)->price }}
                                        {{ __('site.EGP') }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </x-slot>

            <x-slot name="footer">
                @if ($this->order->duration !== $this->duration)
                    <x-indigo-button type="submit" wire:loading.attr="disabled">
                        {{ __('site.save') }}
                    </x-indigo-button>
                @else
                    <x-indigo-button disabled class="cursor-not-allowed opacity-60">
                        {{ __('site.save') }}
                    </x-indigo-button>
                @endif

                <x-secondary-button class="mx-2" wire:click="$set('attach_modal',false)"
                    wire:loading.attr="disabled">
                    {{ __('site.cancel') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
