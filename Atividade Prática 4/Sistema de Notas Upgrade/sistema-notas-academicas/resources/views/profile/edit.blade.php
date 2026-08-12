@extends('layouts.app')

@section('title', 'Meu Perfil - Sistema de Notas Acadêmicas')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Meu Perfil</h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-card title="Informações do Perfil">
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600">Nome</p>
                        <p class="text-lg font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="text-lg font-semibold text-gray-900">{{ auth()->user()->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Membro desde</p>
                        <p class="text-lg font-semibold text-gray-900">{{ auth()->user()->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
                
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <p class="text-sm text-gray-600 mb-4">Edição de perfil virá em breve</p>
                    <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-800">← Voltar ao Dashboard</a>
                </div>
            </x-card>
        </div>
    </div>
@endsection
