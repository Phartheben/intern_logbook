<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \PDF;
use \App\Models\Activity;
use Illuminate\Support\Facades\App;


class PdfController extends Controller
{
public function getPDF() {

	$activities = Activity::all();
	$pdf=\PDF::loadView('pdf.activity',['activities' => $activities]);
	return $pdf->download('activity.pdf');

		//$pdf = \App::make('dompdf.wrapper');
		//$pdf->loadHTML('<h1>Hi there, I am here for testing.</h1>');
	//return $pdf->stream();

	}
}