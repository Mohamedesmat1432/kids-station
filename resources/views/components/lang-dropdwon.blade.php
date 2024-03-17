<div x-cloak x-data="{ langMenu: false }" @click.away="langMenu = false" @close.stop="langMenu = false"
    class="relative cursor-pointer mx-4 inline-flex items-center px-1 pt-1 hover:border-b-2 hover:border-gray-300 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-blue-700">
    <!-- Dropdown toggle button -->
    <a @click="langMenu = ! langMenu" class="flex text-gray-500 hover:text-gray-700">
        <x-icon name="language" class="w-4 h-4" />
        <span>{{ __('site.lang') }} </span>
    </a>
    <!-- Dropdown list -->
    <div x-show="langMenu" class="absolute right-0 top-10 py-2 mt-5 rounded-md shadow-xl w-36 bg-white "
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
        style="display: none;">
        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a class="flex justify-between px-4 py-2 text-sm hover:bg-blue-400 hover:text-white {{ $localeCode === LaravelLocalization::getCurrentLocale() ? 'bg-blue-500 text-white font-bold' : '' }}"
                rel="alternate" hreflang="{{ $localeCode }}"
                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                <span>{{ $properties['native'] }}</span>
                <img src="{{ asset('images/' . $localeCode . '.jpg') }}" alt="{{ $localeCode }}" class="w-6 h-6" />
            </a>
        @endforeach
    </div>
</div>
