<div>
    <x-page-content page-name="{{ __('site.dashboard') }}">
        @hasrole('User|Super Admin|Admin|Casher Kids|Casher Products')
            <h1 class="mt-6 p-2 text-2xl font-semibold text-gray-700 dark:text-white text-center">
                {{ __('site.wellcome_to_dashboard') }} {{ auth()->user()->name }}
            </h1>
        @endhasrole
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <div class="mt-5">
                @foreach ($this->totalOrdersByMonth() as $order)
                    {{ $order->total - $order->last_total }} {{ $order->months }} <br>
                @endforeach
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    @foreach ($dashboard_links as $link)
                        @can($link['role'])
                            <a wire:navigate href="{{ route($link['name']) }}">
                                <div class="{{ $link['bg'] }} {{ $link['hover'] }} rounded p-5 text-white">
                                    <div class="flex text-2xl justify-between">
                                        <x-icon class="w-12 h-12 text-center" name="{{ $link['icon'] }}" />
                                        <div class="text-center">
                                            <div>{{ $link['value'] }}</div>
                                            <div>{{ $link['count'] }}</div>
                                            <div>{{ $link['total'] ?? 0 }} {{ __('site.EGP') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endcan
                    @endforeach
                </div>
            </div>
        </div>
    </x-page-content>
</div>
