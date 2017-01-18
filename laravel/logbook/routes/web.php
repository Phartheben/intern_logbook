<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {  
    return view('welcome');
});

Route::get('send-email', function () {
	// Mail::send('emails.test', ['name'=>'Shrmila'], function($message)
	// {
		// $message->to('shrmila1811@gmail.com', 'Pharz')->from('otheremail@unknown.com')->subject('Welcome to Laravel');

	// });

		Mail::to('phartheben@gmail.com')->send(new \App\Mail\Reminder());

});

Auth::routes();