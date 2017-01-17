<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::resource('user', '\App\Http\Controllers\Api\UserController');
Route::resource('role', '\App\Http\Controllers\Api\RoleController');
Route::resource('activity', '\App\Http\Controllers\Api\ActivityController');
Route::resource('comment', '\App\Http\Controllers\Api\CommentController');

