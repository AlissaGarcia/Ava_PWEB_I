@extends('layouts.app')

@section('title', 'Lixeira - Sistema de Notas Acadêmicas')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">🗑️ Lixeira</h2>
        <a href="{{ route('notes.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
            ← Voltar para Notas
        </a>
    </div>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($notes->isEmpty())
                <div class="bg-white shadow-sm sm:rounded-lg p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m0-6l7-7 7 7"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Sua lixeira está vazia</h3>
                    <p class="text-gray-600 mb-6">Nenhuma nota foi deletada ainda.</p>
                    <a href="{{ route('notes.index') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                        Ir para Minhas Notas
                    </a>
                </div>
            @else
                <!-- Informações da Lixeira -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
                    <div class="flex items-start gap-4">
                        <svg class="h-6 w-6 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="text-sm font-semibold text-yellow-800">{{ $notes->count() }} nota(s) na lixeira</h3>
                            <p class="text-sm text-yellow-700 mt-1">
                                As notas deletadas podem ser restauradas ou deletadas permanentemente. Elas serão automaticamente removidas em 30 dias.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Ações em Massa -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-8">
                    <div class="flex flex-wrap gap-3">
                        <form action="{{ route('notes.restoreAll') }}" method="POST" class="inline" onsubmit="return confirm('Restaurar todas as notas?')">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition font-semibold">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 1119.414 5.414 1 1 0 11-1.414-1.414A5.002 5.002 0 104.659 4.168V3a1 1 0 01-1-1zm12 12a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                                </svg>
                                Restaurar Tudo
                            </button>
                        </form>

                        <form action="{{ route('notes.emptyTrash') }}" method="DELETE" class="inline" onsubmit="return confirm('Deseja realmente esvaziar a lixeira? Esta ação é irreversível!')">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition font-semibold">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                Esvaziar Lixeira
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Notas Deletadas -->
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($notes as $note)
                        <x-trash-note-card :note="$note" />
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
