<div x-data="{ langMenu: false }"
    class="relative mx-4 inline-flex items-center px-1 pt-1 hover:border-b-2 hover:border-gray-300 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-blue-700 transition duration-150 ease-in-out">
    <!-- Dropdown toggle button -->
    <button @click="langMenu = ! langMenu" class="rounded-md">
        <span>{{ __('site.lang') }} </span>
    </button>
    <!-- Dropdown list -->
    <div x-show="langMenu" class="absolute right-0 top-10 py-2 mt-5 rounded-md shadow-xl w-44 bg-white">
        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a class="block px-4 py-2 text-sm hover:bg-blue-400 hover:text-white {{ $localeCode === LaravelLocalization::getCurrentLocale() ? 'bg-blue-500 text-white font-bold' : '' }}"
                rel="alternate" hreflang="{{ $localeCode }}"
                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                {{ $properties['native'] }}
            </a>
        @endforeach
    </div>
</div>
