{{-- Componente de Input de Formulário --}}
{{-- Uso: <x-form-input name="titulo" label="Título" placeholder="Digite aqui" /> --}}

@props([
    'name',
    'label' => null,
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'error' => null,
])

@php
    $hasError = $error || $errors->has($name);
@endphp

<div>
    @if($label)
        <label for="{{ $name }}" class="block font-semibold text-sm text-gray-700 mb-2">
            {{ $label }}
        </label>
    @endif
    
    @if($type === 'textarea')
        <textarea 
            name="{{ $name }}" 
            id="{{ $name }}" 
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => "block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent" . ($hasError ? ' border-red-500' : ' border-gray-300')]) }}
        >{{ old($name, $value) }}</textarea>
    @else
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            id="{{ $name }}" 
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => "block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent" . ($hasError ? ' border-red-500' : ' border-gray-300')]) }}
        />
    @endif
    
    @if($hasError)
        <p class="text-red-600 text-sm mt-2">{{ $error ?? $errors->first($name) }}</p>
    @endif
</div>
