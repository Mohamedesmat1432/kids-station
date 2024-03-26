<div>
    <x-page-content page-name="{{ __('site.money_safe_products') }}">

        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

            <div class="md:flex justify-between">
                <h1 class=" text-2xl font-medium text-gray-900">
                    {{ __('site.money_safe_products') }}
                </h1>
            </div>

            <div class="mt-6 text-gray-500 leading-relaxed">
                <form wire:submit="showMoneySafeProduct">
                    <div class="mt-2 md:flex text-gray-500">
                        <div class="col-span-6 sm:col-span-4 mt-3 md:mx-1">
                            <x-select class="mt-1 block w-full" wire:model="user_id">
                                <option value="">{{ __('site.select_user') }}</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error for="user_id" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4 mt-3 md:mx-1">
                            <x-input type="date" class="mt-1 block w-full" wire:model="start_date"
                                placeholder="{{ __('site.start_date') }}" autocomplete="start_date" />
                            <x-input-error for="start_date" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4 mt-3 md:mx-1">
                            <x-input type="date" class="mt-1 block w-full" wire:model="end_date"
                                placeholder="{{ __('site.end_date') }}" autocomplete="end_date" />
                            <x-input-error for="end_date" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4 mt-3 md:mx-1">
                            <x-indigo-button class="mt-1 block md:w-full" type="submit" wire:loading.attr="disabled">
                                {{ __('site.show') }}
                            </x-indigo-button>
                        </div>
                    </div>
                </form>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-14 mt-10">
                    <div class="bg-green-500 hover:bg-green-600 rounded p-3 text-white text-center text-2xl">
                        <div>{{ __('site.total_order') }}</div>
                        <div class="mt-3">{{ $this->total_order ?? number_format(0, 2) }}</div>
                    </div>
                    <div class="bg-blue-500 hover:bg-blue-600 rounded p-3 text-white text-center text-2xl">
                        <div>{{ __('site.total_daily_expense') }}</div>
                        <div class="mt-3">{{ $this->total_daily_expense ?? number_format(0, 2) }}</div>
                    </div>
                    <div class="bg-red-500 hover:bg-red-600 rounded p-3 text-white text-center text-2xl">
                        <div>{{ __('site.total') }}</div>
                        <div class="mt-3">{{ $this->total ?? number_format(0, 2) }}</div>
                    </div>
                </div>
            </div>
    </x-page-content>
</div>
