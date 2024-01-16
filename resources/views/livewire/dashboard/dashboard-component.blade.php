<div>
    <x-page-content page-name="{{ __('site.dashboard') }}">
        @hasrole('User|Super Admin|Admin')
            <h1 class="mt-6 p-2 text-2xl font-semibold text-gray-700 dark:text-white text-center">
                {{ __('site.wellcome_to_dashboard') }} {{ auth()->user()->name }}
            </h1>
        @endhasrole
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <div class="mt-5">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    @can('view-user')
                        <a wire:navigate href="{{ route('users') }}">
                            <div class="bg-blue-600 hover:bg-blue-700 rounded p-5 text-white">
                                <div class="flex text-2xl justify-between">
                                    <x-icon class="w-12 h-12 text-center" name="user-group" />
                                    <div class="text-center">
                                        <div> {{ __('site.users') }}</div>
                                        <div>{{ $users }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endcan
                    @can('view-category')
                        <a wire:navigate href="{{ route('categories') }}">
                            <div class="bg-yellow-500 hover:bg-yellow-600 rounded p-5 text-white">
                                <div class="flex text-2xl justify-between">
                                    <x-icon class="w-12 h-12 text-center" name="rectangle-group" />
                                    <div class="text-center">
                                        <div> {{ __('site.categories') }}</div>
                                        <div>{{ $categories }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endcan
                    @can('view-unit')
                        <a wire:navigate href="{{ route('units') }}">
                            <div class="bg-green-500 hover:bg-green-600 rounded p-5 text-white">
                                <div class="flex text-2xl justify-between">
                                    <x-icon class="w-12 h-12 text-center" name="currency-dollar" />
                                    <div class="text-center">
                                        <div> {{ __('site.units') }}</div>
                                        <div>{{ $units }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endcan
                    @can('view-type-name')
                        <a wire:navigate href="{{ route('type-names') }}">
                            <div class="bg-red-500 hover:bg-red-600 rounded p-5 text-white">
                                <div class="flex text-2xl justify-between">
                                    <x-icon class="w-12 h-12 text-center" name="clipboard-document-list" />
                                    <div class="text-center">
                                        <div> {{ __('site.type_names') }}</div>
                                        <div>{{ $type_names }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endcan
                    @can('view-type')
                        <a wire:navigate href="{{ route('types') }}">
                            <div class="bg-green-500 hover:bg-green-600 rounded p-5 text-white">
                                <div class="flex text-2xl justify-between">
                                    <x-icon class="w-12 h-12 text-center" name="adjustments-horizontal" />
                                    <div class="text-center">
                                        <div> {{ __('site.types') }}</div>
                                        <div>{{ $types }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endcan
                    @can('view-role')
                        <a wire:navigate href="{{ route('roles') }}">
                            <div class="bg-gray-600 hover:bg-gray-700 rounded p-5 text-white">
                                <div class="flex text-2xl justify-between">
                                    <x-icon class="w-12 h-12 text-center" name="lock-closed" />
                                    <div class="text-center">
                                        <div> {{ __('site.roles') }}</div>
                                        <div>{{ $roles }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endcan
                    @can('view-permission')
                        <a wire:navigate href="{{ route('permissions') }}">
                            <div class="bg-gray-500 hover:bg-gray-600 rounded p-5 text-white">
                                <div class="flex text-2xl justify-between">
                                    <x-icon class="w-12 h-12 text-center" name="receipt-percent" />
                                    <div class="text-center">
                                        <div> {{ __('site.permissions') }}</div>
                                        <div>{{ $permissions }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endcan
                    @can('view-offer')
                        <a wire:navigate href="{{ route('offers') }}">
                            <div class="bg-yellow-500 hover:bg-yellow-600 rounded p-5 text-white">
                                <div class="flex text-2xl justify-between">
                                    <x-icon class="w-12 h-12 text-center" name="gift" />
                                    <div class="text-center">
                                        <div> {{ __('site.offers') }}</div>
                                        <div>{{ $offers }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endcan
                    @can('view-order')
                        <a wire:navigate href="{{ route('orders') }}">
                            <div class="bg-blue-500 hover:bg-blue-600 rounded p-5 text-white">
                                <div class="flex text-2xl justify-between">
                                    <x-icon class="w-12 h-12 text-center" name="document-chart-bar" />
                                    <div class="text-center">
                                        <div> {{ __('site.orders') }}</div>
                                        <div>{{ $orders }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </x-page-content>
</div>
