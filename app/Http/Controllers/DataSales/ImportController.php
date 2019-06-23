<?php

namespace App\Http\Controllers\DataSales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\d_customer;
use DataTables;
use Carbon\Carbon;
use Excel;

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
            for ($i=0; $i < $request->datacount ; $i++) { 
               $i += 1;
      		$arr = array(
      			'c_serial' => $request->result['Sheet1'][$i][0],  
      			'c_plate' => $request->result['Sheet1'][$i][1],
      			'c_typecar' => $request->result['Sheet1'][$i][2],
      			'c_jobdesc' => $request->result['Sheet1'][$i][3],
      			'c_dateservice' => $request->result['Sheet1'][$i][4],
      			'c_serviceadvisor' => $request->result['Sheet1'][$i][5],
      			'c_code' => $request->result['Sheet1'][$i][0],
      			'status_data' => 'true',

      		    );

   		 array_push($alldata, $arr);
            }

   		d_customer::insert($alldata);

     //     DB::table('')

   	}
}
