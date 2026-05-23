<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\ArtikelController;

Route::middleware('api.key')->group(function () {
    Route::post('/units', [UnitController::class, 'store']);
    Route::post('/artikel', [ArtikelController::class, 'store']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/articles', [ArticleController::class, 'store']);
Route::patch('/articles/{id}', [ArticleController::class, 'update']);
Route::post('/upload-image', [ArticleController::class, 'uploadImage']);