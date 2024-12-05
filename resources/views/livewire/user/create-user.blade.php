<div>
    <x-create-button permission="create-user" />

    @if ($this->create_modal)
        <x-dialog-modal wire:model="create_modal" submit="save()" method="POST">
            <x-slot name="title">
                {{ __('site.create_new_user') }}
            </x-slot>

            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="name" value="{{ __('site.name') }}" />
                    <x-input type="text" class="mt-1 block w-full" wire:model="name"
                        placeholder="{{ __('site.name') }}" autocomplete="username" />
                    <x-input-error for="name" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-3">
                    <x-label for="email" value="{{ __('site.email') }}" />
                    <x-input type="email" class="mt-1 block w-full" wire:model="email"
                        placeholder="{{ __('site.email') }}" autocomplete="email" />
                    <x-input-error for="email" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-3">
                    <x-label for="role" value="{{ __('site.roles') }}" />
                    <x-select class="mt-1 block w-full" wire:model="role" multiple>
                        @foreach ($roles as $key => $val)
                            <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="role" class="mt-2" />
                </div>
                <div x-data="{ showPassword: false }" class="col-span-6 sm:col-span-4 mt-3">
                    <x-label for="password" value="{{ __('site.password') }}" />
                    <div class="relative">
                        <x-input id="password" class="block mt-1 w-full" ::type="showPassword ? 'text' : 'password'" wire:model="password"
                            required placeholder="{{ __('site.password') }}" autocomplete="current-password" />
                        <button class="absolute inset-y-0 rtl:left-0 ltr:right-0 px-3 flex items-center cursor-pointer"
                            x-on:click="showPassword = ! showPassword" type="button">
                            <x-icon name="eye" x-show="showPassword" />
                            <x-icon name="eye-slash" x-show="!showPassword" />
                        </button>
                    </div>
                    <x-input-error for="password" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-3">
                    <x-toggle-status :status="$status" />
                    <x-input-error for="status" class="mt-2" />
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
