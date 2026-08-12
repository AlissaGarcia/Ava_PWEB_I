{{-- Componente de Card Genérico --}}
{{-- Uso: <x-card title="Minhas Notas">Conteúdo aqui</x-card> --}}

@props([
    'title' => null,
    'subtitle' => null,
])

<div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
    @if($title)
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <div>
                @if($title)
                    <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
                @endif
                @if($subtitle)
                    <p class="mt-1 text-sm text-gray-600">{{ $subtitle }}</p>
                @endif
            </div>
        </div>
    @endif
    <div class="px-6 py-4">
        {{ $slot }}
    </div>
</div>
