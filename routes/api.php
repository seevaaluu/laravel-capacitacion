<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;

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

// Rutas de autenticacion
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/authenticated-user', [AuthController::class, 'authenticated_user'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function() {
    // Ruta de usuarios
    Route::get('users', [UsersController::class, 'index'])->middleware('can:users.index');
    Route::get('/inventarios', [InventoryController::class, 'inventarios']);
});
