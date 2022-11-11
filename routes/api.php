<?php

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

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'createUser']);

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'loginUser']);


Route::group(['middleware' => 'auth:sanctum'], function()
{

    Route::post('/createpost', [\App\Http\Controllers\PostsController::class, 'store']);

    Route::post('/updatepost/{id}', [\App\Http\Controllers\PostsController::class, 'update']);

    Route::post('/comment', [\App\Http\Controllers\CommentsController::class, 'store']);





    Route::get('/user',function (Request $request) {    
    return $request->user();    
});


});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
