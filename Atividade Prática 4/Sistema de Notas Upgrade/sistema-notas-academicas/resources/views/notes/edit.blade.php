@extends('layouts.app')

@section('title', 'Editar Nota - Sistema de Notas Acadêmicas')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Nota</h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">{{ $note->titulo }}</h3>
                <form action="{{ route('notes.update', $note) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="titulo" class="block font-semibold text-sm text-gray-700 mb-2">Título</label>
                        <input type="text" name="titulo" id="titulo"
                               value="{{ old('titulo', $note->titulo) }}" required
                               placeholder="Digite o título da nota"
                               class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @error('titulo')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="conteudo" class="block font-semibold text-sm text-gray-700 mb-2">Conteúdo</label>
                        <textarea name="conteudo" id="conteudo" rows="12" required
                                  class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('conteudo', $note->conteudo) }}</textarea>
                        @error('conteudo')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                            O conteúdo será novamente criptografado ao salvar
                        </p>
                    </div>

                    <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-semibold">
                            Atualizar Nota
                        </button>
                        <a href="{{ route('notes.show', $note) }}" class="text-gray-600 hover:text-gray-900 font-medium">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
