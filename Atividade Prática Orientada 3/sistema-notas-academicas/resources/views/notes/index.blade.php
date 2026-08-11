<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Minhas Notas</h2>
            <a href="{{ route('notes.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Nova Nota
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($notes->isEmpty())
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-gray-600">Você ainda não possui nenhuma nota.</p>
                    <a href="{{ route('notes.create') }}" class="inline-block mt-4 text-indigo-600 hover:text-indigo-800">
                        Criar minha primeira nota
                    </a>
                </div>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($notes as $note)
                        <div class="bg-white shadow-sm sm:rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $note->titulo }}</h3>
                            <p class="mt-2 text-sm text-gray-500">
                                Criada em: {{ $note->created_at->format('d/m/Y H:i') }}
                            </p>
                            <p class="mt-4 text-gray-600">Conteúdo protegido por criptografia.</p>

                            <div class="flex gap-3 mt-6">
                                <a href="{{ route('notes.show', $note) }}" class="text-indigo-600 hover:text-indigo-800">Visualizar</a>
                                <a href="{{ route('notes.edit', $note) }}" class="text-blue-600 hover:text-blue-800">Editar</a>

                                <form action="{{ route('notes.destroy', $note) }}" method="POST"
                                      onsubmit="return confirm('Deseja realmente excluir esta nota?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Excluir</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
