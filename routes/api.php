<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//auth
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);

//tasks
Route::get('/tasks', [TaskController::class, 'index'])->middleware('auth:sanctum');
Route::get('/tasks/confidential', [TaskController::class, 'confidentialTasks'])->middleware(['auth:sanctum', 'abilities:check-confidential']);
Route::get('/tasks/{id}', [TaskController::class, 'show'])->middleware('auth:sanctum');
Route::post('/tasks', [TaskController::class, 'store'])->middleware('auth:sanctum');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/tasks/{id}', [TaskController::class, 'delete'])->middleware('auth:sanctum');
