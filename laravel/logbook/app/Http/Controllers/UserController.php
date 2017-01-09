<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
	{
		$user = [
			'0' => [
				'first_name' => 'Shrmila',
				'last_name' => 'Ravindran',
				'location' => 'shrmila1811@gmail.com',
				'password' => 'shrm123'

			],
			'1' => [
				'first_name' => 'Phartheben',
				'last_name' => 'Selvam',
				'location' => 'phartheben@gmail.com',
				'password' => 'Pharz123'
			]
		];

		return response()->json($user);
	}
}
