<div x-on:click="langMenu = ! langMenu" x-data="{ langMenu: false }" x-on:click.away="langMenu = false" x-on:close.stop="langMenu = false"
    class="relative cursor-pointer mx-4 justify-center inline-flex items-center px-1 pt-1 hover:border-b-2 hover:border-gray-300 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-blue-700">
    <!-- Dropdown toggle button -->
    <span class="flex text-gray-500 hover:text-gray-700">
        <x-icon name="language" class="w-4 h-4" />
        <span>{{ __('site.lang') }} </span>
    </span>
    <!-- Dropdown list -->
    <div x-show="langMenu" class="absolute z-50 rtl:right-0 ltr:left-0 top-10 py-2 mt-5 rounded-md shadow-xl w-36 bg-white">
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
