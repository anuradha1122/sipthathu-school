@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex rounded-l-full items-center px-4 py-2 space-x-2 hover:bg-blue-900 transition bg-blue-900 text-white font-semibold'
            : 'flex rounded-l-full items-center px-4 py-2 space-x-2 hover:bg-blue-900 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>