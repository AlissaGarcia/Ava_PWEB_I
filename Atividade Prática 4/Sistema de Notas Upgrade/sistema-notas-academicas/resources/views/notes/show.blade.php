@extends('layouts.app')

@section('title', $note->titulo . ' - Sistema de Notas Acadêmicas')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Visualizar Nota</h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-8">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $note->titulo }}</h1>
                    
                    <div class="mt-4 flex flex-wrap gap-4 text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a2 2 0 012 2v2H4V9a2 2 0 012-2h8zm8 8H4v2a2 2 0 002 2h8a2 2 0 002-2v-2z" clip-rule="evenodd"></path>
                            </svg>
                            Criada em: <strong class="ml-1">{{ $note->created_at->format('d/m/Y') }} às {{ $note->created_at->format('H:i:s') }}</strong>
                        </div>
                        
                        @if ($note->updated_at->gt($note->created_at))
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 1119.414 5.414 1 1 0 11-1.414-1.414A5.002 5.002 0 104.659 4.168V3a1 1 0 01-1-1zm12 12a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                                </svg>
                                Atualizada em: <strong class="ml-1">{{ $note->updated_at->format('d/m/Y') }} às {{ $note->updated_at->format('H:i:s') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 mb-8">
                    <div class="whitespace-pre-wrap text-gray-700 font-mono text-sm">{{ $note->conteudo }}</div>
                </div>

                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('notes.edit', $note) }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                        </svg>
                        Editar
                    </a>
                    <a href="{{ route('notes.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 px-4 py-2 font-medium">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                        </svg>
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
