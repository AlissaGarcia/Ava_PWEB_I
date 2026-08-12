{{-- Componente de Card de Nota --}}
{{-- Uso: <x-note-card :note="$note" /> --}}

@props(['note'])

<div class="bg-white shadow-sm hover:shadow-md sm:rounded-lg p-6 transition">
    <div class="flex justify-between items-start mb-4">
        <div class="flex-1 pr-4">
            <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $note->titulo }}</h3>
            <p class="mt-1 text-xs text-gray-500">
                <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a2 2 0 012 2v2H4V9a2 2 0 012-2h8zm8 8H4v2a2 2 0 002 2h8a2 2 0 002-2v-2z" clip-rule="evenodd"></path>
                </svg>
                {{ $note->created_at->format('d/m/Y') }} às {{ $note->created_at->format('H:i') }}
            </p>
        </div>
        <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs font-semibold rounded-full whitespace-nowrap">Privada</span>
    </div>

    <p class="text-gray-600 text-sm line-clamp-3 mb-6">{{ substr($note->conteudo, 0, 150) }}{{ strlen($note->conteudo) > 150 ? '...' : '' }}</p>

    <div class="flex gap-3 pt-6 border-t border-gray-200">
        <a href="{{ route('notes.show', $note) }}" class="flex-1 text-center text-indigo-600 hover:text-indigo-800 hover:bg-indigo-50 px-3 py-2 rounded text-sm font-medium transition">
            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
            </svg>
            Visualizar
        </a>
        <a href="{{ route('notes.edit', $note) }}" class="flex-1 text-center text-blue-600 hover:text-blue-800 hover:bg-blue-50 px-3 py-2 rounded text-sm font-medium transition">
            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
            </svg>
            Editar
        </a>
        <form action="{{ route('notes.destroy', $note) }}" method="POST" class="flex-1"
              onsubmit="return confirm('Deseja realmente excluir esta nota?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full text-red-600 hover:text-red-800 hover:bg-red-50 px-3 py-2 rounded text-sm font-medium transition flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                Excluir
            </button>
        </form>
    </div>
</div>
