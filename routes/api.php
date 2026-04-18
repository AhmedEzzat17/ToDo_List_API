<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/todos', TodoController::class.'@List_Todos');
    Route::post('/todos', TodoController::class.'@Create_Todo');
    Route::get('/todos/{id}', TodoController::class.'@View_Todo');
    Route::put('/todos/{id}', TodoController::class.'@Update_Todo');
    Route::delete('/todos/{id}', TodoController::class.'@Delete_Todo');
});

    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
