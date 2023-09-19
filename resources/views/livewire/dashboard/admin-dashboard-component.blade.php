<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="mt-5">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <a href="{{ route('admin.users') }}">
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
            <a href="{{ route('admin.companies') }}">
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
            <a href="{{ route('admin.departments') }}">
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
            <a href="{{ route('admin.licenses') }}">
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
            <a href="{{ route('admin.switchs') }}">
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
            <a href="{{ route('admin.patchs') }}">
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
            <a href="{{ route('admin.ips') }}">
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
            <a href="{{ route('admin.edokis') }}">
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
            <a href="{{ route('admin.emad-edeens') }}">
                <div class="bg-green-600 hover:bg-green-700 rounded p-5 text-white">
                    <div class="flex text-2xl justify-between">
                        <x-icon class="w-12 h-12 text-center" name="arrow-trending-up" />
                        <div class="text-center">
                            <div> {{ __('EmadEdeen Schema') }}</div>
                            <div>{{ $emadEdeens }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
