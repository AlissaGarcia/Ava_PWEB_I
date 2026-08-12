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
            <!-- Alerta de Notas na Lixeira -->
            @php
                $trashedCount = auth()->user()->notes()->onlyTrashed()->count();
            @endphp
            
            @if($trashedCount > 0)
                <div class="mb-8 bg-yellow-50 border border-yellow-200 rounded-lg p-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="h-6 w-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-yellow-800">{{ $trashedCount }} nota(s) na lixeira</p>
                            <p class="text-sm text-yellow-700">Você tem notas deletadas que podem ser restauradas.</p>
                        </div>
                    </div>
                    <a href="{{ route('notes.trash') }}" class="ml-4 px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded font-semibold transition">
                        Abrir Lixeira
                    </a>
                </div>
            @endif

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
                        <x-note-card :note="$note" />
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
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
