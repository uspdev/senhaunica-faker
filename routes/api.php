<?php

use App\Http\Controllers\AccessTokenController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\RequestTokenController;
use App\Http\Controllers\UsuarioUSPController;
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

Route::post('/wsusuario/oauth/access_token', [AccessTokenController::class, 'createToken']);
Route::post('/wsusuario/oauth/request_token', [RequestTokenController::class, 'createToken']);
Route::post('/wsusuario/oauth/usuariousp', [UsuarioUSPController::class, 'createUser']);
