<div>
    @hasrole('User|Super Admin|Admin')
        <h1 class="mt-6 p-2 text-2xl font-semibold text-gray-700 dark:text-white text-center">
            Welcome To Dashboard {{ auth()->user()->name }}
        </h1>
    @endhasrole
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <div class="mt-5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @can('view-user')
                    <a wire:navigate href="{{ route('users') }}">
                        <div class="bg-indigo-600 hover:bg-indigo-700 rounded p-5 text-white">
                            <div class="flex text-2xl justify-between">
                                <x-icon class="w-12 h-12 text-center" name="user" />
                                <div class="text-center">
                                    <div> {{ __('Users') }}</div>
                                    <div>{{ $users }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endcan
                @can('view-role')
                    <a wire:navigate href="{{ route('roles') }}">
                        <div class="bg-gray-700 hover:bg-gray-800 rounded p-5 text-white">
                            <div class="flex text-2xl justify-between">
                                <x-icon class="w-12 h-12 text-center" name="lock-closed" />
                                <div class="text-center">
                                    <div> {{ __('Roles') }}</div>
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
                                    <div> {{ __('Permissions') }}</div>
                                    <div>{{ $permissions }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endcan
                @can('view-company')
                    <a wire:navigate href="{{ route('companies') }}">
                        <div class="bg-yellow-500 hover:bg-yellow-600 rounded p-5 text-white">
                            <div class="flex text-2xl justify-between">
                                <x-icon class="w-12 h-12 text-center" name="home-modern" />
                                <div class="text-center">
                                    <div> {{ __('Companies') }}</div>
                                    <div>{{ $companies }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endcan
                @can('view-department')
                    <a wire:navigate href="{{ route('departments') }}">
                        <div class="bg-red-500 hover:bg-red-600 rounded p-5 text-white">
                            <div class="flex text-2xl justify-between">
                                <x-icon class="w-12 h-12 text-center" name="rectangle-stack" />
                                <div class="text-center">
                                    <div> {{ __('Departments') }}</div>
                                    <div>{{ $departments }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endcan
                @can('view-license')
                    <a wire:navigate href="{{ route('licenses') }}">
                        <div class="bg-green-500 hover:bg-green-600 rounded p-5 text-white">
                            <div class="flex text-2xl justify-between">
                                <x-icon class="w-12 h-12 text-center" name="clipboard-document-check" />
                                <div class="text-center">
                                    <div> {{ __('Licenses') }}</div>
                                    <div>{{ $licenses }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endcan
                @can('view-orange')
                    <a wire:navigate href="{{ route('oranges') }}">
                        <div class="bg-orange-500 hover:bg-orange-600 rounded p-5 text-white">
                            <div class="flex text-2xl justify-between">
                                <x-icon class="w-12 h-12 text-center" name="clipboard-document-check" />
                                <div class="text-center">
                                    <div> {{ __('Oranges') }}</div>
                                    <div>{{ $oranges }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endcan
                @can('view-switch')
                    <a wire:navigate href="{{ route('switchs') }}">
                        <div class="bg-gray-700 hover:bg-gray-800 rounded p-5 text-white">
                            <div class="flex text-2xl justify-between">
                                <x-icon class="w-12 h-12 text-center" name="server-stack" />
                                <div class="text-center">
                                    <div> {{ __('Switchs') }}</div>
                                    <div>{{ $switchs }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endcan
                @can('view-patch')
                    <a wire:navigate href="{{ route('patchs') }}">
                        <div class="bg-gray-500 hover:bg-gray-600 rounded p-5 text-white">
                            <div class="flex text-2xl justify-between">
                                <x-icon class="w-12 h-12 text-center" name="server" />
                                <div class="text-center">
                                    <div> {{ __('Patchs') }}</div>
                                    <div>{{ $patchs }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endcan
                @can('view-point')
                    <a wire:navigate href="{{ route('points') }}">
                        <div class="bg-green-600 hover:bg-green-700 rounded p-5 text-white">
                            <div class="flex text-2xl justify-between">
                                <x-icon class="w-12 h-12 text-center" name="server" />
                                <div class="text-center">
                                    <div> {{ __('Points') }}</div>
                                    <div>{{ $points }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endcan
                @can('view-device')
                    <a wire:navigate href="{{ route('devices') }}">
                        <div class="bg-indigo-500 hover:bg-indigo-600 rounded p-5 text-white">
                            <div class="flex text-2xl justify-between">
                                <x-icon class="w-12 h-12 text-center" name="computer-desktop" />
                                <div class="text-center">
                                    <div> {{ __('Devices') }}</div>
                                    <div>{{ $devices }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endcan
                @can('view-ip')
                    <a wire:navigate href="{{ route('ips') }}">
                        <div class="bg-blue-500 hover:bg-blue-600 rounded p-5 text-white">
                            <div class="flex text-2xl justify-between">
                                <x-icon class="w-12 h-12 text-center" name="arrow-trending-up" />
                                <div class="text-center">
                                    <div> {{ __('IPs') }}</div>
                                    <div>{{ $ips }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endcan
                @can('view-schema')
                    <a wire:navigate href="{{ route('edokis') }}">
                        <div class="bg-red-600 hover:bg-red-700 rounded p-5 text-white">
                            <div class="flex text-2xl justify-between">
                                <x-icon class="w-12 h-12 text-center" name="arrow-trending-up" />
                                <div class="text-center">
                                    <div> {{ __('Edoki Schema') }}</div>
                                    <div>{{ $edokis }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a wire:navigate href="{{ route('emad-edeens') }}">
                        <div class="bg-gray-500 hover:bg-gray-600 rounded p-5 text-white">
                            <div class="flex text-2xl justify-between">
                                <x-icon class="w-12 h-12 text-center" name="arrow-trending-up" />
                                <div class="text-center">
                                    <div> {{ __('EmadEdeen Schema') }}</div>
                                    <div>{{ $emadEdeens }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endcan

            </div>
        </div>
    </div>
</div>
