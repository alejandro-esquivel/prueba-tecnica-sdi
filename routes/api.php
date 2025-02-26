<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AuthController;

Route::prefix('artists')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('find', [ArtistController::class, 'search'])->name('artists.find');
        Route::get('/{id}', [ArtistController::class, 'get'])->name('artists.get');
        Route::get('/{id}/albums', [ArtistController::class, 'getAlbums'])->name('artists.getAlbums');
    });

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('getToken', [AuthController::class, 'getToken'])->name('auth.login');
    Route::post('revokeTokens', [AuthController::class, 'revokeTokens'])->name('auth.logout')->middleware('auth:sanctum');
});
