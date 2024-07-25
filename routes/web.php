<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\ticketsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('clients', [ClientsController::class, 'tampil']);
 Route::post('clients', [ClientsController::class, 'new']);
Route::get('users', [UsersController::class, 'index']);
 Route::post('/users', [UsersController::class, 'create']);
Route::resource('modules', ModulesController::class);
Route::resource('products', productsController::class);
Route::resource('tickets', ticketsController::class);