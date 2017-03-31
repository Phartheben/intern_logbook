<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Models\Activity;
use Illuminate\Support\Facades\App;
use \Excel;


class ExcelController extends Controller
{
    public function getExport()
    {
        return view('export');
    }

    public function downloadExcel(Request $request)
    {
        $data = Activity::get()->toArray();
        return \Excel::create('VetterSoftware', function($excel) use ($data) {
            $excel->sheet('VetterSheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('xls');
    }
}