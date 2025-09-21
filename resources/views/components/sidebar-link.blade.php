@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-2 py-2 text-sm font-medium text-blue-700 bg-blue-50 rounded-md group'
            : 'flex items-center px-2 py-2 text-sm font-medium text-gray-600 rounded-md group hover:bg-gray-100 hover:text-gray-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>