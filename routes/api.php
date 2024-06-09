<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('comments')->group(function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::post('/', [CommentController::class, 'store']);
    Route::post('/{comment}', [CommentController::class, 'update']);
    Route::delete('/{comment}', [CommentController::class, 'delete']);
});
