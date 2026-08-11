<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class NoteController extends Controller
{
    public function index()
    {
        $notes = auth()->user()->notes()->latest()->get();

        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'conteudo' => ['required', 'string'],
        ]);

        auth()->user()->notes()->create([
            'titulo' => $validated['titulo'],
            'conteudo' => Crypt::encryptString($validated['conteudo']),
        ]);

        return redirect()
            ->route('notes.index')
            ->with('success', 'Nota criada com sucesso!');
    }

    public function show(Note $note)
    {
        $this->authorize('view', $note);

        $note->conteudo = Crypt::decryptString($note->conteudo);

        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        $this->authorize('update', $note);

        $note->conteudo = Crypt::decryptString($note->conteudo);

        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $this->authorize('update', $note);

        $validated = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'conteudo' => ['required', 'string'],
        ]);

        $note->update([
            'titulo' => $validated['titulo'],
            'conteudo' => Crypt::encryptString($validated['conteudo']),
        ]);

        return redirect()
            ->route('notes.show', $note)
            ->with('success', 'Nota atualizada com sucesso!');
    }

    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);

        $note->delete();

        return redirect()
            ->route('notes.index')
            ->with('success', 'Nota excluída com sucesso!');
    }
}
