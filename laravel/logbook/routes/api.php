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

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::group(['middleware' => 'auth:api'], function () {
	Route::resource('user', '\App\Http\Controllers\Api\UserController');
	Route::resource('role', '\App\Http\Controllers\Api\RoleController');
	Route::resource('activity', '\App\Http\Controllers\Api\ActivityController');
	Route::resource('comment', '\App\Http\Controllers\Api\CommentController');
});


Route::group(['middleware' => 'cors'], function () {
	// Route::resource('account', '\App\Http\Controllers\Api\AccountController');
	Route::post('account/sign-up', '\App\Http\Controllers\Api\AccountController@signUp');
	Route::resource('pdf', '\App\Http\Controllers\Api\PdfController');
});

Route::post('hello', function () {
	return response()->json('hello');
})
->middleware(['cors'])
;
	


