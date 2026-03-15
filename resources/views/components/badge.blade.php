@props(['color' => 'green'])

@php
    $colors = [
        'green' => 'bg-green-100 text-green-700',
        'blue' => 'bg-blue-100 text-blue-700',
        'red' => 'bg-red-100 text-red-700',
    ];
@endphp

<span
    {{ $attributes->merge(['class' => 'mb-3 rounded-full px-3 py-0.5 text-[10px] font-bold text-center inline-block ' . $colors[$color]]) }}>
    {{ $slot }}
</span>
