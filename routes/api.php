<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;

Route::prefix('artists')->group(function () {
    Route::get('find', [ArtistController::class, 'search'])->name('artists.find');
    Route::get('/:artist', [ArtistController::class, 'get'])->name('artists.get');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
