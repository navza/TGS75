<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\CommentController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::get('news', [NewsController::class, 'index']);
Route::get('news/{id}', [NewsController::class, 'show']);

Route::middleware('auth:api')->group(function () {
    Route::post('news', [NewsController::class, 'store']);
    Route::post('news/{id}/comments', [CommentController::class, 'store']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
