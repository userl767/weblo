<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth')->get('/chatify', [MessagesController@index::class, 'index'])->name(config('chatify.routes.prefix'));
Route::middleware('auth')->get('/', 'MessagesController@index')->name(config('chatify.routes.prefix'));

Route::get('/', function () {
    // Si l'utilisateur est déjà connecté, on le redirige vers la page de chat
    return auth()->check() ? redirect()->route('chatify') : redirect()->route('login');


});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
