<?php

use App\Http\Controllers\FilmActorController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'authenticate'])->middleware('guest:sanctum');
Route::post('users', [UserController::class, 'store'])->middleware('guest:sanctum');
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::get('users/{id}', [UserController::class, 'show'])->middleware('auth:sanctum', 'valid.user');
Route::put('users/{id}', [UserController::class, 'update'])->middleware('auth:sanctum', 'valid.user');
Route::put('users/{id}/update_password', [UserController::class, 'updatePassword'])->middleware('auth:sanctum', 'valid.user');

Route::get('films', [FilmController::class, 'index']);
Route::post('films', [FilmController::class, 'store'])->middleware('auth:sanctum', 'role:admin');
Route::get('films/{id}', [FilmController::class, 'show']);
Route::get('films/{id}/actors', [FilmActorController::class, 'index']);
