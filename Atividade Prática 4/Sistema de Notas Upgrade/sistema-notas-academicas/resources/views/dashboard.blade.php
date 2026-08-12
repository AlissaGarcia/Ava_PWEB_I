@extends('layouts.app')

@section('title', 'Dashboard - Sistema de Notas Acadêmicas')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </div>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold">Olá, {{ auth()->user()->name }}!</h1>
                    <p class="mt-2 text-gray-600">
                        Bem-vindo ao sistema seguro de notas acadêmicas.
                    </p>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Card de Estatísticas -->
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-lg p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-600 text-sm font-semibold">Total de Notas</p>
                                    <p class="text-3xl font-bold text-blue-900 mt-2">{{ auth()->user()->notes()->count() }}</p>
                                </div>
                                <svg class="w-12 h-12 text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 012-2h6a2 2 0 012 2v12a1 1 0 110 2h-2.343a2 2 0 01-1.914-1.114l-.859-1.538a1 1 0 00-.88-.486h-3.172a1 1 0 00-.98 1.186l.824 4.119A2 2 0 008.22 20H16a2 2 0 002-2V4a2 2 0 00-2-2h-2.343a2 2 0 00-1.914 1.114L10.929 5.5H6a2 2 0 00-2 2v6a1 1 0 110 2H4V4z"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Card de Ação Rápida -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-lg p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-green-600 text-sm font-semibold">Última Nota</p>
                                    <p class="text-sm text-green-900 mt-2">
                                        @if(auth()->user()->notes()->latest()->first())
                                            {{ auth()->user()->notes()->latest()->first()->created_at->diffForHumans() }}
                                        @else
                                            Nenhuma nota
                                        @endif
                                    </p>
                                </div>
                                <svg class="w-12 h-12 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 17v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Card de Aviso -->
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-lg p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-purple-600 text-sm font-semibold">Segurança</p>
                                    <p class="text-sm text-purple-900 mt-2">Notas criptografadas com segurança máxima</p>
                                </div>
                                <svg class="w-12 h-12 text-purple-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('notes.index') }}"
                           class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                            → Acessar minhas notas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
