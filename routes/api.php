<?php

use App\Contracts\Response;
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

Route::get('ping', function(){
    return Response::json([
        'message' => 'PONG'
    ]);
});

Route::post('auth', \App\Http\Controllers\Api\Auth\AuthenticationController::class);

Route::group(['middleware' => 'jwt'], function () {
    Route::get('me', \App\Http\Controllers\Api\Me\MeController::class);
});