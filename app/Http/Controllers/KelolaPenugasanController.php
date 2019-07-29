<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Carbon\Carbon;
use App\d_customer;
use App\d_followup;

class KelolaPenugasanController extends Controller
{
    public function kelola_penugasan()
    {
      $countwork = DB::table('d_customer')->where('status_data','true')->select('c_jobdesc', DB::raw('count(*) as total'))->whereYear('c_dateplan',Carbon::now('Asia/Jakarta')->format('Y'))->whereMonth('c_dateplan',Carbon::now('Asia/Jakarta')->format('m'))->groupBy('c_jobdesc')->orderBy('c_jobdesc','asc')->get();
    	$advisor = DB::table('d_user')->where(['u_user' => 'S', 'status_data' => 'true'])->get();
    	return view('monitoring_kinerja.kelola_penugasan.kelola_penugasan',array(
    		'advisor' => $advisor,
        'total' => $countwork,
    	));
    }

    public function tableganti(Request $request){
      if ($request->serviceadv != null) {
        $data = DB::table('d_followup')
          ->leftJoin('d_customer','c_order','fu_cid')
          ->leftJoin('d_user','u_code','c_serviceadvisor')
          ->whereYear('fu_date',Carbon::now('Asia/Jakarta')->format('Y'))
          ->whereMonth('fu_date',Carbon::now('Asia/Jakarta')->format('m'))
          ->where('u_code',$request->serviceadv)
          ->where('fu_status','!=','success')
          ->get();
      }else{
      	$data = DB::table('d_followup')
          ->leftJoin('d_customer','c_order','fu_cid')
          ->leftJoin('d_user','u_code','c_serviceadvisor')
          ->whereYear('fu_date',Carbon::now('Asia/Jakarta')->format('Y'))
          ->whereMonth('fu_date',Carbon::now('Asia/Jakarta')->format('m'))
          ->where('fu_status','!=','success')
          ->get();
      }

        return DataTables::of($data)
      ->addColumn('check',function($data){
        return '<input type="checkbox" class="up" name="followup[]" value="'.$data->c_code.'"><input type="checkbox" hidden name="customer[]" value="'.$data->c_serviceadvisor.'"><input type="checkbox" hidden name="id[]" value="'.$data->c_order.'">';
      })
      ->addColumn('serial',function($data){
        return $data->c_serial.'<input type="checkbox" hidden name="serial[]" value="'.$data->c_serial.'">';
      })
      ->rawColumns(['check','serial'])
      ->make(true);
    }

    public function tablecustomer(Request $request){
    		$data = DB::table('d_customer')
        ->where('status_data','true')
        ->orderBy('c_dateservice')
        ->orderBy('c_jobdesc')
        ->get();
    	return DataTables::of($data)
    	->addColumn('check',function($data){
    		return '<input type="checkbox" class="up" name="followup[]" value="'.$data->c_code.'"><input type="checkbox" hidden name="customer[]" value="'.$data->c_serviceadvisor.'"><input type="checkbox" hidden name="id[]" value="'.$data->c_order.'">';
    	})
    	->addColumn('serial',function($data){
    		return $data->c_serial.'<input type="checkbox" hidden name="serial[]" value="'.$data->c_serial.'">';
    	})
    	->rawColumns(['check','serial'])
    	->make(true);
    }

    public function filtertablecustomer(Request $request){
    	$data = DB::table('d_customer')->where('c_serviceadvisor',$request->serviceadv)->where('status_data','true')->get();
    	return DataTables::of($data)
    	->addColumn('check',function($data){
    		return '<input type="checkbox" class="up" name="followup[]" value="'.$data->c_code.'"><input type="checkbox" hidden name="customer[]" value="'.$data->c_serviceadvisor.'">';
    	})
    	->addColumn('serial',function($data){
    		return $data->c_serial.'<input type="hidden" name="serial[]" value="'.$data->c_serial.'">';
    	})
    	->rawColumns(['check','serial'])
    	->make(true);
    }

    public function updateserviceadv(Request $request){
        $advisor = $request->newadvisor;
    	if ($request->scount == NULL) {
    		return false;
    	}else{
    	for ($i=0; $i < $request->scount ; $i++) { 

            DB::table('d_followup')
            ->where('fu_cid',$request->id[$i])
            ->update([
                'fu_cstaff' => $advisor,
              ]);

           		DB::table('d_customer')
           		->where('c_serial',$request->serial[$i])
           		->where('c_serviceadvisor',$request->customer[$i])
           		->where('c_code',$request->followup[$i])
           		->update([
           			'c_serviceadvisor' => $advisor,
           		]);
            }
          return response()->json(['success' => 'Berhasil Mengganti Service Advisor']);
          }

    }

    public function addplan(Request $request){
    	if ($request->advisor_baru == '') {
    		return false;
    	}else if(count($request->id) == NULL){
    		return false;
    	}else{
            $alldata = [];
            for ($i=0; $i < count($request->id) ; $i++) { 
            $arr = array(
               		'fu_cid' => $request->id[$i],
           			'fu_cstaff' => $request->advisor_baru,
           			'fu_status' => 'Planning',
           			'status_data' =>'true',
                );
            DB::table('d_customer')->where('c_id',$request->id[$i])
            ->update([
            	'status_data' => 'plan',
            ]);
          array_push($alldata, $arr);
            }
         d_followup::insert($alldata);
            }

    }
}
