<?php

use App\Http\Controllers\Api\TodoApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware([\Illuminate\Http\Middleware\HandleCors::class])->group(function() {
    // Todo Api Endpoints
    Route::prefix('todo')->group(function() {
        Route::get('', [TodoApiController::class, 'getTodos']);
        Route::post('', [TodoApiController::class, 'store']);
        Route::put('{id}', [TodoApiController::class, 'update']);
        Route::delete('{id}', [TodoApiController::class, 'deleteTodo']);
    });
    // End Todo Api Endpoints
});
