<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PostController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['admin'])->group(function() {
    Route::post('/product', [PostController::class, 'create']);
    Route::patch('/product/{id}', [PostController::class, 'update']);
    Route::delete('/product/{id}', [PostController::class, 'delete']);
});

// Route::group(['middleware' => 'admin'], function(){
//     Route::post('/product', [PostController::class, 'create']);
//     Route::patch('/product/{id}', [PostController::class, 'update']);
//     Route::delete('/product/{id}', [PostController::class, 'delete']);
// });



Route::group(['middleware' => 'user'], function(){
    Route::post('/logout', [LogoutController::class, 'logout']);
});

Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/register', [RegisterController::class, 'create']);
Route::get('/catalog', [PostController::class, 'show']);

