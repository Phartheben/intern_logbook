<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;


class PdfController extends Controller
{
public function Index() {

		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML('<h1>Test</h1>');
	return $pdf->stream();

}}