{{-- Componente de Botão Reutilizável --}}
{{-- Uso: <x-button variant="primary" href="/notes">Ver Notas</x-button> --}}

@props([
    'variant' => 'primary', // primary, secondary, danger, success
    'size' => 'md', // sm, md, lg
    'href' => null,
    'type' => 'button',
    'disabled' => false,
])

@php
    $variants = [
        'primary' => 'bg-indigo-600 hover:bg-indigo-700 text-white',
        'secondary' => 'bg-gray-200 hover:bg-gray-300 text-gray-800',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white',
        'success' => 'bg-green-600 hover:bg-green-700 text-white',
    ];
    
    $sizes = [
        'sm' => 'px-3 py-1 text-sm',
        'md' => 'px-4 py-2 text-base',
        'lg' => 'px-6 py-3 text-lg',
    ];
    
    $variantClass = $variants[$variant] ?? $variants['primary'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $baseClass = "$variantClass $sizeClass rounded-lg transition font-semibold";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "inline-flex items-center gap-2 $baseClass"]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" @disabled($disabled) {{ $attributes->merge(['class' => "inline-flex items-center gap-2 $baseClass" . ($disabled ? ' opacity-50 cursor-not-allowed' : '')]) }}>
        {{ $slot }}
    </button>
@endif
