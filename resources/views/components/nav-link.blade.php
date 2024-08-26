@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center hover:text-yellow-900 text-sm text-red-500'
            : 'inline-flex items-center hover:text-yellow-900 text-sm text-gray-500';
@endphp

{{-- wire:navigate used to get the page without reloading. --}}
<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
