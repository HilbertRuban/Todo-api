<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/users/signup',[UserController::class,'signUp']);
Route::post('/users/signin',[UserController::class,'signin']);

Route::get('/task/all',[TaskController::class,'index']);
Route::post('/task/new',[TaskController::class,'store']);
Route::get('task/{userId}',[TaskController::class,'show']);

Route::DELETE('/task/delete',[TaskController::class,'delete']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
