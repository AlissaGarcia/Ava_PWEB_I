<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('notes', NoteController::class);
    
    // Rotas de lixeira (Soft Delete)
    Route::prefix('notes/trash')->name('notes.')->group(function () {
        Route::get('/', [NoteController::class, 'trash'])->name('trash');
        Route::post('{id}/restore', [NoteController::class, 'restore'])->name('restore');
        Route::delete('{id}/force-delete', [NoteController::class, 'forceDelete'])->name('forceDelete');
        Route::delete('empty', [NoteController::class, 'emptyTrash'])->name('emptyTrash');
        Route::post('restore-all', [NoteController::class, 'restoreAll'])->name('restoreAll');
    });
    
    // Rota de perfil (stub - pode ser expandida posteriormente)
    Route::get('/profile/edit', function () {
        return view('profile.edit');
    })->name('profile.edit');
});

require __DIR__.'/auth.php';
