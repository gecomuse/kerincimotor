<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/articles', [ArticleController::class, 'store']);
Route::patch('/articles/{id}', [ArticleController::class, 'update']);
Route::post('/upload-image', [ArticleController::class, 'uploadImage']);