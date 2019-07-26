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
         $data = DB::table('d_customerremovable')->get();
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
          $workbook = $request->sheet[0];
          $code = $request->code;
         $check = DB::table('d_customerremovable')->count();
         if ($check == 0) {
      		    $alldata = [];
               for ($i=1; $i < $request->datacount ; $i++) { 
                if(empty($request->result[$workbook][$i][6])){
                  $direct = 'R';
                  }else{
                  $direct = $request->result[$workbook][$i][6];
                }


              $datetime = Carbon::parse($request->result[$workbook][$i][4])->format('Y,m,d');
              $arr = array(
         			'cr_serial' => preg_replace('/\s+/', '', $request->result[$workbook][$i][0]),  
         			'cr_plate' => preg_replace('/\s+/', '', $request->result[$workbook][$i][1]),
         			'cr_typecar' => $request->result[$workbook][$i][2],
         			'cr_jobdesc' => $request->result[$workbook][$i][3],
         			'cr_dateservice' => $datetime,
              'cr_serviceadvisor' => $request->result[$workbook][$i][5],
         			'cr_direct' => $direct,
         			'cr_code' => 'true',
         			'status_data' => 'true',

         		    );

      		 array_push($alldata, $arr);
               }
      		d_hcustommer::insert($alldata);
         }else{
            d_hcustommer::truncate();

            for ($i=1 ; $i < $request->datacount ; $i++) { 
                $datetime = Carbon::parse($request->result[$workbook][$i][4])->format('Y,m,d');
               $arr = array(
                  'cr_serial' => $request->result[$workbook][$i][0],  
                  'cr_plate' => $request->result[$workbook][$i][1],
                  'cr_typecar' => $request->result[$workbook][$i][2],
                  'cr_jobdesc' => $request->result[$workbook][$i][3],
                  'cr_dateservice' => $datetime,
                  'cr_serviceadvisor' => $request->result[$workbook][$i][5],
                  'cr_direct' => $request->result[$workbook][$i][6],
                  'cr_code' => 'true',
                  'status_data' => 'true',

                   );

             array_push($alldata, $arr);
               }
            d_hcustommer::insert($alldata);
         }

   	}

      public function storedata(Request $request){
        ini_set('max_execution_time', 300);
        // try {
          $rcount = $request->serialc;
          $code = $request->code;
          $id = $request->idd;
          $count = DB::table('d_customerremovable')->count();
          if ($count == 0) {
            return response()->json(array(
              'error' => 'Mohon Import Data',
            ));
          }else{

          $alldata = [];
          $direct = [];
            for ($i=1; $i < $rcount ; $i++) {
                $ordercode = DB::table('d_customer')->groupBy('c_code')->count().$i; 
                $cekdouble = DB::table('d_customerremovable')->orderBy('cr_dateservice','desc')->get();
                $cek = DB::table('d_customer')->where('c_serial',$request->serial[$i])->count();
                $langsung = DB::table('d_user')->where('u_name',$request->advisor[$i])->count();
                $langsung2 = DB::table('d_user')->where('u_name',$request->advisor[$i])->get();

                if ($cek == 0 )  {
                   if ($langsung == 1) {
                      if(strtoupper($request->direct[$i]) == 'F'){
                          $arr1 = array(
                           'c_serial' => $request->serial[$i],
                           'c_plate' => $request->plate[$i],
                           'c_typecar' => $request->car[$i],
                           'c_jobdesc' => $request->job[$i],
                           'c_dateservice' => Carbon::parse($request->date[$i])->format('y,m,d'),
                           'c_dateplan' => Carbon::now('Asia/Jakarta')->addMonth()->format('y,m,d'),
                           'c_nameadvisor' => $request->advisor[$i],
                           'c_serviceadvisor' => $langsung2[0]->u_code,
                           'c_code' => $request->code,
                           'c_order' => $ordercode,
                           'status_data' => 'plan',
                            );

                          $arr2 = array(
                          'fu_cid' => $ordercode,
                          'fu_cstaff' => $langsung2[0]->u_code,
                          'fu_date' => Carbon::now('Asia/Jakarta')->format('Y,m,d'),
                          'fu_time' => Carbon::parse('Asia/Jakarta'),
                          'fu_status' => 'Planning',
                          'status_data' =>'true',
                          );
                        }else{
                            $arr1 = array(
                             'c_serial' => $request->serial[$i],
                             'c_plate' => $request->plate[$i],
                             'c_typecar' => $request->car[$i],
                             'c_jobdesc' => $request->job[$i],
                             'c_dateservice' => Carbon::parse($request->date[$i])->format('y,m,d'),
                             'c_dateplan' => Carbon::parse($request->date[$i])->addMonths(3)->format('y,m,d'),
                             'c_nameadvisor' => $request->advisor[$i],
                             'c_serviceadvisor' => $langsung2[0]->u_code,
                             'c_code' => $request->code,
                             'c_order' => $ordercode,
                             'status_data' => 'plan',
                              );

                            $arr2 = array(
                          'fu_cid' => $ordercode,
                          'fu_cstaff' => $langsung2[0]->u_code,
                          'fu_date' => Carbon::parse($request->date[$i])->addMonths(3)->format('y,m,d'),
                          'fu_time' => Carbon::parse('Asia/Jakarta'),
                          'fu_status' => 'Planning',
                          'status_data' =>'true',
                          );
                        }

                        array_push($alldata, $arr1);
                        array_push($direct, $arr2);
                  }else{ //tidak ada service advisor
                    if(strtoupper($request->direct[$i]) == 'F'){
                  $arr = array(
                       'c_serial' => $request->serial[$i],
                       'c_plate' => $request->plate[$i],
                       'c_typecar' => $request->car[$i],
                       'c_jobdesc' => $request->job[$i],
                       'c_dateservice' => Carbon::parse($request->date[$i])->format('y,m,d'),
                       'c_dateplan' => Carbon::parse($request->date[$i])->addMonth()->format('y,m,d'),
                       'c_nameadvisor' => $request->advisor[$i],
                       'c_serviceadvisor' => '',
                       'c_code' => $request->code,
                       'c_order' => $ordercode,
                       'status_data' => 'true',
                        );
                    }else{
                      $arr = array(
                       'c_serial' => $request->serial[$i],
                       'c_plate' => $request->plate[$i],
                       'c_typecar' => $request->car[$i],
                       'c_jobdesc' => $request->job[$i],
                       'c_dateservice' => Carbon::parse($request->date[$i])->format('y,m,d'),
                       'c_dateplan' => Carbon::parse($request->date[$i])->addMonths(3)->format('y,m,d'),
                       'c_nameadvisor' => $request->advisor[$i],
                       'c_serviceadvisor' => '',
                       'c_code' => $request->code,
                       'c_order' => $ordercode,
                       'status_data' => 'true',
                        );
                    }

                array_push($alldata, $arr);
                  }
                    }else{ // jika sama
                      if(strtoupper($request->direct[$i]) == 'F'){
                          DB::table('d_customer')->where('c_plate',$request->plate[$i])->update([
                              'c_dateservice' => Carbon::parse($request->date[$i])->format('y,m,d'),
                              'c_dateplan' => Carbon::parse($request->date[$i])->addMonth()->format('y,m,d'),
                          ]);
                        }else{
                          DB::table('d_customer')->where('c_plate',$request->plate[$i])->update([
                              'c_dateservice' => Carbon::parse($request->date[$i])->format('y,m,d'),
                              'c_dateplan' => Carbon::parse($request->date[$i])->addMonths(3)->format('y,m,d'),
                          ]);
                        }
                    }
                }
             d_customer::insert($alldata);
             d_followup::insert($direct);
             d_hcustommer::truncate();
              }
             // } catch (\Exception $e) {
              // pesan error
             // }
            }

      public function rekap(Request $request){
        $rcount = $request->serial;
        $code = $request->code;
        $data = DB::table('d_customer')->where('c_code',$code)->count();
        $data2 = DB::table('d_customer')->count();
        $avaible = $request->cout - 1;
          DB::table('d_recap')->insert([
            're_dataadded' => $data,
            're_availabledata' => max($data2 - $avaible,0),
            're_totaldata' => $request->cout - 1,
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
      }


}
