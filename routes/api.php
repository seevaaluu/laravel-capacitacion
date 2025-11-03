<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
use App\Models\User;

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
 Route::middleware(['auth:sanctum'])->get('user', function (Request $request) {
        $user = \Auth::user();
        return $user;
    });


// Rutas de autenticacion
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/authenticated-user', [AuthController::class, 'authenticated_user'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function() {
    // Ruta de usuarios
    Route::get('/users', [UsersController::class, 'index']);
});
