<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PersonalInfoController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/users/{id}/edit', [ 
    UsersController::class, 'edit'
])->name('users.edit');

Route::get('/users', [ 
    UsersController::class, 'index'
])->name('users.index');

Route::post('/users', [ 
    UsersController::class, 'store'
])->name('users.store');

Route::get('/users/create', [ 
    UsersController::class, 'create'
])->name('users.create');


Route::put('/users/{id}/update', [ 
    UsersController::class, 'update'
])->name('users.update');

Route::delete('/users/{id}/delete', [ 
    UsersController::class, 'destroy'
])->name('users.destroy');

Route::resource('/personal_info', PersonalInfoController::class);

// Rutas para videoos
Route::resource('/videos', VideosController::class);

// Rutas para posts
Route::resource('/posts', PostsController::class);

// Rutas para comentarios
Route::resource('/comments', CommentsController::class);