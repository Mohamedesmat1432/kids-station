@props(['value'])

<span {{ $attributes->merge(['class' => 'font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</span>
