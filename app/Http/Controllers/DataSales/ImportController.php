<?php

namespace App\Http\Controllers\DataSales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\d_customer;
use DataTables;
use Carbon\Carbon;
use Excel;
use App\d_hcustommer;
use DB;

class ImportController extends Controller
{
   	public function import_excel()
   	{
   		$urutan = d_customer::all()->count();
   		$code = 'S'.$urutan.Carbon::now()->format('ds');
   		return view('monitoring_kinerja.import_excel.import_excel',array(
   			'code' => $code,
   		));
   	}

      public function tablerekap(){
         $data = DB::table('d_recap')->get();
         return DataTables::of($data)
         ->make(true);
      }

      public function table(){
         $data = DB::table('d_customerremovable')->get();
         return DataTables::of($data)
         ->addIndexColumn()
         ->addcolumn('rangka',function($data){
            return $data->cr_serial .'<input type="hidden" value="'.$data->cr_serial.'" class="serial" name="serial[]"><input type="hidden" value="'.$data->cr_id.'" class="serial" name="idd[]">';
         })
         ->addcolumn('plate',function($data){
            return $data->cr_plate .'<input type="hidden" value="'.$data->cr_plate.'" class="plate" name="plate[]">';
         })
         ->addcolumn('type',function($data){
            return $data->cr_typecar .'<input type="hidden" value="'.$data->cr_typecar.'" class="car" name="car[]">';
         })
         ->addcolumn('job',function($data){
            return $data->cr_jobdesc .'<input type="hidden" value="'.$data->cr_jobdesc.'" class="job" name="job[]">';
         })
         ->addcolumn('date',function($data){
            return $data->cr_dateservice .'<input type="hidden" value="'.$data->cr_dateservice.'" class="date" name="date[]">';
         })
         ->addcolumn('servicead',function($data){
            return $data->cr_serviceadvisor .'<input type="hidden" value="'.$data->cr_serviceadvisor.'" class="advisor" name="advisor[]">';
         })
         ->addcolumn('action',function($data){
            return '<button class="btn btn-danger btn-sm hapus" data-id="'.$data->cr_id.'" type="button"><i class="fa fa-trash"></i></button>';
         })
         ->rawColumns(['rangka', 'plate', 'type', 'job', 'date', 'servicead', 'action'])
         ->make(true);
      }

   	public function hstoredata(Request $request){
          $code = $request->code;
         $datetime = Carbon::parse($request->result['Sheet1'][10][4])->format('Y,m,d');
         $check = DB::table('d_customerremovable')->count();
         if ($check == 0) {
      		 $alldata = [];
               for ($i=0; $i < $request->datacount ; $i++) { 
         		$arr = array(
         			'cr_serial' => $request->result['Sheet1'][$i][0],  
         			'cr_plate' => $request->result['Sheet1'][$i][1],
         			'cr_typecar' => $request->result['Sheet1'][$i][2],
         			'cr_jobdesc' => $request->result['Sheet1'][$i][3],
         			'cr_dateservice' => $datetime,
         			'cr_serviceadvisor' => $request->result['Sheet1'][$i][5],
         			'cr_code' => 'true',
         			'status_data' => 'true',

         		    );

      		 array_push($alldata, $arr);
               }
      		d_hcustommer::insert($alldata);
         }else{
            d_hcustommer::truncate();

            for ($i=0; $i < $request->datacount ; $i++) { 
               $arr = array(
                  'cr_serial' => $request->result['Sheet1'][$i][0],  
                  'cr_plate' => $request->result['Sheet1'][$i][1],
                  'cr_typecar' => $request->result['Sheet1'][$i][2],
                  'cr_jobdesc' => $request->result['Sheet1'][$i][3],
                  'cr_dateservice' => $datetime,
                  'cr_serviceadvisor' => $request->result['Sheet1'][$i][5],
                  'cr_code' => 'true',
                  'status_data' => 'true',

                   );

             array_push($alldata, $arr);
               }
            d_hcustommer::insert($alldata);
         }

   	}

      public function storedata(Request $request){
        $code = $request->code;
          $id = $request->idd;
          $count = DB::table('d_customerremovable')->count();
          if ($count > 10 ) {
            $cout = 10;
          }else{
            $cout = $count;
          }
          if ($count == 0) {
            return response()->json(array(
              'error' => 'Mohon Import Data',
            ));
          }else{

          $alldata = [];
            for ($i=0; $i < $cout ; $i++) { 
            $arr = array(
               'c_serial' => $request->serial[$i],
               'c_plate' => $request->plate[$i],
               'c_typecar' => $request->car[$i],
               'c_jobdesc' => $request->job[$i],
               'c_dateservice' => $request->date[$i],
               'c_serviceadvisor' => $request->advisor[$i],
               'c_code' => $request->code,
               'status_data' => 'true',
                );

          array_push($alldata, $arr);
            DB::table('d_customerremovable')->where('cr_id', $id[$i])->delete();
            }

         d_customer::insert($alldata);

          }


      }

      public function rekap(Request $request){
        $code = $request->code;
        $data = DB::table('d_customer')->where('c_code',$code)->count();
        $avaible = $request->cout - $data;
          DB::table('d_recap')->insert([
            're_dataadded' => $data,
            're_availabledata' => $avaible,
            're_totaldata' => $request->cout,
            're_dateupload' => Carbon::now(),
            're_ccustomer' => $code,
            'status_data' => 'true',
          ]);
      }

      public function delete(Request $request){
          $id = $request->id;
          DB::table('d_customerremovable')->where('cr_id',$id)->delete();

      }

      public function reset(Request $request){
          d_hcustommer::truncate();
      }
}
