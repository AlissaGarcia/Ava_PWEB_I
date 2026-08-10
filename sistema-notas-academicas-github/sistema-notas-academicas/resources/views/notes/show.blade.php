<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Visualizar Nota</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-900">{{ $note->titulo }}</h1>

                <div class="mt-2 text-sm text-gray-500">
                    Criada em: {{ $note->created_at->format('d/m/Y H:i:s') }}
                </div>

                @if ($note->updated_at->gt($note->created_at))
                    <div class="text-sm text-gray-500">
                        Atualizada em: {{ $note->updated_at->format('d/m/Y H:i:s') }}
                    </div>
                @endif

                <div class="mt-8 whitespace-pre-line text-gray-700">{{ $note->conteudo }}</div>

                <div class="flex gap-4 mt-8">
                    <a href="{{ route('notes.edit', $note) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Editar
                    </a>
                    <a href="{{ route('notes.index') }}" class="text-gray-600 px-4 py-2">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
