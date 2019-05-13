<?php

namespace App\Http\Controllers\DataSales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImportController extends Controller
{
   	public function import_excel()
   	{
   		return view('monitoring_kinerja.import_excel.import_excel');
   	}
}
