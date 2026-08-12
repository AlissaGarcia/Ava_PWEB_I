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
    
    // Rota de perfil (stub - pode ser expandida posteriormente)
    Route::get('/profile/edit', function () {
        return view('profile.edit');
    })->name('profile.edit');
});

require __DIR__.'/auth.php';
