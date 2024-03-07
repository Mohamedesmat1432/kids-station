@foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    <x-responsive-nav-link class="flex" :active="$localeCode === LaravelLocalization::getCurrentLocale()" rel="alternate" hreflang="{{ $localeCode }}"
        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
        <img src="{{ asset('images/' . $localeCode . '.jpg') }}" alt="{{ $localeCode }}" class="w-5 h-5" />
        <span>{{ $properties['native'] }}</span>
    </x-responsive-nav-link>
@endforeach
