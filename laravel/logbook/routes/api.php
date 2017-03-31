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
	if (isset($_SERVER['REQUEST_METHOD'])) {
	    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	 
	        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
	            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         
	 
	        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
	            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	 
	        exit(0);
	    }
	}

 // Route::get('/getPDF', '\App\Http\Controllers\Api\PdfController@getPDF');
 // Route::get('/excel', '\App\Http\Controllers\Api\ExcelController@downloadExcel');
 // Route::get('show', '\App\Http\Controllers\Api\ActivityController@show');


Route::group(['middleware' => ['auth:api', 'api.session']], function () {
	Route::resource('user', '\App\Http\Controllers\Api\UserController');
	Route::resource('role', '\App\Http\Controllers\Api\RoleController');
	
	// Route::get('show', '\App\Http\Controllers\Api\ActivityController@show');
	// Route::put('activity/update', '\App\Http\Controllers\Api\ActivityController@update');
	// Route::delete('activity/delete', '\App\Http\Controllers\Api\ActivityController@delete');
	Route::resource('activity', '\App\Http\Controllers\Api\ActivityController');
	
	Route::resource('comment', '\App\Http\Controllers\Api\CommentController');
	
	Route::get('company/showCom', '\App\Http\Controllers\Api\CompanyController@showCom');
	Route::resource('company', '\App\Http\Controllers\Api\CompanyController');
	
	Route::get('institution/showIns', '\App\Http\Controllers\Api\InstitutionController@showIns');
	Route::resource('institution', '\App\Http\Controllers\Api\InstitutionController');
	
	Route::resource('user-company', '\App\Http\Controllers\Api\UserCompanyController');
	// Route::get('/getPDF', '\App\Http\Controllers\Api\PdfController@getPDF');
	// Route::get('/excel', '\App\Http\Controllers\Api\ExcelController@downloadExcel');
	Route::get('profile/show', '\App\Http\Controllers\Api\ProfileController@show');
	Route::get('profile/showAvatar', '\App\Http\Controllers\Api\ProfileController@showAvatar');
	Route::post('profile/avatar', '\App\Http\Controllers\Api\ProfileController@avatar');
	Route::post('profile/update', '\App\Http\Controllers\Api\ProfileController@update');
	Route::post('profile/password', '\App\Http\Controllers\Api\ProfileController@password');
});


Route::group(['middleware' => 'cors'], function () {
	Route::get('/getPDF', '\App\Http\Controllers\Api\PdfController@getPDF');
	Route::get('/excel', '\App\Http\Controllers\Api\ExcelController@downloadExcel');
	// Route::get('show', '\App\Http\Controllers\Api\ActivityController@show');
	// Route::resource('account', '\App\Http\Controllers\Api\AccountController');
	Route::post('account/sign-up', '\App\Http\Controllers\Api\AccountController@signUp');
	// Route::get('account/login', '\App\Http\Controllers\Api\AccountController@login');
});