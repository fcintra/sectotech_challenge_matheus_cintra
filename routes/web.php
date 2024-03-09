<?php

use Illuminate\Support\Facades\Route;

// routes/web.php

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ContentController;

use App\Http\Controllers\HomeController;


// Rotas para Playlists
Route::get('/playlists', [PlaylistController::class, 'index'])->withoutMiddleware(['web', 'csrf']);
Route::get('/playlists/{id}', [PlaylistController::class, 'show'])->withoutMiddleware(['web', 'csrf']);
Route::post('/playlists', [PlaylistController::class, 'store'])->withoutMiddleware(['web', 'csrf'])->name('playlists.store');
Route::put('/playlists/{id}', [PlaylistController::class, 'update'])->withoutMiddleware(['web', 'csrf']);
Route::delete('/playlists/{id}', [PlaylistController::class, 'destroy'])->withoutMiddleware(['web', 'csrf'])->name('playlists.delete');

// Rotas para Conteúdos
Route::get('/contents', [ContentController::class, 'index'])->withoutMiddleware(['web', 'csrf']);
Route::get('/contents/{id}', [ContentController::class, 'show'])->withoutMiddleware(['web', 'csrf']);
Route::post('/contents', [ContentController::class, 'store'])->withoutMiddleware(['web', 'csrf'])->name('contents.store');
Route::put('/contents/{id}', [ContentController::class, 'update'])->withoutMiddleware(['web', 'csrf']);
Route::delete('/contents/{id}', [ContentController::class, 'destroy'])->withoutMiddleware(['web', 'csrf']);


Route::get('/', [HomeController::class, 'index'])->name('welcome');;

