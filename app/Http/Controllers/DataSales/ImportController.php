<?php

namespace App\Http\Controllers\DataSales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\d_customer;
use App\d_followup;
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
      setlocale(LC_TIME, 'IND');
   		$code = 'S'.$urutan.Carbon::now('Asia/Jakarta')->format('ds');
   		return view('monitoring_kinerja.import_excel.import_excel',array(
   			'code' => $code,
   		));
   	}

      public function tablerekap(){
         $data = DB::table('d_recap')->get();
         setlocale(LC_TIME, 'IND');
         return DataTables::of($data)
         ->make(true);
      }

      public function table(){
         $data = DB::table('d_customerremovable')->groupBy('cr_serial')->get();
         return DataTables::of($data)
         ->addIndexColumn()
         ->addcolumn('rangka',function($data){
            return $data->cr_serial .'<input type="hidden" value="'.$data->cr_serial.'" class="serialc" name="serial[]"><input type="hidden" value="'.$data->cr_id.'" class="serial" name="idd[]">';
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
            return Carbon::parse($data->cr_dateservice)->formatLocalized('%d %B %Y').'<input type="hidden" value="'.setlocale(LC_TIME, 'IND').'"><input type="hidden" value="'.$data->cr_dateservice.'" class="date" name="date[]">';
         })
         ->addcolumn('servicead',function($data){
            return $data->cr_serviceadvisor .'<input type="hidden" value="'.$data->cr_serviceadvisor.'" class="advisor" name="advisor[]">';
         })
         ->addcolumn('action',function($data){
            return '<button class="btn btn-danger btn-sm hapus" data-id="'.$data->cr_id.'" type="button"><i class="fa fa-trash"></i></button><input type="hidden" value="'.$data->cr_direct.'" name="direct[]">';
         })
         ->rawColumns(['rangka', 'plate', 'type', 'job', 'date', 'servicead', 'action'])
         ->make(true);
      }

   	public function hstoredata(Request $request){
        ini_set('max_execution_time', 300);
          DB::beginTransaction();
          try {
          $workbook = $request->sheet[0];
          $code = $request->code;

          // data upload raw
      		    $alldata = [];
              $alldata2 = [];
              $datanosa = [];
              $direct2 = [];
               for ($i=1; $i < $request->datacount ; $i++) { 
                $sudahada = DB::table('d_customer')->where('c_serial',$request->result[$workbook][$i][0])->count();
                $countremove = DB::table('d_customerremovable')->where('cr_serial',preg_replace('/\s+/', '', $request->result[$workbook][$i][0]))->count();
                //order code
                $ordercode = DB::table('d_customer')->groupBy('c_code')->count().$i; 
              $datetime = Carbon::parse($request->result[$workbook][$i][4])->format('Y,m,d');


                if(empty($request->result[$workbook][$i][6])){
                  $direct = 'R';
                  }else{
                  $direct = $request->result[$workbook][$i][6];
                }

              if ($countremove == 0) {
                  $arr = array(
                'cr_serial' => preg_replace('/\s+/', '', $request->result[$workbook][$i][0]),  
                'cr_plate' => preg_replace('/\s+/', '', $request->result[$workbook][$i][1]),
                'cr_typecar' => $request->result[$workbook][$i][2],
                'cr_jobdesc' => $request->result[$workbook][$i][3],
                'cr_dateservice' => $datetime,
                'cr_serviceadvisor' => $request->result[$workbook][$i][5],
                'cr_direct' => $direct,
                'cr_code' => $code,
                'status_data' => 'true',
                  );

                array_push($alldata, $arr);
              }else{

              }
              
            
              $cekdata = DB::table('d_customerremovable')->count();
              $langsung = DB::table('d_user')->where('u_name',$request->result[$workbook][$i][5])->count();
              $langsung2 = DB::table('d_user')->where('u_name',$request->result[$workbook][$i][5])->get();
              $cek = DB::table('d_customerremovable')->where('cr_serial',preg_replace('/\s+/', '', $request->result[$workbook][$i][0]))->count();

              if(strtoupper($request->result[$workbook][$i][6]) == 'S'){ // data langsung masuk tanpa di filter

              if($sudahada == 0){
                if ($langsung == 1) { // jika ada service advisornya

                $arr1 = ([
                  'c_serial' => preg_replace('/\s+/', '', $request->result[$workbook][$i][0]),
                  'c_plate' => preg_replace('/\s+/', '', $request->result[$workbook][$i][1]),
                  'c_typecar' => $request->result[$workbook][$i][2],
                  'c_jobdesc' => $request->result[$workbook][$i][3],
                  'c_dateservice' => $datetime,
                  'c_dateplan' => Carbon::now('Asia/Jakarta')->format('y,m,d'),
                  'c_nameadvisor' => $request->result[$workbook][$i][5],
                  'c_serviceadvisor' => $langsung2[0]->u_code,
                  'c_code' => $request->code,
                  'c_order' => $ordercode,
                  'c_direct' => 'Y',
                  'status_data' => 'plan',
                ]);

                $arr2 = array(
                  'fu_cid' => $ordercode,
                  'fu_cstaff' => $langsung2[0]->u_code,
                  'fu_date' => Carbon::now('Asia/Jakarta')->format('Y,m,d'),
                  'fu_time' => Carbon::parse('Asia/Jakarta'),
                  'fu_status' => 'Planning',
                  'status_data' =>'true',
                  );

                array_push($alldata2, $arr1);
                array_push($direct2, $arr2);

                }else { // tidak ada service advisor
                  $arr1 = ([
                  'c_serial' => preg_replace('/\s+/', '', $request->result[$workbook][$i][0]),
                  'c_plate' => preg_replace('/\s+/', '', $request->result[$workbook][$i][1]),
                  'c_typecar' => $request->result[$workbook][$i][2],
                  'c_jobdesc' => $request->result[$workbook][$i][3],
                  'c_dateservice' => $datetime,
                  'c_dateplan' => Carbon::now('Asia/Jakarta')->format('y,m,d'),
                  'c_nameadvisor' => $request->result[$workbook][$i][5],
                  'c_code' => $request->code,
                  'c_order' => $ordercode,
                  'c_direct' => 'Y',
                  'status_data' => 'true',
                ]);

                  array_push($datanosa, $arr1);
                }
              }

                // DB::table('d_customerremovable')->where('cr_serial',preg_replace('/\s+/', '', $request->result[$workbook][$i][0]))->delete();

          }else if ($cekdata > 0) { // data di filter status 0
            if ($sudahada == 0) {
              if ($cek == 0) { // jika di filter status 0 maka data di masukkan
                if ($langsung == 1) { // jika ada service advisornya
                  $arr1 = ([
                    'c_serial' => preg_replace('/\s+/', '', $request->result[$workbook][$i][0]),
                    'c_plate' => preg_replace('/\s+/', '', $request->result[$workbook][$i][1]),
                    'c_typecar' => $request->result[$workbook][$i][2],
                    'c_jobdesc' => $request->result[$workbook][$i][3],
                    'c_dateservice' => $datetime,
                    'c_dateplan' => Carbon::now('Asia/Jakarta')->format('y,m,d'),
                    'c_nameadvisor' => $request->result[$workbook][$i][5],
                    'c_serviceadvisor' => $langsung2[0]->u_code,
                    'c_code' => $request->code,
                    'c_order' => $ordercode,
                    'status_data' => 'plan',
                  ]);

                  $arr2 = array(
                    'fu_cid' => $ordercode,
                    'fu_cstaff' => $langsung2[0]->u_code,
                    'fu_date' => Carbon::now('Asia/Jakarta')->format('Y,m,d'),
                    'fu_time' => Carbon::parse('Asia/Jakarta'),
                    'fu_status' => 'Planning',
                    'status_data' =>'true',
                    );

                  array_push($alldata2, $arr1);
                  array_push($direct2, $arr2);

                  }else { // tidak ada service advisor
                    $arr1 = ([
                    'c_serial' => preg_replace('/\s+/', '', $request->result[$workbook][$i][0]),
                    'c_plate' => preg_replace('/\s+/', '', $request->result[$workbook][$i][1]),
                    'c_typecar' => $request->result[$workbook][$i][2],
                    'c_jobdesc' => $request->result[$workbook][$i][3],
                    'c_dateservice' => $datetime,
                    'c_dateplan' => Carbon::now('Asia/Jakarta')->format('y,m,d'),
                    'c_nameadvisor' => $request->result[$workbook][$i][5],
                    'c_code' => $request->code,
                    'c_order' => $ordercode,
                    'status_data' => 'true',
                  ]);
                    array_push($datanosa, $arr1);
                  }
                }

              }else{
              
              }
            }
          }	 
              // dd($alldata2);

              if ($datanosa != null) {
                d_customer::insert($datanosa);
              }
               if ($alldata2 != null) { 
                  d_customer::insert($alldata2);
               }

               if ($direct2 != null) {
                  d_followup::insert($direct2); 
               }
               if ($alldata != null) {
      		        d_hcustommer::insert($alldata);
               }
            DB::commit();

          } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return response()->json(['status' => 'gagal']);
        }
  
            return response()->json([
              'progress' => 100,
            ]);
   	}

      

      public function rekap(Request $request){
        $workbook = $request->sheet[0];
        $rcount = $request->datacount - 1;
        $code = $request->code;
        $data = DB::table('d_customer')->where('c_code',$code)->count();
        $data2 = DB::table('d_customer')->count();
          DB::table('d_recap')->insert([
            're_dataadded' => $data,
            're_availabledata' => max($data2 - $data,0),
            're_totaldata' => $rcount,
            're_dateupload' => Carbon::now('Asia/Jakarta'),
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
          d_customer::truncate();
          d_followup::truncate();
      }


}
