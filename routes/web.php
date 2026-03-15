<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PokemonController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('pages.dashboard'))->middleware(['verified'])->name('dashboard');


    Route::prefix('pokemons')->name('pokemons.')->group(function () {
        Route::get('/',              [PokemonController::class, 'index'])->name('index');
        Route::post('/import',       [PokemonController::class, 'store'])->name('store');
        Route::post('/sync-all',     [PokemonController::class, 'syncAll'])->name('sync-all');
        Route::get('/sync-progress', [PokemonController::class, 'syncProgress'])->name('sync-progress');
        Route::get('/{pokemon}',     [PokemonController::class, 'show'])->name('show');
        Route::delete('/{pokemon}',  [PokemonController::class, 'destroy'])->name('destroy');
        
        Route::post('/{pokemon}/favorite', [PokemonController::class, 'toggleFavorite'])->name('favorite');
    });

    Route::get('/types',     fn () => view('pages.types'))->middleware(['verified'])->name('types');
    Route::get('/abilities', fn () => view('pages.abilities'))->middleware(['verified'])->name('abilities');
    Route::get('/moves',     fn () => view('pages.moves'))->middleware(['verified'])->name('moves');

    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
