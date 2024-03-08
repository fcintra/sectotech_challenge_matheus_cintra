<?php

use Illuminate\Support\Facades\Route;

// routes/web.php

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ContentController;

// Rotas para Playlists
Route::get('/playlists', [PlaylistController::class, 'index']);
Route::get('/playlists/{id}', [PlaylistController::class, 'show']);
Route::post('/playlists', [PlaylistController::class, 'store'])->withoutMiddleware(['web', 'csrf']);


Route::put('/playlists/{id}', [PlaylistController::class, 'update']);
Route::delete('/playlists/{id}', [PlaylistController::class, 'destroy']);

// Rotas para Conteúdos
Route::get('/contents/{id}', [ContentController::class, 'show']);
Route::post('/contents', [ContentController::class, 'store']);
Route::put('/contents/{id}', [ContentController::class, 'update']);
Route::delete('/contents/{id}', [ContentController::class, 'destroy']);
