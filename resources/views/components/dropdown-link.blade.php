@props(['active'])

@php
    $classes = $active ?? false ? 'block w-full px-4 py-2 text-left text-sm leading-5 border-l-2 border-indigo-400 bg-indigo-100 focus:outline-none focus:bg-indigo-100 transition duration-150 ease-in-out' : 'block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-indigo-50 focus:outline-none focus:bg-indigo-100 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
