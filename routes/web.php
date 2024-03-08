<?php

use Illuminate\Support\Facades\Route;

// routes/web.php

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ContentController;

use App\Http\Controllers\HomeController;


// Rotas para Playlists
Route::get('/playlists', [PlaylistController::class, 'index']);
Route::get('/playlists/{id}', [PlaylistController::class, 'show']);
Route::post('/playlists', [PlaylistController::class, 'store'])->withoutMiddleware(['web', 'csrf'])->name('playlists.store');


Route::put('/playlists/{id}', [PlaylistController::class, 'update']);
Route::delete('/playlists/{id}', [PlaylistController::class, 'destroy'])->withoutMiddleware(['web', 'csrf'])->name('playlists.delete');

// Rotas para Conteúdos
Route::get('/contents/{id}', [ContentController::class, 'show']);
Route::post('/contents', [ContentController::class, 'store'])->withoutMiddleware(['web', 'csrf']);
Route::put('/contents/{id}', [ContentController::class, 'update']);
Route::delete('/contents/{id}', [ContentController::class, 'destroy'])->withoutMiddleware(['web', 'csrf']);


Route::get('/', [HomeController::class, 'index'])->name('welcome');;

