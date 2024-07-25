<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\productsController;
use  App\Http\Controllers\loginController;
use  App\Http\Controllers\registerController;

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

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});
Route::post('/register', [registerController::class, 'create']);
Route::post('/login', [loginController::class, 'create']);
Route::get('/users', [UsersController::class, 'index']);
Route::post('/users', [UsersController::class, 'create']);
Route::get('/clients', [ClientsController::class, 'tampil']);
Route::post('/clients', [ClientsController::class, 'new']);
Route::get('/tickets', [TicketsController::class, 'index']);
Route::get('/tickets/{id}', [TicketsController::class, 'show']);
Route::post('/tickets', [TicketsController::class, 'create']);
Route::patch('/tickets/{id}', [TicketsController::class, 'update']);
Route::get('/modules', [ModulesController::class, 'index']);
Route::post('/modules', [ModulesController::class, 'create']);
Route::get('/products', [productsController::class, 'index']);
Route::post('/products', [productsController::class, 'create']);
//Route::post('/login', [loginController::class, 'create']);
//Route::post('/register', [registerController::class, 'create']);