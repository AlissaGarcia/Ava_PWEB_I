<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold">Olá, {{ auth()->user()->name }}!</h1>
                    <p class="mt-2 text-gray-600">
                        Bem-vindo ao sistema seguro de notas acadêmicas.
                    </p>

                    <a href="{{ route('notes.index') }}"
                       class="inline-block mt-6 bg-indigo-600 text-white px-5 py-2 rounded-md hover:bg-indigo-700">
                        Acessar minhas notas
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
