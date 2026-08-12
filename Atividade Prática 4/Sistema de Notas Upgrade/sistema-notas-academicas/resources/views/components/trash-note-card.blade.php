{{-- Componente de Nota com Badge de Lixeira --}}
{{-- Uso: <x-trash-note-card :note="$note" /> --}}

@props(['note'])

<div class="bg-white shadow-sm hover:shadow-md sm:rounded-lg p-6 transition border-l-4 border-yellow-500">
    <div class="flex justify-between items-start mb-4">
        <div class="flex-1 pr-4">
            <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $note->titulo }}</h3>
            <p class="mt-1 text-xs text-gray-500">
                <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a2 2 0 012 2v2H4V9a2 2 0 012-2h8zm8 8H4v2a2 2 0 002 2h8a2 2 0 002-2v-2z" clip-rule="evenodd"></path>
                </svg>
                Criada em {{ $note->created_at->format('d/m/Y') }}
            </p>
        </div>
        <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full whitespace-nowrap">Deletada</span>
    </div>

    <div class="bg-red-50 rounded p-3 mb-4 border border-red-200">
        <p class="text-sm text-red-800">
            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"></path>
            </svg>
            <strong>Deletada em:</strong> {{ $note->deleted_at->format('d/m/Y \à\s H:i:s') }}
        </p>
    </div>

    <p class="text-gray-600 text-sm line-clamp-2 mb-6">{{ substr($note->conteudo, 0, 100) }}{{ strlen($note->conteudo) > 100 ? '...' : '' }}</p>

    <div class="flex gap-2">
        <form action="{{ route('notes.restore', $note) }}" method="POST" class="flex-1" onsubmit="return confirm('Restaurar esta nota?')">
            @csrf
            <button type="submit" class="w-full text-center text-green-600 hover:text-green-800 hover:bg-green-50 px-3 py-2 rounded text-sm font-medium transition flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 1119.414 5.414 1 1 0 11-1.414-1.414A5.002 5.002 0 104.659 4.168V3a1 1 0 01-1-1zm12 12a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                </svg>
                Restaurar
            </button>
        </form>

        <form action="{{ route('notes.forceDelete', $note) }}" method="DELETE" class="flex-1" onsubmit="return confirm('Deseja realmente deletar permanentemente? Esta ação é irreversível!')">
            @csrf
            <button type="submit" class="w-full text-center text-red-600 hover:text-red-800 hover:bg-red-50 px-3 py-2 rounded text-sm font-medium transition flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                Deletar
            </button>
        </form>
    </div>
</div>
