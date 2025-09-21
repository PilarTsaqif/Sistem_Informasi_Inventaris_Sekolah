@props(['active' => false])

@php
// Menentukan kelas CSS berdasarkan kondisi 'active' atau tidak
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-2.5 rounded-lg bg-blue-600 text-white shadow-md transition-colors duration-200 ease-in-out'
            : 'flex items-center px-4 py-2.5 rounded-lg text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>