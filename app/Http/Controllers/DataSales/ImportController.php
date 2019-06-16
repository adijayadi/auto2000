<?php

namespace App\Http\Controllers\DataSales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\d_customer;
use DataTables;
use Carbon\Carbon;

class ImportController extends Controller
{
   	public function import_excel()
   	{
   		$urutan = d_customer::all()->count() +1;
   		$code = 'S'.$urutan.Carbon::now()->format('ds');
   		return view('monitoring_kinerja.import_excel.import_excel',array(
   			'code' => $code,
   		));
   	}

   	public function storedata(Request $request){
   		$count = $request->data;
   		$alldata = [];

   		$arr = array(
   			'c_serial' => $request->serial,  
   			'c_plate' => $request->plate,
   			'c_typecar' => $request->typecar,
   			'c_jobdesc' => $request->jobdesc,
   			'c_dateservice' => $request->dateservice,
   			'c_serviceadvisor' => $request->serviceadvisor,
   			'c_code' => $request->code,
   			'status_data' => 'true',

   		);

   		array_push($alldata, $arr);

   		d_customer::insert($alldata);

   	}
}
