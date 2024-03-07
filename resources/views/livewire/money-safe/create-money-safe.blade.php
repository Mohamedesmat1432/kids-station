<div>
    <form wire:submit="save" class="md:flex text-gray-500">
        <div class="col-span-6 sm:col-span-4 mt-3">
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
        <div class="col-span-6 sm:col-span-4 mt-3">
            <x-indigo-button class="mt-1 block md:w-full" type="submit" wire:loading.attr="disabled">
                {{ __('site.close_money_safe') }}
            </x-indigo-button>
        </div>
    </form>
</div>
