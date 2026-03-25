<?php

use App\Http\Controllers\CharactersController;
use App\Http\Controllers\GamesController;
use Illuminate\Support\Facades\Route;

Route::get('/games', [GamesController::class, 'index']);
Route::get('/characters', [CharactersController::class, 'index']);

Route::fallback(function () {
    return response()->json([
        'status' => 404,
        'message' => 'Not Found'
    ], 404);
});
