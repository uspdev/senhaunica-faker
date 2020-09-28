<?php

use App\Http\Controllers\AccessTokenController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\RequestTokenController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/wsusuario/oauth/access_token', [AccessTokenController::class, 'createToken']);
Route::post('/wsusuario/oauth/authorize', [AuthorizationController::class, 'authorise']);
Route::post('/wsusuario/oauth/request_token', [RequestTokenController::class, 'createToken']);
