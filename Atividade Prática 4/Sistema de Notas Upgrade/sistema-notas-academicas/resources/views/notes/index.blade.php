@extends('layouts.app')

@section('title', 'Minhas Notas - Sistema de Notas Acadêmicas')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Minhas Notas</h2>
        <a href="{{ route('notes.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
            + Nova Nota
        </a>
    </div>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($notes->isEmpty())
                <div class="bg-white shadow-sm sm:rounded-lg p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Nenhuma nota ainda</h3>
                    <p class="mt-2 text-gray-600">Você ainda não possui nenhuma nota criada.</p>
                    <a href="{{ route('notes.create') }}" class="inline-block mt-6 bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                        Criar minha primeira nota
                    </a>
                </div>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($notes as $note)
                        <div class="bg-white shadow-sm hover:shadow-md sm:rounded-lg p-6 transition">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $note->titulo }}</h3>
                                    <p class="mt-2 text-xs text-gray-500">
                                        Criada em {{ $note->created_at->format('d/m/Y') }} às {{ $note->created_at->format('H:i') }}
                                    </p>
                                </div>
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs font-semibold rounded-full">Privada</span>
                            </div>
                            <p class="mt-4 text-gray-600 text-sm line-clamp-3">{{ substr($note->conteudo, 0, 100) }}...</p>

                            <div class="flex gap-3 mt-6 pt-6 border-t border-gray-200">
                                <a href="{{ route('notes.show', $note) }}" class="flex-1 text-center text-indigo-600 hover:text-indigo-800 hover:bg-indigo-50 px-3 py-2 rounded text-sm font-medium transition">
                                    Visualizar
                                </a>
                                <a href="{{ route('notes.edit', $note) }}" class="flex-1 text-center text-blue-600 hover:text-blue-800 hover:bg-blue-50 px-3 py-2 rounded text-sm font-medium transition">
                                    Editar
                                </a>
                                <form action="{{ route('notes.destroy', $note) }}" method="POST" class="flex-1"
                                      onsubmit="return confirm('Deseja realmente excluir esta nota?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full text-red-600 hover:text-red-800 hover:bg-red-50 px-3 py-2 rounded text-sm font-medium transition">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
