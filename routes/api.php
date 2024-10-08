<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; 
use App\Http\Controllers\AuthController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/posts', [PostController::class, 'index']);  
Route::get('/posts/{id}', [PostController::class, 'show']);    
Route::post('/posts', [PostController::class, 'store']);      
Route::put('/posts/{id}', [PostController::class, 'update']);  
Route::delete('/posts/{id}', [PostController::class, 'destroy']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

