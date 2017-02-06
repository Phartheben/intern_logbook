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
if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }

Route::group(['middleware' => 'auth:api'], function () {
	Route::resource('user', '\App\Http\Controllers\Api\UserController');
	Route::resource('role', '\App\Http\Controllers\Api\RoleController');
	Route::resource('activity', '\App\Http\Controllers\Api\ActivityController');
	Route::resource('comment', '\App\Http\Controllers\Api\CommentController');
	Route::resource('company', '\App\Http\Controllers\Api\CompanyController');
	Route::resource('institution', '\App\Http\Controllers\Api\InstitutionController');
	Route::resource('user-company', '\App\Http\Controllers\Api\UserCompanyController');
	//Route::get('user', '\App\Http\Controllers\Api\UserController');
});


Route::group(['middleware' => 'cors'], function () {
	// Route::resource('account', '\App\Http\Controllers\Api\AccountController');
	Route::post('account/sign-up', '\App\Http\Controllers\Api\AccountController@signUp');
	// Route::get('account/login', '\App\Http\Controllers\Api\AccountController@login');
	Route::resource('pdf', '\App\Http\Controllers\Api\PdfController');
	});

Route::post('hello', function () {
	return response()->json('hello');
})
->middleware(['cors'])
;
	



