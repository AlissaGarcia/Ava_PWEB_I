<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Nota</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('notes.update', $note) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="titulo" class="block font-medium text-sm text-gray-700">Título</label>
                        <input type="text" name="titulo" id="titulo"
                               value="{{ old('titulo', $note->titulo) }}" required
                               class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        @error('titulo')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <label for="conteudo" class="block font-medium text-sm text-gray-700">Conteúdo</label>
                        <textarea name="conteudo" id="conteudo" rows="10" required
                                  class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('conteudo', $note->conteudo) }}</textarea>
                        @error('conteudo')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-2">O conteúdo será novamente criptografado ao salvar.</p>
                    </div>

                    <div class="flex items-center gap-4 mt-6">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Atualizar Nota
                        </button>
                        <a href="{{ route('notes.show', $note) }}" class="text-gray-600 hover:text-gray-900">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
