<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BlogController;

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

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/blog', [BlogController::class, 'index']);
    Route::post('/blog/create', [BlogController::class, 'store']);
    Route::post('/blog/update/{blog}', [BlogController::class, 'update']);
    Route::delete('/blog/delete/{blog}', [BlogController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
